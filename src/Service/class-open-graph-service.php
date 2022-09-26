<?php
/**
 * Synerise for WooCommerce OpenGraph tags
 *
 * @package     Synerise/Integration/
 * @version     1.0.0
 */

namespace Synerise\Integration\Service;

use Synerise\Integration\Synerise_For_Woocommerce;

if (! defined('ABSPATH')) {
	exit;
}

class Open_Graph_Service
{
	public static function is_open_graph_enabled()
	{
		return (bool) Synerise_For_Woocommerce::get_setting('page_tracking_open_graph_enabled');
	}

	public static function print_tags()
	{
		if (class_exists('woocommerce') && is_woocommerce()) {
			if (is_product()) {
				self::print_product_tags();
			} elseif (is_product_category()) {
				self::print_category_tags();
			}
		}
	}

	protected static function print_category_tags()
	{
		$category = get_queried_object();
		$category_link = get_category_link($category->term_id);
		if (is_product_category($category->slug)) {
			$thumbnail_id = get_woocommerce_term_meta($category->term_id, 'thumbnail_id', true);
			$image = wp_get_attachment_url($thumbnail_id);

			if (!empty($image)) {
				$img_src = $image;
			} else {
				$img_src = apply_filters('woocommerce_placeholder_img_src', WC()->plugin_url() . '/assets/images/placeholder.png');
			} ?>
			<meta property="og:title" content="<?php echo $category->name; ?>" />
			<meta property="og:description" content="<?php echo $category->description; ?>" />
			<meta property="og:image" content="<?php echo esc_attr($img_src); ?>" />
			<meta property="og:type" content="product" />
			<meta property="og:url" content="<?php echo esc_url($category_link); ?>" />
			<meta property="og:site_name" content="<?php echo get_bloginfo(strip_tags('name')); ?>" />
			<?php
		}
	}

	protected static function print_product_tags()
	{
		global $post;

		if ($post->post_type == 'product') {
			$product = wc_get_product($post->ID);

            $categories = Product_Service::get_as_name_array($post->ID, 'product_cat');

			if (has_post_thumbnail($post->ID)) {
				$img_src_arr = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
				$img_src = $img_src_arr[0];
			} else {
				$img_src = apply_filters('woocommerce_placeholder_img_src', WC()->plugin_url() . '/assets/images/placeholder.png');
			} ?>

			<meta property="og:title" content="<?php echo esc_attr(get_the_title()); ?>" />
			<meta property="og:description" content="<?php echo get_the_excerpt(); ?>" />
			<meta property="og:image" content="<?php echo esc_attr($img_src); ?>" />
			<meta property="og:type" content="product" />
			<meta property="og:url" content="<?php echo get_permalink(); ?>" />
			<meta property="og:site_name" content="<?php echo get_bloginfo(strip_tags('name')); ?>" />
			<?php if(!empty($product->get_sku())) { ?>
                <meta property="product:retailer_part_no" content="<?php echo $product->get_sku(); ?>" />
                <meta property="product:price:amount" content="<?php echo $product->get_price(); ?>"/>
                <meta property="product:price:currency" content="<?php echo get_woocommerce_currency(); ?>" />
                <meta property="product:original_price:amount" content="<?php echo $product->get_regular_price(); ?>" />
                <meta property="product:original_price:currency" content="<?php echo get_woocommerce_currency(); ?>" />
                <?php foreach ($categories as $category) { ?>
                    <meta property="product:category" content="<?php echo $category ?>" />
                <?php } ?>
            <?php }
        }
    }
}