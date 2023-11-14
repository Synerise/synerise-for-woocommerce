<?php

namespace Synerise\Integration;

if (!defined('ABSPATH')) {
    exit;
}

class Synerise_For_Woocommerce_Events
{

    /**
     * @var Synerise_For_Woocommerce_Loader
     */
    private $loader;

    public function __construct(Synerise_For_Woocommerce_Loader $loader)
    {
        $this->loader = $loader;
    }

    public function register_events()
    {
        if (!Synerise_For_Woocommerce::get_setting('event_tracking_enabled')) {
            return;
        }

        $logger = Synerise_For_Woocommerce::get_logger();
        $trackingManager = Synerise_For_Woocommerce::get_tracking_manager();
        $event_service = Synerise_For_Woocommerce::get_event_service();

        $client_register = new Event\Event_Client_Register($logger, $trackingManager, $event_service);
        $this->loader->add_action($client_register::HOOK_NAME, $client_register, 'execute', 9999);

        $client_login = new Event\Event_Client_Login($logger, $trackingManager, $event_service);
        $this->loader->add_action($client_login::HOOK_NAME, $client_login, 'execute', 9999);

        $client_logout = new Event\Event_Client_Logout($logger, $trackingManager, $event_service);
        $this->loader->add_action($client_logout::HOOK_NAME, $client_logout, 'execute', 9999);

        $client_edit = new Event\Event_Client_Edit($logger, $trackingManager, $event_service);
        $this->loader->add_action('woocommerce_save_account_details', $client_edit, 'execute', 9999);
        $this->loader->add_action('edit_user_profile_update', $client_edit, 'execute', 9999);
        $this->loader->add_action('personal_options_update', $client_edit, 'execute', 9999);

        $cart_status = new Event\Event_Cart_Status($logger, $trackingManager, $event_service);
        $this->loader->add_action($cart_status::HOOK_NAME, $cart_status, 'execute', 9999);

        $add_to_cart = new Event\Event_Add_To_Cart($logger, $trackingManager, $event_service);
        $this->loader->add_action($add_to_cart::HOOK_NAME, $add_to_cart, 'execute', 9999);
        $this->loader->add_action($add_to_cart::HOOK_NAME, $cart_status, 'execute', 10000);

        $removed_from_cart = new Event\Event_Removed_From_Cart($logger, $trackingManager, $event_service);
        $this->loader->add_action($removed_from_cart::HOOK_NAME, $removed_from_cart, 'execute', 9999);
        $this->loader->add_action($removed_from_cart::HOOK_NAME, $cart_status, 'execute', 10000);

        $order_placed = new Event\Event_Order_Placed($logger, $trackingManager, $event_service);
        $this->loader->add_action($order_placed::HOOK_NAME, $order_placed, 'execute', 9999);

        $order_update = new Event\Event_Order_Update($logger);
        $this->loader->add_action($order_update::HOOK_NAME, $order_update, 'execute', 9999);

        $product_added = new Event\Event_Product_Added(
            Synerise_For_Woocommerce::get_logger()
        );
        $this->loader->add_action($product_added::HOOK_NAME, $product_added, 'execute', 9999);

        $product_import = new Event\Event_Product_Import(
            Synerise_For_Woocommerce::get_logger()
        );
        $this->loader->add_action($product_import::HOOK_NAME, $product_import, 'execute', 9999);

        $product_quick_edit = new Event\Event_Product_Quick_Edit(
            Synerise_For_Woocommerce::get_logger()
        );
        $this->loader->add_action($product_quick_edit::HOOK_NAME, $product_quick_edit, 'execute', 9999);

        $product_bulk_edit = new Event\Event_Product_Bulk_Edit(
            Synerise_For_Woocommerce::get_logger()
        );
        $this->loader->add_action($product_bulk_edit::HOOK_NAME, $product_bulk_edit, 'execute', 9999);

        $product_trash_untrash = new Event\Event_Product_Trash_Untrash($logger, $trackingManager, $event_service);
        $this->loader->add_action('trashed_post', $product_trash_untrash, 'execute', 9999);
        $this->loader->add_action('untrashed_post', $product_trash_untrash, 'execute', 9999);

        $product_review = new Event\Event_Product_Review($logger, $trackingManager, $event_service);
        $this->loader->add_action($product_review::HOOK_NAME, $product_review, 'execute', 9999);
    }
}
