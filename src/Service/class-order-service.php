<?php

namespace Synerise\Integration\Service;

use DateTime;
use DateTimeZone;
use Synerise\Integration\Synerise_For_Woocommerce;
use WC_Order;
use WC_Order_Item;
use WC_Product;
use WC_Product_Variation;

class Order_Service
{
    public static function prepare_order_params(WC_Order $order): array
    {
        $date = $order->get_date_created() ?: new DateTime('now');
        $date->setTimezone(new DateTimeZone("UTC"));

        $params = [
            'orderId' => (string)$order->get_id(),
            'paymentInfo' => [
                'method' => $order->get_payment_method_title()
            ],
            'metadata' => [
                "orderStatus" => $order->get_status(),
            ],
            'discountAmount' => [
                'amount' => (float)$order->get_discount_total(),
                'currency' => $order->get_currency()
            ],
            'revenue' => [
                'amount' => (float)$order->get_total(),
                'currency' => $order->get_currency()
            ],
            'recordedAt' => $date->format('Y-m-d\TH:i:s.v\Z'),
            'value' => [
                'amount' => (float)$order->get_total() - $order->get_total_tax(),
                'currency' => $order->get_currency()
            ],
            'eventSalt' => $order->get_order_key(),
            'products' => []
        ];

        $coupon_codes = $order->get_coupon_codes();
        if (!empty($coupon_codes)) {
            $params['metadata']['couponCodes'] = $coupon_codes;
        }

        foreach ($order->get_items() as $item_id => $item) {
            $products = self::prepare_order_product_params($item);
            if (empty($products)) {
                continue;
            }
            $params['products'][] = $products;
        }

        return $params;
    }

    public static function prepare_order_product_params(WC_Order_Item $product_item): array
    {
        /**
         * @var WC_Product $product
         */
        $product = $product_item->get_product();

        if (empty($product)) {
            return [];
        }

        $productKey = Product_Service::get_item_key($product);

        if (empty($productKey)) {
            return [];
        }

        if ($product instanceof WC_Product_Variation) {
            $parent = wc_get_product($product->get_parent_id());
            $parentKey = Product_Service::get_item_key($parent);
        }

        return [
            'name' => $product->get_name(),
            'cancel' => false,
            'finalUnitPrice' => [
                'amount' => (float)($product_item->get_data()['total'] + $product_item->get_data()['total_tax']) / $product_item->get_data()['quantity'],
                'currency' => get_woocommerce_currency()
            ],
            'netUnitPrice' => [
                'amount' => (float)$product->get_price(),
                'currency' => get_woocommerce_currency()
            ],
            'quantity' => $product_item->get_data()['quantity'],
            'regularPrice' => [
                'amount' => (float)$product->get_regular_price(),
                'currency' => get_woocommerce_currency()
            ],
            'sku' => $productKey,
            'parentSku' => $parentKey ?? null,
            'productSku' => $product->get_data()['sku'],
            'parentProductSku' => isset($parent) ? $parent->get_data()['sku'] : null

        ];
    }

    public static function get_orders_count()
    {
        global $wpdb;

        $query = "SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_type = 'shop_order'";

        return $wpdb->get_var($query);
    }

    public static function get_agreements_from_order($order_id): array
    {
        $opt_in_mode = Synerise_For_Woocommerce::get_setting('opt_in');
        $email_agreement_enabled = Opt_In_Service::is_agreement_enabled(Opt_In_Service::AGREEMENT_TYPE_EMAIL);
        $sms_agreement_enabled = Opt_In_Service::is_agreement_enabled(Opt_In_Service::AGREEMENT_TYPE_SMS);

        $array = [
            'agreements' => []
        ];

        if ($opt_in_mode === Opt_In_Service::OPT_IN_MODE_MAP) {
            $order_sms_agreement_mapping = Synerise_For_Woocommerce::get_setting('opt_in_mapping_order_sms_agreement');
            $order_email_agreement_mapping = Synerise_For_Woocommerce::get_setting('opt_in_mapping_order_email_agreement');

            if ($order_sms_agreement_mapping && $sms_agreement_enabled) {
                $sms_meta_field = get_post_meta($order_id, $order_sms_agreement_mapping);
                $array['agreements']['sms'] = $sms_meta_field ? (bool)$sms_meta_field[0] : null;
            }

            if ($order_email_agreement_mapping && $sms_agreement_enabled) {
                $email_meta_field = get_post_meta($order_id, $order_email_agreement_mapping);
                $array['agreements']['email'] = $email_meta_field ? (bool)$email_meta_field[0] : null;
            }
        } else {
            if ($sms_agreement_enabled) {
                $sms_meta_field = get_post_meta($order_id, Opt_In_Service::AGREEMENT_ORDER_METADATA_NAME_SMS);
                $array['agreements']['sms'] = $sms_meta_field ? (bool)$sms_meta_field[0] : null;
            }
            if ($email_agreement_enabled) {
                $email_meta_field = get_post_meta($order_id, Opt_In_Service::AGREEMENT_ORDER_METADATA_NAME_EMAIL);
                $array['agreements']['email'] = $email_meta_field ? (bool)$email_meta_field[0] : null;
            }
        }

        $array['agreements'] = array_filter($array['agreements'], static function ($value) {
            return ($value !== null && $value !== '');
        });

        return $array;
    }
}
