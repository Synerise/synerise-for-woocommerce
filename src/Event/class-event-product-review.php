<?php
namespace Synerise\Integration\Event;

use Psr\Log\LoggerInterface;
use Synerise\Integration\Logger_Service;
use Synerise\Integration\Mapper\Client_Action;
use Synerise\Integration\Service\Product_Service;
use Synerise\Integration\Service\Review_Service;
use Synerise\IntegrationCore\Factory\DataManagementApiFactory;
use Synerise\IntegrationCore\Tracking;

if (! defined('ABSPATH')) {
	exit;
}

class Event_Product_Review {

	const HOOK_NAME = 'comment_post';
	const EVENT_NAME = 'product_review';

	private $logger;

	private $tracking_manager;

	private $data_management_api_factory;


	public function __construct(
		LoggerInterface $logger,
		Tracking $tracking_manager,
		DataManagementApiFactory $data_management_api_factory
	) {
		$this->logger = $logger;
		$this->tracking_manager = $tracking_manager;
		$this->data_management_api_factory = $data_management_api_factory;
	}

	public function send_event($comment_id) {
		$comment = get_comment($comment_id);
		$post = get_post($comment->comment_post_ID);

		if(is_null($post) || strpos($post->post_type, 'product') === false) {
			return;
		}

		$product = wc_get_product($comment->comment_post_ID);
		if(empty(Product_Service::get_item_key($product))){
			return;
		}

		try {
			$client = [];
			if($comment->user_id === 0){
				if(!empty($comment->comment_author_email) || !empty($comment->comment_author)) {
					$create_client_data = [];

					if ( ! empty( $comment->comment_author_email ) ) {
						$this->tracking_manager->manageClientUuid( $comment->comment_author_email );
						$create_client_data['email'] = $comment->comment_author_email;
					}

					if ( ! empty( $comment->comment_author ) ) {
						$create_client_data['displayName'] = $comment->comment_author;
					}

					$create_client_data['uuid'] = $this->tracking_manager->getClientUuid();

					try{
						$company_clients_body = \GuzzleHttp\json_encode([
							'time' => Client_Action::get_time(new \DateTime()),
							'label' => Client_Action::get_label(self::EVENT_NAME),
							'client' => $create_client_data
						]);

						$this->data_management_api_factory->create()->clientRegisteredWithHttpInfo('4.4', $company_clients_body);
					} catch (\Exception $e) {
                        $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Api request failed', $e));
					}
				}
			} else {
				$client['custom_id'] = $comment->user_id;
			}

			$client['uuid'] = $this->tracking_manager->getClientUuid();

			$params = Review_Service::get_review_data($comment);
			$event_added_review_body = \GuzzleHttp\json_encode(array_filter([
				'time' => Client_Action::get_time(new \DateTime()),
				'label' => Client_Action::get_label(self::EVENT_NAME),
				'action' => 'product.addReview',
				'client' => $client,
				'params' => $params
			]));

			list($body, $status_code, $headers) = $this->data_management_api_factory->create()->customEventWithHttpInfo('4.4', $event_added_review_body);
			return $status_code;
		} catch (\Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Api request failed', $e));
		}

	}

}