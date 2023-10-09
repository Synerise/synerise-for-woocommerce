<?php
namespace Synerise\Integration\Event;

use Synerise\Integration\Logger_Service;
use Synerise\Integration\Mapper\Client_Action;
use Synerise\Integration\Service\Product_Service;
use Synerise\Integration\Service\Review_Service;

if (! defined('ABSPATH')) {
	exit;
}

class Event_Product_Review extends Abstract_Event
{
	const HOOK_NAME = 'comment_post';
	const EVENT_NAME = 'product_review';

	public function execute($comment_id) {
        if (!$this->is_event_enabled()) {
            return;
        }

        $comment = get_comment($comment_id);
		$post = get_post($comment->comment_post_ID);

		if(is_null($post) || strpos($post->post_type, 'product') === false) {
			return;
		}

		$product = wc_get_product($comment->comment_post_ID);
		if(empty(Product_Service::get_item_key($product))){
			return;
		}

        if(!$this->tracking_manager->getClientUuid() && empty($comment->comment_author_email)) {
            return;
        }

		try {
            $this->process_event($this->prepare_event($comment));
		} catch (\Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Event processing failed', $e));
		}
	}

    public function prepare_event($comment)
    {
        $uuid = $this->tracking_manager->getClientUuid();

        $client = [];
        if($comment->user_id == 0){
            if(!empty($comment->comment_author_email) || !empty($comment->comment_author)) {
                $client_data = [];

                if ( ! empty( $comment->comment_author_email ) ) {
                    $uuid = $this->tracking_manager->manageClientUuid( $comment->comment_author_email );
                    $client_data['email'] = $comment->comment_author_email;
                }

                if ( ! empty( $comment->comment_author ) ) {
                    $client_data['displayName'] = $comment->comment_author;
                }

                if ($uuid) {
                    $client_data['uuid'] = $uuid;
                    $this->process_client_update(\GuzzleHttp\json_encode([$client_data]));
                }
            }
        } else {
            $client['custom_id'] = $comment->user_id;
        }

        if ($uuid) {
            $client['uuid'] = $uuid;
        }

        $params = Review_Service::get_review_data($comment);

        return \GuzzleHttp\json_encode(array_filter([
            'time' => Client_Action::get_time(new \DateTime()),
            'label' => Client_Action::get_label(self::EVENT_NAME),
            'action' => 'product.addReview',
            'client' => $client,
            'params' => $params
        ]));
    }
}