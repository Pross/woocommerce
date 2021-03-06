<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WC Product Data Store Interface
 *
 * Functions that must be defined by product store classes.
 *
 * @version  2.7.0
 * @category Interface
 * @author   WooThemes
 */
interface WC_Product_Data_Store_Interface {

	/**
	 * Returns an array of on sale products, as an array of objects with an
	 * ID and parent_id present. Example: $return[0]->id, $return[0]->parent_id.
	 *
	 * @return array
	 */
	public function get_on_sale_products();

	/**
	 * Returns a list of product IDs ( id as key => parent as value) that are
	 * featured. Uses get_posts instead of wc_get_products since we want
	 * some extra meta queries and ALL products (posts_per_page = -1).
	 *
	 * @return array
	 */
	public function get_featured_product_ids();

	/**
	 * Check if product sku is found for any other product IDs.
	 *
	 * @param int $product_id
	 * @param string $sku
	 * @return bool
	 */
	public function is_existing_sku( $product_id, $sku );

	/**
	 * Return product ID based on SKU.
	 *
	 * @param string $sku
	 * @return int
	 */
	public function get_product_id_by_sku( $sku );

	/**
	 * Returns an array of IDs of products that have sales starting soon.
	 *
	 * @return array
	 */
	public function get_starting_sales();

	/**
	 * Returns an array of IDs of products that have sales which are due to end.
	 *
	 * @return array
	 */
	public function get_ending_sales();

	/**
	 * Find a matching (enabled) variation within a variable product.
	 *
	 * @param  WC_Product $product Variable product.
	 * @param  array $match_attributes Array of attributes we want to try to match.
	 * @return int Matching variation ID or 0.
	 */
	public function find_matching_product_variation( $product, $match_attributes = array() );

	/**
	 * Return a list of related products (using data like categories and IDs).
	 *
	 * @param array $cats_array  List of categories IDs.
	 * @param array $tags_array  List of tags IDs.
	 * @param array $exclude_ids Excluded IDs.
	 * @param int   $limit       Limit of results.
	 * @param int   $product_id
	 * @return array
	 */
	public function get_related_products( $cats_array, $tags_array, $exclude_ids, $limit, $product_id );

	/**
	 * Update a product's stock amount directly.
	 *
	 * Uses queries rather than update_post_meta so we can do this in one query (to avoid stock issues).
	 *
	 * @param  int
	 * @param  int|null $stock_quantity
	 * @param  string $operation set, increase and decrease.
	 */
	function update_product_stock( $product_id_with_stock, $stock_quantity = null, $operation = 'set' );
}
