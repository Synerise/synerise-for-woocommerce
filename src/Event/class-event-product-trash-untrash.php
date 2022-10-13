<?php

namespace Synerise\Integration\Event;

use Psr\Log\LoggerInterface;
use Synerise\Integration\Logger_Service;
use Synerise\Integration\Service\Catalog_Service;
use Synerise\Integration\Service\Product_Service;
use Synerise\Integration\Service\Tracking_Service;
use Synerise\Integration\Synerise_For_Woocommerce;
use Synerise\IntegrationCore\Factory\DataManagementCatalogsApiFactory;

if (! defined('ABSPATH')) {
	exit;
}

class Event_Product_Trash_Untrash
{
	const EVENT_NAME = 'product_trash_untrash';

	/**
	 * @var LoggerInterface
	 */
	private $logger;

	/**
	 * @var DataManagementCatalogsApiFactory
	 */
	private $data_management_catalogs_api_factory;

	/**
	 * @var Catalog_Service
	 */
	private $catalog_service;

	public function __construct(
		LoggerInterface $logger,
		DataManagementCatalogsApiFactory $data_management_catalogs_api_factory,
		Catalog_Service $catalog_service
	) {
		$this->logger = $logger;
		$this->data_management_catalogs_api_factory = $data_management_catalogs_api_factory;
		$this->catalog_service = $catalog_service;
	}

	public function send_event($post_id)
	{
		if (!Tracking_Service::is_event_enabled(self::EVENT_NAME)) {
			return;
		}

		$post = get_post($post_id);
		if(is_null($post) || strpos($post->post_type, 'product') === false){
			return;
		}

		/**
		 * @var \WC_Product $product
		 */
		$product = wc_get_product($post_id);
		if(empty($product->get_sku())){
			return;
		}

		try {
			$catalog_id = $this->catalog_service->get_catalog_id();
			$product_items = Product_Service::prepare_items($product);
			$items = \GuzzleHttp\json_encode($product_items);

			list($body, $status_code, $headers) = $this->data_management_catalogs_api_factory->create()->addItemsBatchWithHttpInfo($catalog_id, $items);
			return $status_code;
		} catch (\Exception $e) {
			if ($e->getCode() === 404) {
                $this->logger->warning(Logger_Service::addExceptionToMessage('Catalog with id: '.$catalog_id.' not found', $e));

				$catalog_name = Synerise_For_Woocommerce::get_setting('data_catalog_name');
				$this->catalog_service->get_catalog_id_by_name($catalog_name);
				$this->send_event($post_id);
			} else {
                $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Api request failed', $e));
			}
		}

	}
}
