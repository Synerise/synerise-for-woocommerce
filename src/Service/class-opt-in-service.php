<?php

namespace Synerise\Integration\Service;

use Synerise\Integration\Synerise_For_Woocommerce;

class Opt_In_Service {

    const OPT_IN_MODE_DISABLED = 0;
    const OPT_IN_MODE_MAP = 1;
    const OPT_IN_MODE_ADD_TO_REGISTER = 3;
    const OPT_IN_MODE_ADD_TO_CHECKOUT = 4;
    const OPT_IN_MODE_ADD_TO_REGISTER_AND_CHECKOUT = 5;

    const OPT_IN = array(
        array(
            'mode' => self::OPT_IN_MODE_DISABLED,
            'label'  => 'Disabled'
        ),
        array(
            'mode' => self::OPT_IN_MODE_MAP,
            'label'  => 'Map existing metadata'
        ),
        array(
            'mode' => self::OPT_IN_MODE_ADD_TO_REGISTER,
            'label'  => 'Add marketing agreements to register form'
        ),
        array(
            'mode' => self::OPT_IN_MODE_ADD_TO_CHECKOUT,
            'label'  => 'Add marketing agreements to checkout form'
        ),
        array(
            'mode' => self::OPT_IN_MODE_ADD_TO_REGISTER_AND_CHECKOUT,
            'label' => 'Add marketing agreements to register and checkout form'
        )
    );

    const AGREEMENT_TYPE_EMAIL = 'email';
    const AGREEMENT_TYPE_SMS = 'sms';

    const AGREEMENT_ORDER_METADATA_NAME_EMAIL = 'customer_agreements_email';
    const AGREEMENT_ORDER_METADATA_NAME_SMS = 'customer_agreements_sms';

    const AGREEMENT_USER_METADATA_NAME_EMAIL = 'customer_agreements_email';
    const AGREEMENT_USER_METADATA_NAME_SMS = 'customer_agreements_sms';

    public static function is_opt_in_enabled(): bool
    {
        $opt_in_mode = Synerise_For_Woocommerce::get_setting('opt_in');

        return $opt_in_mode !== self::OPT_IN_MODE_DISABLED;
    }

    public static function is_agreement_enabled($agreement): bool {

        switch ($agreement){
            case self::AGREEMENT_TYPE_EMAIL:
                return Synerise_For_Woocommerce::get_setting('opt_in_email_marketing_agreement_enabled');
            case self::AGREEMENT_TYPE_SMS:
                return Synerise_For_Woocommerce::get_setting('opt_in_sms_marketing_agreement_enabled');
            default:
                return false;
        }
    }

    public function add_checkout_fields($fields): array
    {
        $user_id = get_current_user_id();
        $user_id = $user_id ?: null;

        if($user_id){
            $agreements = Client_Service::get_customer_agreements($user_id);
            if(empty($agreements)){
                return $fields;
            }
        }

        if(Synerise_For_Woocommerce::get_setting('opt_in_email_marketing_agreement_enabled')){
            $email_label = Synerise_For_Woocommerce::get_setting('opt_in_checkout_agreement_email_label');
            $email_classes = Synerise_For_Woocommerce::get_setting('opt_in_checkout_agreement_email_classes');
            $email_required = Synerise_For_Woocommerce::get_setting('opt_in_checkout_agreement_email_required');

            $fields['order'][self::AGREEMENT_ORDER_METADATA_NAME_EMAIL] = array(
                'label' => $email_label ?: 'Email marketing',
                'placeholder'=> '',
                'required'   => $email_required ?: false,
                'class'      => $email_classes ?: '',
                'type'  => 'checkbox'
            );
        }

        if(Synerise_For_Woocommerce::get_setting('opt_in_sms_marketing_agreement_enabled')){
            $sms_label = Synerise_For_Woocommerce::get_setting('opt_in_checkout_agreement_sms_label');
            $sms_classes = Synerise_For_Woocommerce::get_setting('opt_in_checkout_agreement_sms_classes');
            $sms_required = Synerise_For_Woocommerce::get_setting('opt_in_checkout_agreement_sms_required');

            $fields['order'][self::AGREEMENT_ORDER_METADATA_NAME_SMS] = array(
                'label' => $sms_label ?: 'Sms marketing',
                'placeholder'=> '',
                'required'   => $sms_required ?: false,
                'class'      => $sms_classes ?: '',
                'type'  => 'checkbox'
            );
        }

        return $fields;
    }
    public function update_order_meta($order_id) {
        $user_id = get_current_user_id();
        $user_id = $user_id ?: null;

        if($_POST[self::AGREEMENT_ORDER_METADATA_NAME_SMS] && Synerise_For_Woocommerce::get_setting('opt_in_sms_marketing_agreement_enabled')){
            $agreement_sms = !empty(trim(sanitize_text_field($_POST[self::AGREEMENT_ORDER_METADATA_NAME_SMS])));
            update_post_meta( $order_id, self::AGREEMENT_ORDER_METADATA_NAME_SMS, $agreement_sms );
            if($user_id){
                update_user_meta($user_id, self::AGREEMENT_USER_METADATA_NAME_SMS, $agreement_sms);
            }
        }

        if($_POST[self::AGREEMENT_ORDER_METADATA_NAME_EMAIL] && Synerise_For_Woocommerce::get_setting('opt_in_email_marketing_agreement_enabled')){
            $agreement_email = !empty(trim(sanitize_text_field($_POST[self::AGREEMENT_ORDER_METADATA_NAME_EMAIL])));
            update_post_meta( $order_id, self::AGREEMENT_ORDER_METADATA_NAME_EMAIL, $agreement_email );
            if($user_id){
                update_user_meta($user_id, self::AGREEMENT_USER_METADATA_NAME_EMAIL, $agreement_email);
            }
        }

    }

    public function add_user_profile_fields($user){
        if(!$user){
            $user_id = get_current_user_id();
        } else {
            $user_id = $user->ID;
        }

        $author_meta_email_agreement = esc_attr( get_the_author_meta( self::AGREEMENT_USER_METADATA_NAME_EMAIL, $user_id ) );
        $author_meta_sms_agreement = esc_attr( get_the_author_meta( self::AGREEMENT_USER_METADATA_NAME_SMS, $user_id ) );

        $field_email_agreement_classes = Synerise_For_Woocommerce::get_setting('opt_in_register_agreement_email_classes');
        $field_email_agreement_label = Synerise_For_Woocommerce::get_setting('opt_in_register_agreement_email_label');

        $field_sms_agreement_classes = Synerise_For_Woocommerce::get_setting('opt_in_register_agreement_sms_classes');
        $field_sms_agreement_label = Synerise_For_Woocommerce::get_setting('opt_in_register_agreement_sms_label');

        $agreement_email_enabled = Synerise_For_Woocommerce::get_setting('opt_in_email_marketing_agreement_enabled');
        $agreement_sms_enabled = Synerise_For_Woocommerce::get_setting('opt_in_sms_marketing_agreement_enabled');

        echo '
            <h2>Marketing agreements</h2>
            <table class="form-table">'.
            (($agreement_email_enabled) ? '
                <tr class="' . $field_email_agreement_classes . '">
                    <th>
                        <label for="' . self::AGREEMENT_USER_METADATA_NAME_EMAIL . '">' . $field_email_agreement_label . '</label>
                    </th>
                    <td>
                        <input type="checkbox" value="1" name="' . self::AGREEMENT_USER_METADATA_NAME_EMAIL . '" id="' . self::AGREEMENT_USER_METADATA_NAME_EMAIL . '" class="regular-text" ' . (($author_meta_email_agreement) ? 'checked' : "") . '/>
                    </td>
                </tr>
            ' : "") .
            (($agreement_sms_enabled) ? '
                <tr class="'.$field_sms_agreement_classes.'">
                    <th>
                        <label for="'.self::AGREEMENT_USER_METADATA_NAME_SMS.'">'.$field_sms_agreement_label.'</label>
                    </th>
                    <td>
                        <input type="checkbox" value="1" name="'.self::AGREEMENT_USER_METADATA_NAME_SMS.'" id="'.self::AGREEMENT_USER_METADATA_NAME_SMS.'" class="regular-text" '.(($author_meta_sms_agreement) ? 'checked': "").'/>
                    </td>
                </tr>
            ' : "") .
        '</table>';
    }

    public function update_user_meta($user_id){
        $agreement_email_enabled = Synerise_For_Woocommerce::get_setting('opt_in_email_marketing_agreement_enabled');
        $agreement_sms_enabled = Synerise_For_Woocommerce::get_setting('opt_in_sms_marketing_agreement_enabled');

        if($agreement_sms_enabled){
            if(isset($_POST[self::AGREEMENT_USER_METADATA_NAME_SMS])){
                $agreement_sms = !empty(trim(sanitize_text_field($_POST[self::AGREEMENT_USER_METADATA_NAME_SMS])));
            } else {
                $agreement_sms = false;
            }

            update_user_meta($user_id, self::AGREEMENT_USER_METADATA_NAME_SMS, (int) $agreement_sms);
        }

        if($agreement_email_enabled){
            if(isset($_POST[self::AGREEMENT_USER_METADATA_NAME_EMAIL])){
                $agreement_email = !empty(trim(sanitize_text_field($_POST[self::AGREEMENT_USER_METADATA_NAME_EMAIL])));
            } else {
                $agreement_email = false;
            }
            update_user_meta($user_id, self::AGREEMENT_USER_METADATA_NAME_EMAIL, (int) $agreement_email);
        }
    }
}