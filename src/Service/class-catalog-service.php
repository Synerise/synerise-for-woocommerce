<?php

namespace Synerise\Integration\Service;

use Synerise\DataManagement\ApiException;
use Synerise\Integration\Synerise_For_Woocommerce;
use Synerise\IntegrationCore\Exception\ApiConfigurationException;
use Synerise\IntegrationCore\Factory\DataManagementCatalogsApiFactory;

class Catalog_Service
{
    /**
     * @var DataManagementCatalogsApiFactory
     */
    private $data_management_catalogs_api_factory;

    public function __construct()
    {
        $this->data_management_catalogs_api_factory = Synerise_For_Woocommerce::get_data_management_catalogs_api_factory();
    }

    /**
     * @throws ApiConfigurationException
     * @throws ApiException
     */
    public function get_catalog_id(): int
    {
        $catalogData = Synerise_For_Woocommerce::get_setting('catalog');
        $catalogName = Synerise_For_Woocommerce::get_setting('data_catalog_name');
        if ($catalogData && $catalogData['name'] === $catalogName) {
            return Synerise_For_Woocommerce::get_setting('catalog')['id'];
        }

        return $this->get_catalog_id_by_name($catalogName);
    }

    /**
     * @throws ApiConfigurationException
     * @throws ApiException
     */
    public function get_catalog_id_by_name($catalog_name): int
    {
        $catalog = $this->find_existing_catalog_by_store_name($catalog_name);
        $catalog_id = null;
        if ($catalog) {
            $catalog_id = $catalog->getId();
            Synerise_For_Woocommerce::save_setting('catalog', [
                'id' => $catalog_id,
                'name' => $catalog_name
            ]);
        }

        return $catalog_id ? $catalog_id : $this->add_catalog($catalog_name);
    }

    /**
     * @throws ApiConfigurationException
     * @throws ApiException
     */
    public function find_existing_catalog_by_store_name($catalog_name)
    {
        $get_bags_response = $this->data_management_catalogs_api_factory->create()->getBags($catalog_name);

        $existing_bags = $get_bags_response->getData();
        foreach ($existing_bags as $bag) {
            if ($bag->getName() == $catalog_name) {
                return $bag;
            }
        }

        return null;
    }

    /**
     * @throws ApiConfigurationException
     * @throws ApiException
     */
    public function add_catalog($catalog_name): int
    {
        $add_bag_request = \GuzzleHttp\json_encode([
            'name' => $catalog_name
        ]);

        $response = $this->data_management_catalogs_api_factory->create()->addBagWithHttpInfo($add_bag_request);
        $catalog_id = $response[0]->getData()->getId();

        Synerise_For_Woocommerce::save_setting('catalog', [
            'id' => $catalog_id,
            'name' => $catalog_name
        ]);

        return $catalog_id;
    }

    public function delete_catalog($catalog_id)
    {
        list($response, $status, $headers) = $this->data_management_catalogs_api_factory->create()->deleteBagByIdWithHttpInfo($catalog_id);

        if ($status === 200) {
            Synerise_For_Woocommerce::remove_setting('catalog');
        }

        return [$response, $status, $headers];
    }
}
