<?php
// Override WooCommerce variable add to cart function
if (!function_exists('woocommerce_variable_add_to_cart')) {

    /**
     * Output the variable product add to cart area.
     */
    function woocommerce_variable_add_to_cart()
    {
        global $product;

        // Enqueue variation scripts.
        wp_enqueue_script('wc-add-to-cart-variation');

        // Get Available variations?
        $get_variations = count($product->get_children()) <= apply_filters('woocommerce_ajax_variation_threshold', 30, $product);

        $params = array(
            'available_variations' => $get_variations ? $product->get_available_variations() : false,
            'attributes' => $product->get_variation_attributes(),
            'selected_attributes' => $product->get_default_attributes(),
        );

        if(xt_woovs_enabled_in_quick_views()) {

            $core = xt_woo_variation_swatches();

            $core->get_template('variable', apply_filters($core->plugin_short_prefix('woocommerce_variable_add_to_cart_template_args'), $params));

        }else{

            // Load default template.
            wc_get_template('single-product/add-to-cart/variable.php', $params);
        }
    }
}

// Override WooCommerce Composite add to cart function
if (!function_exists('wc_cp_composited_product_details_variable')) {

    /**
     * Composited Variable product details template.
     *
     * @param  WC_Product            $product
     * @param  string                $component_id
     * @param  WC_Product_Composite  $composite
     */
    function wc_cp_composited_product_details_variable( $product, $component_id, $composite  ) {

        $core = xt_woo_variation_swatches();
        $product_variations = $core->frontend()->get_product_variations($product);

        if ( ! $product_variations ) {

            ?><div class="component_data" data-component_set="false" data-price="0" data-regular_price="0" data-product_type="unavailable-product">
            <?php _e( 'This item is currently unavailable.', 'woocommerce-composite-products' ); ?>
            </div><?php

        } else {

            $product_id         = $product->get_id();
            $component          = $composite->get_component( $component_id );
            $composited_product = $component->get_option( $product_id );

            /** Documented in {@see wc_cp_composited_product_details_simple} */
            $custom_data = apply_filters( 'woocommerce_composited_product_custom_data', array( 'price_tax' => 1.0, 'image_data' => $composited_product->get_image_data() ), $product, $component_id, $component, $composite );

            $attributes     = $product->get_variation_attributes();
            $attribute_keys = array_keys( $attributes );

            $quantity_min = $composited_product->get_quantity_min();
            $quantity_max = $composited_product->get_quantity_max();

            $params = array(
                'product'            => $product,
                'product_variations' => $product_variations,
                'attributes'         => $attributes,
                'attribute_keys'     => $attribute_keys,
                'custom_data'        => $custom_data,
                'component_id'       => $component_id,
                'quantity_min'       => $quantity_min,
                'quantity_max'       => $quantity_max,
                'composited_product' => $composited_product,
                'composite_product'  => $composite
            );

            if(xt_woovs_enabled_in_quick_views()) {

                $core = xt_woo_variation_swatches();

                $core->get_template('composite-variable', apply_filters($core->plugin_short_prefix('woocommerce_composite_variable_add_to_cart_template_args'), $params));

            }else {

                // Load default template
                wc_get_template('composited-product/variable-product.php', $params, '', WC_CP()->plugin_path() . '/templates/');
            }
        }
    }
}
