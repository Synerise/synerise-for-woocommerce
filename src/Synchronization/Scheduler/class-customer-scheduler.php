<?php

namespace Synerise\Integration\Synchronization\Scheduler;

use Exception;
use Psr\Log\LoggerInterface;
use Synerise\DataManagement\ApiException;
use Synerise\Integration\Logger_Service;
use Synerise\Integration\Service\Client_Service;
use Synerise\Integration\Service\User_Service;
use Synerise\Integration\Synerise_For_Woocommerce;
use Synerise\IntegrationCore\Exception\ApiConfigurationException;
use Synerise\IntegrationCore\Factory\ClientManagementApiFactory;
use WC_Customer;

class Customer_Scheduler extends Abstract_Scheduler
{
    const MODEL = 'customer';
    const ENTITY_ID = 'entity_id';

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var ClientManagementApiFactory
     */
    private $client_management_api_factory;

    public function __construct(
        LoggerInterface            $logger,
        ClientManagementApiFactory $client_management_api_factory
    )
    {
        $this->logger = $logger;
        $this->client_management_api_factory = $client_management_api_factory;
    }

    /**
     * @throws Exception
     */
    public function send_items(array $collection)
    {
        if (empty($collection)) {
            return;
        }

        $event_add_or_update_clients_body = [];
        $customers_ids = [];

        foreach ($collection as $customer_id) {
            if (!User_Service::is_user_customer($customer_id)) {
                continue;
            }

            $customer_user = new WC_Customer($customer_id);

            $event_add_or_update_clients_body[] = Client_Service::prepare_client_params($customer_user);
            $customers_ids[] = $customer_id;
        }

        if (!empty($event_add_or_update_clients_body)) {
            list ($body, $statusCode, $headers) = $this->send_customers_to_synerise(\GuzzleHttp\json_encode($event_add_or_update_clients_body));

            if ($statusCode == 207) {
                $this->logger->warning('Request partially accepted: ' . $body);
            } elseif ($statusCode != 202) {
                throw new ApiException(
                    sprintf('Invalid Status [%d]', $statusCode),
                    $statusCode,
                    $headers,
                    $body
                );
            }

            $this->mark_items_as_sent($customers_ids);
            return $statusCode;
        }

        return null;
    }


    /**
     * @param $event_add_or_update_clients_body
     * @return array
     * @throws ApiException
     * @throws ApiConfigurationException
     */
    public function send_customers_to_synerise($event_add_or_update_clients_body)
    {
        try {
            return $this->client_management_api_factory->create()
                ->batchAddOrUpdateClientsWithHttpInfo($event_add_or_update_clients_body, 'application/json', '4.4');

        } catch (Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Api request failed', $e));
            throw $e;
        }
    }

    public function get_current_last_id()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'users';
        return $wpdb->get_var("SELECT ID FROM {$table_name} WHERE 1=1 ORDER BY ID DESC LIMIT 1");
    }

    public function get_collection_filtered_by_id_range($start_id, $stop_id, $page_size): array
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'users';
        $sql = $wpdb->prepare("SELECT ID FROM {$table_name} WHERE ID <= %d AND ID > %d ORDER BY ID ASC LIMIT %d", [$stop_id, $start_id, $page_size]);
        return $wpdb->get_col($sql);
    }

    public function is_enabled(): bool
    {
        return (bool)Synerise_For_Woocommerce::get_setting('data_customers_enabled');
    }

}
