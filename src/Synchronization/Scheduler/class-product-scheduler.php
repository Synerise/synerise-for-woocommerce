<?php

namespace Synerise\Integration\Synchronization\Scheduler;

use Psr\Log\LoggerInterface;
use Synerise\DataManagement\ApiException;
use Synerise\Integration\Logger_Service;
use Synerise\Integration\Synerise_For_Woocommerce;
use Synerise\IntegrationCore\Exception\ApiConfigurationException;
use Synerise\IntegrationCore\Factory\DataManagementCatalogsApiFactory;
use Synerise\Integration\Service\Catalog_Service;
use Synerise\Integration\Service\Product_Service;

class Product_Scheduler extends Abstract_Scheduler
{
    const MODEL = 'product';
    const ENTITY_ID = 'entity_id';

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
        DataManagementCatalogsApiFactory $data_management_catalogs_api_factory
    ) {
        $this->logger = $logger;
        $this->data_management_catalogs_api_factory = $data_management_catalogs_api_factory;
        $this->catalog_service = new Catalog_Service();
    }

    /**
     * @throws ApiException
     * @throws ApiConfigurationException
     */
    public function send_items(array $collection)
    {
        if (empty($collection)) {
            return;
        }

	    $products_ids = [];
	    $prepared_items = [];

        foreach ($collection as $product_id) {
            $product = wc_get_product($product_id);
			if(empty(Product_Service::get_item_key($product))){
				continue;
			}

            $products_ids[] = $product_id;
            $prepared_items[] = Product_Service::get_add_item($product);
        }

        if(!empty($prepared_items)) {
			$response_code = $this->send_products_to_synerise(\GuzzleHttp\json_encode($prepared_items));
            $this->mark_items_as_sent($products_ids);

			return $response_code;
        }
    }


    /**
     * @param $items
     * @throws ApiException|ApiConfigurationException
     */
    public function send_products_to_synerise($items)
    {
        $catalog_id = $this->catalog_service->get_catalog_id();

        try{
            list($body, $status_code, $headers) = $this->data_management_catalogs_api_factory->create()->addItemsBatchWithHttpInfo($catalog_id, $items);
			return $status_code;
        } catch (\Exception $e) {
            if ($e->getCode() === 404) {
                $this->logger->warning('Catalog with id: '.$catalog_id.' not found', ['exception' => $e]);
                $catalog_name = Synerise_For_Woocommerce::get_setting('data_catalog_name');
                $this->catalog_service->get_catalog_id_by_name($catalog_name);
                $this->send_products_to_synerise($items);
            } else {
                $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Api request failed', $e));
                throw $e;
            }
        }
    }

    public function get_collection_filtered_by_id_range($start_id, $stop_id, $page_size): array
    {
        global $wpdb;

		$table_name = $wpdb->prefix. 'posts';

        $sql = $wpdb->prepare("SELECT ID FROM {$table_name} WHERE ID <= %d AND ID > %d AND post_type IN ('product', 'product_variation') ORDER BY ID ASC LIMIT %d", [$stop_id, $start_id, $page_size]);

	    return $wpdb->get_col($sql);
    }

    public function get_current_last_id()
    {
        global $wpdb;

	    $table_name = $wpdb->prefix. 'posts';

        return $wpdb->get_var("SELECT ID FROM {$table_name} WHERE post_type IN ('product', 'product_variation') ORDER BY ID DESC LIMIT 1");
    }

    public function is_enabled(): bool
    {
        return (bool) Synerise_For_Woocommerce::get_setting('data_products_enabled');
    }
}
