<?php

namespace Synerise\Integration\Service;

use WP_Comment;

class Review_Service
{

    public static function get_review_data(WP_Comment $comment): array
    {
        $comment_meta = get_comment_meta($comment->comment_ID);
        $product = wc_get_product($comment->comment_post_ID);

        $params = [
            'itemKey' => Product_Service::get_item_key($product),
            'sku' => $product->get_data()['sku'],
            'detail' => $comment->comment_content,
            'applicationName' => Tracking_Service::APPLICATION_NAME,
        ];

        if (!empty($product->get_data()['sku'])) {
            $params['productSku'] = $product->get_data()['sku'];
        }

        if (!empty($comment->comment_author)) {
            $params['nickname'] = $comment->comment_author;
        }

        if (isset($comment_meta['rating'][0])) {
            $params['rating'] = $comment_meta['rating'][0];
        }

        return $params;
    }

}