<?php

namespace Synerise\Integration;

use Synerise\Integration\Service\Catalog_Service;

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

        $client_register = new Events\Event_Client_Register(
            Synerise_For_Woocommerce::get_logger(),
            Synerise_For_Woocommerce::get_tracking_manager(),
            Synerise_For_Woocommerce::get_data_management_api_factory(),
	        Synerise_For_Woocommerce::get_client_management_api_factory()
        );
		$this->loader->add_action($client_register::HOOK_NAME, $client_register, 'send_event', 9999);

        $client_login = new Events\Event_Client_Login(
            Synerise_For_Woocommerce::get_logger(),
            Synerise_For_Woocommerce::get_tracking_manager(),
            Synerise_For_Woocommerce::get_data_management_api_factory()
        );
	    $this->loader->add_action($client_login::HOOK_NAME, $client_login, 'send_event', 9999);

        $client_logout = new Events\Event_Client_Logout(
            Synerise_For_Woocommerce::get_logger(),
            Synerise_For_Woocommerce::get_tracking_manager(),
            Synerise_For_Woocommerce::get_data_management_api_factory()
        );
	    $this->loader->add_action($client_logout::HOOK_NAME, $client_logout, 'send_event', 9999);

        $client_edit = new Events\Event_Client_Edit(
            Synerise_For_Woocommerce::get_logger(),
            Synerise_For_Woocommerce::get_client_management_api_factory()
        );

        $this->loader->add_action('woocommerce_save_account_details', $client_edit, 'send_event', 9999);
        $this->loader->add_action('edit_user_profile_update', $client_edit, 'send_event', 9999);
        $this->loader->add_action('personal_options_update', $client_edit, 'send_event', 9999);


        $add_to_cart = new Events\Event_Add_To_Cart(
            Synerise_For_Woocommerce::get_logger(),
            Synerise_For_Woocommerce::get_tracking_manager(),
            Synerise_For_Woocommerce::get_data_management_api_factory()
        );
	    $this->loader->add_action($add_to_cart::HOOK_NAME, $add_to_cart, 'send_event', 9999);

        $removed_from_cart = new Events\Event_Removed_From_Cart(
            Synerise_For_Woocommerce::get_logger(),
            Synerise_For_Woocommerce::get_tracking_manager(),
            Synerise_For_Woocommerce::get_data_management_api_factory()
        );
	    $this->loader->add_action($removed_from_cart::HOOK_NAME, $removed_from_cart, 'send_event', 9999);

        $cart_updated = new Events\Event_Cart_Updated(
            Synerise_For_Woocommerce::get_logger(),
            Synerise_For_Woocommerce::get_tracking_manager(),
            Synerise_For_Woocommerce::get_data_management_api_factory()
        );
	    $this->loader->add_action($cart_updated::HOOK_NAME, $cart_updated, 'send_event', 9999);

        $order_placed = new Events\Event_Order_Placed(
            Synerise_For_Woocommerce::get_logger(),
            Synerise_For_Woocommerce::get_tracking_manager(),
            Synerise_For_Woocommerce::get_data_management_api_factory(),
	        Synerise_For_Woocommerce::get_client_management_api_factory()
        );
	    $this->loader->add_action($order_placed::HOOK_NAME, $order_placed, 'send_event', 9999);

        $product_added = new Events\Event_Product_Added(
            Synerise_For_Woocommerce::get_logger()
        );
	    $this->loader->add_action($product_added::HOOK_NAME, $product_added, 'send_event', 9999);

        $product_import = new Events\Event_Product_Import(
            Synerise_For_Woocommerce::get_logger()
        );
	    $this->loader->add_action($product_import::HOOK_NAME, $product_import, 'send_event', 9999);

        $product_quick_edit = new Events\Event_Product_Quick_Edit(
            Synerise_For_Woocommerce::get_logger()
        );
	    $this->loader->add_action($product_quick_edit::HOOK_NAME, $product_quick_edit, 'send_event', 9999);

        $product_bulk_edit = new Events\Event_Product_Bulk_Edit(
            Synerise_For_Woocommerce::get_logger()
        );
	    $this->loader->add_action($product_bulk_edit::HOOK_NAME, $product_bulk_edit, 'send_event', 9999);

        $product_trash_untrash = new Events\Event_Product_Trash_Untrash(
            Synerise_For_Woocommerce::get_logger(),
            Synerise_For_Woocommerce::get_data_management_catalogs_api_factory(),
	        new Catalog_Service()
        );
	    $this->loader->add_action('trashed_post', $product_trash_untrash, 'send_event', 9999);
	    $this->loader->add_action('untrashed_post', $product_trash_untrash, 'send_event', 9999);

        $product_review = new Events\Event_Product_Review(
	        Synerise_For_Woocommerce::get_logger(),
			Synerise_For_Woocommerce::get_tracking_manager(),
	        Synerise_For_Woocommerce::get_data_management_api_factory()
        );
		$this->loader->add_action($product_review::HOOK_NAME, $product_review, 'send_event', 9999);
    }
}
