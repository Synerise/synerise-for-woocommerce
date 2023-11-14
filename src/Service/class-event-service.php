<?php

namespace Synerise\Integration\Service;

use Exception;
use Psr\Log\LoggerInterface;
use Synerise\DataManagement\ApiException;
use Synerise\Integration\Event\Event_Add_To_Cart;
use Synerise\Integration\Event\Event_Cart_Status;
use Synerise\Integration\Event\Event_Client_Login;
use Synerise\Integration\Event\Event_Client_Logout;
use Synerise\Integration\Event\Event_Client_Register;
use Synerise\Integration\Event\Event_Order_Placed;
use Synerise\Integration\Event\Event_Product_Review;
use Synerise\Integration\Event\Event_Product_Trash_Untrash;
use Synerise\Integration\Event\Event_Removed_From_Cart;
use Synerise\Integration\Logger_Service;
use Synerise\Integration\Synchronization\DataStore\History_Data_Store;
use Synerise\Integration\Synchronization\History_Data;
use Synerise\Integration\Synchronization\Scheduler\Customer_Scheduler;
use Synerise\Integration\Synchronization\Scheduler\Order_Scheduler;
use Synerise\Integration\Synerise_For_Woocommerce;
use Synerise\IntegrationCore\Exception\ApiConfigurationException;
use Synerise\IntegrationCore\Factory\ClientManagementApiFactory;
use Synerise\IntegrationCore\Factory\DataManagementApiFactory;
use Synerise\IntegrationCore\Factory\DataManagementCatalogsApiFactory;
use WC_Data_Store;

class Event_Service
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var ClientManagementApiFactory
     */
    private $client_management_api_factory;

    /**
     * @var DataManagementApiFactory
     */
    private $data_management_api_factory;

    /**
     * @var DataManagementCatalogsApiFactory
     */
    private $data_management_catalogs_api_factory;

    /**
     * @var Catalog_Service
     */
    private $catalog_service;

    public function __construct(
        LoggerInterface                  $logger,
        ClientManagementApiFactory       $client_management_api_factory,
        DataManagementApiFactory         $data_management_api_factory,
        DataManagementCatalogsApiFactory $data_management_catalogs_api_factory,
        Catalog_Service                  $catalog_service
    )
    {
        $this->logger = $logger;
        $this->client_management_api_factory = $client_management_api_factory;
        $this->data_management_api_factory = $data_management_api_factory;
        $this->data_management_catalogs_api_factory = $data_management_catalogs_api_factory;
        $this->catalog_service = $catalog_service;
    }

    /**
     * @throws ApiConfigurationException
     * @throws ApiException
     */
    public function send_event(string $event_name, $payload, int $entityId = null)
    {
        try {
            $apiInstance = $this->data_management_api_factory->create();

            switch ($event_name) {
                case Event_Add_To_Cart::EVENT_NAME:
                    return $apiInstance->clientAddedProductToCartWithHttpInfo($payload, '4.4');
                case Event_Removed_From_Cart::EVENT_NAME:
                    return $apiInstance->clientRemovedProductFromCartWithHttpInfo($payload, '4.4');
                case Event_Product_Review::EVENT_NAME:
                case Event_Cart_Status::EVENT_NAME:
                    return $apiInstance->customEventWithHttpInfo('4.4', $payload);
                case Event_Client_Register::EVENT_NAME:
                    return $apiInstance->clientRegisteredWithHttpInfo('4.4', $payload);
                case Event_Client_Login::EVENT_NAME:
                    return $apiInstance->clientLoggedInWithHttpInfo('4.4', $payload);
                case Event_Client_Logout::EVENT_NAME:
                    return $apiInstance->clientLoggedOutWithHttpInfo('4.4', $payload);
                case Event_Order_Placed::EVENT_NAME:
                    list($body, $response_code, $headers) = $apiInstance
                        ->createATransactionWithHttpInfo($payload, '4.4');
                    if ($response_code != 202) {
                        $this->logger->error('Create transaction event failed');
                    } elseif ($entityId) {
                        $this->mark_item_as_sent(Order_Scheduler::MODEL, $entityId);
                    }
                    return [$body, $response_code, $headers];
                case Event_Product_Trash_Untrash::EVENT_NAME:
                    return $this->send_product_update($payload);
                case 'ADD_OR_UPDATE_CLIENT':
                    list($body, $response_code, $headers) = $this->client_management_api_factory->create()
                        ->batchAddOrUpdateClientsWithHttpInfo($payload, 'application/json', '4.4');
                    if ($response_code != 202) {
                        $this->logger->error('Client update failed');
                    } elseif ($entityId) {
                        $this->mark_item_as_sent(Customer_Scheduler::MODEL, $entityId);
                    }
                    return [$body, $response_code, $headers];
            }
        } catch (ApiException $e) {
            $this->logger->error('Synerise Api request failed', ['exception' => $e, 'api_response_body' => $e->getResponseBody()]);
            throw $e;
        }
    }

    /**
     * @param $model
     * @param $entity_id
     * @return void
     * @throws Exception
     */
    private function mark_item_as_sent($model, $entity_id)
    {
        /** @var History_Data_Store $data_store */
        $data_store = WC_Data_Store::load('synerise-sync-history');

        $history_item = new History_Data();
        $history_item->set_model($model);
        $history_item->set_entity_id($entity_id);

        $data_store->create($history_item);
    }

    /**
     * @throws ApiConfigurationException
     * @throws ApiException
     */
    public function send_product_update($items)
    {
        try {
            $catalog_id = $this->catalog_service->get_catalog_id();
            return $this->data_management_catalogs_api_factory->create()->addItemsBatchWithHttpInfo($catalog_id, $items);
        } catch (Exception $e) {
            if ($e->getCode() === 404) {
                $this->logger->warning(Logger_Service::addExceptionToMessage('Catalog with id: ' . $catalog_id . ' not found', $e));

                $catalog_name = Synerise_For_Woocommerce::get_setting('data_catalog_name');
                $catalog_id = $this->catalog_service->get_catalog_id_by_name($catalog_name);
                $this->data_management_catalogs_api_factory->create()->addItemsBatchWithHttpInfo($catalog_id, $items);
            } else {
                throw $e;
            }
        }
    }
}
