<?php

namespace Synerise\Integration\Service;

use Synerise\Integration\Synerise_For_Woocommerce;
use Synerise\IntegrationCore\Uuid;

class Client_Service
{

    public static function prepare_client_params(\WC_Customer $customer): array
    {

        $address = $customer->get_billing_address_2() ?
            $customer->get_billing_address_1() . ' ' . $customer->get_billing_address_2() :
            $customer->get_billing_address_1();

        $params = array_filter([
            'uuid' => Uuid::generateUuidByEmail($customer->get_email()),
            'email' => $customer->get_email(),
            'firstname' => $customer->get_first_name() ?: null,
            'lastname' => $customer->get_last_name() ?: null,
            'displayName' => $customer->get_display_name() ?: null,
            'phone' => $customer->get_billing_phone() ?: null,
            'company' => $customer->get_billing_company() ?: null,
            'city' => $customer->get_billing_city() ?: null,
            'address' => $address ?: null,
            'zip_code' => $customer->get_billing_postcode() ?: null,
            'province' => $customer->get_billing_state() ?: null,
            'countryCode' => $customer->get_billing_country() ?: null
        ]);

        if(Opt_In_Service::is_opt_in_enabled()){
            $agreements = self::get_customer_agreements($customer->get_id());
            $params = array_merge($params, $agreements);
        }

        return array_filter($params);
    }

    public static function prepare_client_params_from_order(\WC_Order $order): array
    {
        $address = $order->get_billing_address_2() ?
            $order->get_billing_address_1() . ' ' . $order->get_billing_address_2() :
            $order->get_billing_address_1();

        $params = array_filter([
            'uuid' => Uuid::generateUuidByEmail($order->get_billing_email()),
            'email' => $order->get_billing_email(),
            'firstname' => $order->get_billing_first_name() ?: null,
            'lastname' => $order->get_billing_last_name() ?: null,
            'phone' => $order->get_billing_phone() ?: null,
            'company' => $order->get_billing_company() ?: null,
            'city' => $order->get_billing_city() ?: null,
            'address' => $address ?: null,
            'zipCode' => $order->get_billing_postcode() ?: null,
            'province' => $order->get_billing_state() ?: null,
            'countryCode' => $order->get_billing_country() ?: null
        ]);

        if(Opt_In_Service::is_opt_in_enabled()){
            $agreements = Order_Service::get_agreements_from_order($order->get_id());
            $params = array_merge($params, $agreements);
        }

        return array_filter($params);
    }

	public static function get_customers_count()
	{
		$args = array(
			'role' => 'customer',
			'fields' => 'ids',
			'no_found_rows' => true,
		);

		$users = get_users($args);

		return count($users);
	}

    public static function get_customer_agreements($customer_id): array
    {
        $opt_in_mode = Synerise_For_Woocommerce::get_setting('opt_in');
        $email_agreement_enabled = Opt_In_Service::is_agreement_enabled(Opt_In_Service::AGREEMENT_TYPE_EMAIL);
        $sms_agreement_enabled = Opt_In_Service::is_agreement_enabled(Opt_In_Service::AGREEMENT_TYPE_SMS);

        $array = [
            'agreements' => []
        ];

        if($opt_in_mode === Opt_In_Service::OPT_IN_MODE_MAP){
            $order_sms_agreement_mapping = Synerise_For_Woocommerce::get_setting('opt_in_mapping_customer_sms_agreement');
            $order_email_agreement_mapping = Synerise_For_Woocommerce::get_setting('opt_in_mapping_customer_email_agreement');

            if($order_sms_agreement_mapping && $sms_agreement_enabled){
                $sms_meta_field = get_user_meta($customer_id, $order_sms_agreement_mapping);
                $array['agreements']['sms'] = $sms_meta_field ? (bool) $sms_meta_field[0] : null;
            }

            if($order_email_agreement_mapping && $sms_agreement_enabled){
                $email_meta_field = get_user_meta($customer_id, $order_email_agreement_mapping);
                $array['agreements']['email'] = $email_meta_field ? (bool) $email_meta_field[0] : null;
            }
        } else {
            if($email_agreement_enabled){
                $sms_meta_field = get_user_meta($customer_id, Opt_In_Service::AGREEMENT_USER_METADATA_NAME_SMS);
                $array['agreements']['sms'] = $sms_meta_field ? (bool) $sms_meta_field[0] : null;
            }
            if($sms_agreement_enabled){
                $email_meta_field = get_user_meta($customer_id, Opt_In_Service::AGREEMENT_USER_METADATA_NAME_EMAIL);
                $array['agreements']['email'] = $email_meta_field ? (bool) $email_meta_field[0] : null;
            }
        }

        $array['agreements'] = array_filter($array['agreements'], static function($value){
            return ($value !== null && $value !== '');
        });

        return $array;
    }
}
