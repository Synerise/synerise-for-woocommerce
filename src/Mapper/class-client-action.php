<?php

namespace Synerise\Integration\Mapper;

use DateTime;
use DateTimeZone;
use Mobile_Detect;

class Client_Action
{
    const ACTION_LABELS = array(
        array(
            'action' => 'register',
            'label' => 'Customer registration'
        ),
        array(
            'action' => 'login',
            'label' => 'Customer login'
        ),
        array(
            'action' => 'logout',
            'label' => 'Customer logout'
        ),
        array(
            'action' => 'customer_update',
            'label' => 'Customer data saved'
        ),
        array(
            'action' => 'add_to_cart',
            'label' => 'Customer added product to cart'
        ),
        array(
            'action' => 'remove_from_cart',
            'label' => 'Customer removed product from cart'
        ),
        array(
            'action' => 'order_placed',
            'label' => 'Customer placed order'
        ),
        array(
            'action' => 'order_update',
            'label' => 'Order update'
        ),
        array(
            'action' => 'product_update',
            'label' => 'Product update'
        ),
        array(
            'action' => 'product_update_in_bulk',
            'label' => 'Product update in bulk'
        ),
        array(
            'action' => 'product_update_with_quick_edit',
            'label' => 'Product update by quick edit'
        ),
        array(
            'action' => 'product_import',
            'label' => 'Product import'
        ),
        array(
            'action' => 'product_trash_untrash',
            'label' => 'Product trashed/untrashed'
        ),
        array(
            'action' => 'cart_status_change',
            'label' => 'Cart status'
        ),
        array(
            'action' => 'product_review',
            'label' => 'Product review'
        )
    );

    const FORMAT_ISO_8601 = 'Y-m-d\TH:i:s.v\Z';

    public static function get_time(DateTime $date_time): string
    {
        $date_time->setTimezone(new DateTimeZone("UTC"));
        return $date_time->format(self::FORMAT_ISO_8601);
    }

    /**
     * @param string $action
     * @return string|null
     */
    public static function get_label(string $action_name)
    {
        $action = array_search($action_name, array_column(self::ACTION_LABELS, 'action'));

        if ($action !== false) {
            return self::ACTION_LABELS[$action]['label'];
        }

        return null;
    }

    public static function get_source(): string
    {
        $mobileDetect = new Mobile_Detect();
        if ($mobileDetect->isMobile()) {
            return 'WEB_MOBILE';
        }

        return 'WEB_DESKTOP';
    }
}
