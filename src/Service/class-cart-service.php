<?php

namespace Synerise\Integration\Service;

class Cart_Service
{

	const EVENT_ADDED = 'added';
	const EVENT_REMOVED = 'removed';


    public static function prepare_add_to_cart_product_data(string $cart_item_key, $quantity = null): array
    {
        $cart_item = WC()->cart->get_cart_item($cart_item_key);

        /** @var \WC_Product $product */
        $product = wc_get_product($cart_item['product_id']);

        $product_data = self::get_default_product_data($product);

		if($quantity !== null){
			$product_data = array_merge($product_data, [
				'quantity' => $quantity,
			]);
		}

        return $product_data;
    }

    public static function prepare_remove_from_cart_product_data(\WC_Cart $cart, string $cart_item_key): array
    {
	    $removed_product_data = $cart->get_removed_cart_contents()[$cart_item_key];

        /** @var \WC_Product $product */
        $product = wc_get_product($removed_product_data['product_id']);

        $default_data = self::get_default_product_data($product);

        return array_merge($default_data, [
            'quantity' => $removed_product_data['quantity']
        ]);
    }

    public static function get_default_product_data(\WC_Product $product): array
    {
        $product_id = $product->get_id();
        $product_sku = $product->get_sku();

        $data =  [
            "name" => $product->get_name(),
            "regularUnitPrice" => [
                "amount"=> (float) $product->get_regular_price(),
                "currency"=> get_woocommerce_currency()
            ],
            "finalUnitPrice" => [
                "amount" => (float) $product->get_price(),
                "currency" => get_woocommerce_currency()
            ],
            "url" => $product->get_permalink(),
            "offline" => false,
            'sku' => $product_sku,
            'categories' => Product_Service::get_as_name_array($product_id, 'product_cat')
        ];

	    if ($product->get_type() == 'variation') {
		    $parent_data = $product->get_parent_data();
		    if(!empty($parent_data['sku'])){
			    $data['parentSku'] = $parent_data['sku'];
		    }
	    }

		return $data;
    }

    public static function prepare_cart_status_params(\WC_Cart $cart): array
    {
        $products = [];
        $total_qty = 0;
        $total_amount = 0;
        $items = $cart->get_cart_contents();

        foreach ($items as $key => $data) {
			$product = wc_get_product($data['product_id']);
			if(empty($product->get_sku())){
				continue;
			}
	        for($i = 0; $i < $data['quantity']; $i++){
		        $total_amount += $product->get_sale_price();
	        }
	        $total_qty += $data['quantity'];
            $products[] = self::prepare_add_to_cart_product_data($key, $data['quantity']);
        }

        return [
            'products' => $products,
            'totalAmount' => $total_amount,
            'totalQty' => $total_qty
        ];
    }

	public static function cart_item_has_sku($cart_item_key, $event = 'added'): bool {
		$cart = WC()->cart;

		if($event === 'added'){
			$cart_item = $cart->get_cart_item($cart_item_key);
		} else {
			$cart_item = $cart->get_removed_cart_contents()[$cart_item_key];
		}

		$product = wc_get_product($cart_item['product_id']);
		return !empty($product->get_sku());
	}
}
