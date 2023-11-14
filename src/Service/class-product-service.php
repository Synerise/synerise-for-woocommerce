<?php

namespace Synerise\Integration\Service;

use Synerise\Integration\Synerise_For_Woocommerce;
use WC_Product;
use WC_Product_Data_Store_CPT;
use WC_Product_Variable;
use WC_Product_Variation;
use WP_Query;
use WP_Term;

class Product_Service
{
    const PRODUCT_DEFAULT_PROPERTIES = array(
        array('value' => 'date_created', 'label' => 'Date created', 'type' => 'property'),
        array('value' => 'short_description', 'label' => 'Short description', 'type' => 'property'),
        array('value' => 'regular_price', 'label' => 'Regular price', 'type' => 'property'),
        array('value' => 'sale_price', 'label' => 'Sale price', 'type' => 'property'),
        array('value' => 'stock_status', 'label' => 'Stock status', 'type' => 'property'),
        array('value' => 'featured', 'label' => 'Featured', 'type' => 'property'),
        array('value' => 'image_id', 'label' => 'Image', 'type' => 'property'),
        array('value' => 'category_ids', 'label' => 'Categories', 'type' => 'property'),
        array('value' => 'tag_ids', 'label' => 'Tags', 'type' => 'property'),
        array('value' => 'height', 'label' => 'Height', 'type' => 'property'),
        array('value' => 'length', 'label' => 'Length', 'type' => 'property'),
        array('value' => 'weight', 'label' => 'Weight', 'type' => 'property'),
        array('value' => 'average_rating', 'label' => 'Average rating', 'type' => 'property')
    );

    public static function prepare_items(WC_Product $product): array
    {
        $items = [];
        $items[] = self::get_add_item($product);

        $wp_query = new WP_Query([
            'post_parent' => $product->get_id(),
            'post_type' => 'product_variation',
            'post_status' => get_post_stati()
        ]);

        $children = wp_list_pluck($wp_query->posts, 'ID');
        foreach ($children as $child) {
            $items[] = self::get_add_item(wc_get_product($child));
        }

        return $items;
    }

    public static function get_add_item(WC_Product $product): array
    {
        $params = [
            'itemName' => $product->get_name(),
            'itemType' => $product->get_type(),
            'itemUrl' => $product->get_permalink(),
            'itemPrice' => $product->get_price(),
            'itemId' => self::get_item_key($product)
        ];

        $params['itemVisibility'] = self::get_item_visibility($product);

        if ($product instanceof WC_Product_Variation) {
            $parent = wc_get_product($product->get_parent_id());
            $parentKey = self::get_item_key($parent);
            if (!empty($parentKey)) {
                $params['parentId'] = $parentKey;
            }
        }

        $selected_options = Synerise_For_Woocommerce::get_setting('data_products_attributes');
        foreach ($selected_options as $option) {
            if ($option['type'] === 'property') {
                self::add_property($product, $option, $params);
            } else {
                self::add_attribute($product, $option, $params);
            }
        }

        $params['deleted'] = ($product->get_status() === 'trash') ? 1 : 0;

        return [
            'itemKey' => (string)self::get_item_key($product),
            'value' => $params
        ];
    }

    public static function get_item_key(WC_Product $product)
    {
        if (self::is_sku_item_key()) {
            return $product->get_data()['sku'];
        }

        return $product->get_id();
    }

    public static function is_sku_item_key(): bool
    {
        return (bool)Synerise_For_Woocommerce::get_setting('data_products_sku_enabled');
    }

    public static function get_item_visibility(WC_Product $product): bool
    {
        $parent_data = method_exists($product, 'get_parent_data');
        if ($parent_data) {
            $result = $product->get_parent_data()['status'] === 'publish';
        } else {
            $result = $product->get_status() === 'publish';
        }

        return $result;
    }

    public static function add_property(WC_Product $product, array $option, array &$params)
    {
        $property_name = $option['value'];
        switch ($property_name) {
            case in_array($property_name, ['category_ids', 'tag_ids']):
                self::get_categories_or_tags($product, $option, $params);
                break;
            case 'image_id':
                self::get_item_image($product, $params);
                break;
            default:
                $name = self::to_camel_case('item' . $option['label']);
                $value = call_user_func([$product, 'get_' . $option['value']]);
                $params[$name] = $value;
                break;
        }
    }

    private static function get_categories_or_tags(WC_Product $product, $option, array &$params)
    {
        $taxonomy = 'product_cat';
        if ($option['value'] === 'tag_ids') {
            $taxonomy = 'product_tag';
        }

        $categories = self::get_as_name_array($product->get_id(), $taxonomy);
        $parent = wc_get_product($product->get_parent_id());
        if ($parent !== false) {
            $categories = self::get_as_name_array($parent->get_id(), $taxonomy);
        }

        $params['item' . $option['label']] = $categories;
    }

    public static function get_as_name_array(int $post_id, string $taxonomy): array
    {
        $array = [];
        $terms = get_the_terms($post_id, $taxonomy);
        if ($terms) {
            foreach ($terms as $term) {
                $ancestors = get_ancestors($term->term_id, $taxonomy);
                $ancestors = array_reverse($ancestors);

                foreach ($ancestors as $ancestor) {
                    $ancestor = get_term($ancestor, $taxonomy);

                    if (!is_wp_error($ancestor) && $ancestor) {
                        $array[$term->term_id][] = $ancestor->name;
                    }
                }

                $array[$term->term_id][] = $term->name;
                $array[$term->term_id] = implode(' > ', $array[$term->term_id]);
            }
        }


        return array_values($array);
    }

    private static function get_item_image(WC_Product $product, array &$params)
    {
        if (has_post_thumbnail($product->get_id())) {
            $img_src_arr = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'full');
            $img_src = $img_src_arr[0];
        } else {
            $img_src = apply_filters('woocommerce_placeholder_img_src', WC()->plugin_url() . '/assets/images/placeholder.png');
        }

        $params['itemImage'] = $img_src;
    }

    public static function to_camel_case(string $string, bool $capitalize_first_character = false): string
    {
        $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));

        if (!$capitalize_first_character) {
            $str[0] = strtolower($str[0]);
        }

        return $str;
    }

    public static function add_attribute(WC_Product $product, array $option, array &$params)
    {
        $product_all_attributes = $product->get_attributes();

        if (isset($product_all_attributes[$option['value']])) {
            $attribute = $product_all_attributes[$option['value']];

            if (gettype($attribute) === 'object') {
                $attribute_options = wc_get_product_terms($product->get_id(), $option['value']);
                /** @var WP_Term $attribute_option */
                foreach ($attribute_options as $attribute_option) {
                    $params['itemAttributes:' . $option['label']][] = $attribute_option->name;
                }
            } else {
                $params['itemAttributes:' . $option['label']] = $attribute;
            }
        }
    }

    public static function get_product_attributes(): array
    {
        $product_attributes = array();
        $attribute_taxonomies = wc_get_attribute_taxonomies();
        foreach ($attribute_taxonomies as $attribute) {
            $product_attributes[] = array(
                'label' => $attribute->attribute_label,
                'value' => wc_attribute_taxonomy_name($attribute->attribute_name),
                'type' => 'attribute'
            );
        }


        return array_merge(self::PRODUCT_DEFAULT_PROPERTIES, $product_attributes);
    }

    public static function get_products_count()
    {
        $args = array(
            'post_type' => array('product', 'product_variation'),
            'post_status' => array('publish', 'draft', 'pending', 'trash', 'private', 'auto-draft', 'wc-processing', 'inherit'),
        );

        if (self::is_sku_item_key()) {
            $args['meta_key'] = '_sku';
            $args['meta_query'] = array(
                array(
                    'key' => '_sku',
                    'compare' => 'EXISTS',
                ),
            );
        }

        $products = new WP_Query($args);

        return $products->found_posts;
    }

    public static function get_product_default_variation(WC_Product_Variable $product_variable)
    {
        $is_default_variation = false;

        foreach ($product_variable->get_available_variations() as $variation_values) {
            foreach ($variation_values['attributes'] as $key => $attribute_value) {
                $attribute_name = str_replace('attribute_', '', $key);
                $default_value = $product_variable->get_variation_default_attribute($attribute_name);
                if ($default_value == $attribute_value) {
                    $is_default_variation = true;
                    break;
                } else {
                    $is_default_variation = false;
                }
            }

            if ($is_default_variation) {
                $variation_id = $variation_values['variation_id'];
                break;
            }
        }

        return $is_default_variation ? wc_get_product($variation_id) : false;
    }

    /**
     * Find matching product variation
     *
     * @param WC_Product_Variable $product
     * @param $attributes
     * @return WC_Product_Variation|false
     */
    public static function find_matching_product_variation_id(WC_Product_Variable $product, $attributes)
    {
        $product_data_store = new WC_Product_Data_Store_CPT();
        $product_variation_id = $product_data_store->find_matching_product_variation($product, $attributes);

        if ($product_variation_id) {
            return wc_get_product($product_variation_id);
        }

        return false;
    }

    public static function get_product_image($product)
    {
        if ($product instanceof WC_Product_Variation) {
            $parent_id = $product->get_parent_id();
        }

        if (has_post_thumbnail($product->get_id())) {
            $img_src_arr = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'full');
            $img_src = $img_src_arr[0];
        } elseif (isset($parent_id) && has_post_thumbnail($parent_id)) {
            $img_src_arr = wp_get_attachment_image_src(get_post_thumbnail_id($parent_id), 'full');
            $img_src = $img_src_arr[0];
        } else {
            $img_src = apply_filters('woocommerce_placeholder_img_src', WC()->plugin_url() . '/assets/images/placeholder.png');
        }

        return $img_src;
    }
}
