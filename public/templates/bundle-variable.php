<?php

/**
 * This file is used to markup the bundled product variable add to cart.
 *
 * This template can be overridden by copying it to yourtheme/xt-woo-variation-swatches/bundle-variable.php.
 *
 * Available global vars:
 *
 * @var $bundle_id
 * @var $bundled_item
 * @var $bundled_product
 * @var $bundled_product_attributes
 * @var $bundled_product_variations
 * @var $custom_product_data
 * @var $bundled_product_id
 *
 * HOWEVER, on occasion we will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see         https://docs.xplodedthemes.com/article/127-template-structure
 * @author 		XplodedThemes
 * @package     XT_Woo_Variation_Swatches/Templates
 * @version     1.8.0
 */

$form_classes = xt_woo_variation_swatches()->frontend()->get_form_classes();
$wrap_classes = xt_woo_variation_swatches()->frontend()->get_wrap_classes();
?>

<div class="variations_form cart bundled_item_cart_content <?php echo esc_attr($form_classes); ?>" data-title="<?php echo esc_attr( $bundled_item->get_title() ); ?>" data-product_title="<?php echo esc_attr( $bundled_item->get_product()->get_title() ); ?>" data-visible="<?php echo $bundled_item->is_visible() ? 'yes' : 'no'; ?>" data-optional_suffix="<?php echo esc_attr( $bundled_item->get_optional_suffix() ); ?>" data-optional="<?php echo $bundled_item->is_optional() ? 'yes' : 'no'; ?>" data-type="<?php echo $bundled_product->get_type(); ?>" data-product_variations="<?php echo htmlspecialchars( json_encode( $bundled_product_variations ) ); ?>" data-bundled_item_id="<?php echo $bundled_item->get_id(); ?>" data-custom_data="<?php echo esc_attr( json_encode( $custom_product_data ) ); ?>" data-product_id="<?php echo $bundled_product_id; ?>" data-bundle_id="<?php echo $bundle_id; ?>" <?php echo $bundled_item->is_optional() && ! $bundled_item->is_optional_checked() ? 'style="display:none"' : ''; ?>>

    <div class="<?php echo esc_attr($wrap_classes); ?>">

        <table class="variations">
            <tbody><?php

            foreach ( $bundled_product_attributes as $attribute_name => $options ) {

                $is_attribute_value_configurable = $bundled_item->display_product_variation_attribute_dropdown( $attribute_name );

                ?>
                <tr class="attribute_options <?php echo $is_attribute_value_configurable ? 'attribute_value_configurable' : 'attribute_value_static' ; ?>" data-attribute="<?php echo esc_attr( sanitize_title( $attribute_name ) ) . '_' . $bundled_item->get_id(); ?>" data-attribute_label="<?php echo esc_attr( wc_attribute_label( $attribute_name ) ); ?>">
                    <td class="label">
                        <label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ) . '_' . $bundled_item->get_id(); ?>"><?php

                            echo wc_attribute_label( $attribute_name );

                            if ( $is_attribute_value_configurable ) {
                                ?> <abbr class="required" title="<?php _e( 'Required option', 'woocommerce-product-bundles' ); ?>">*</abbr><?php
                            }

                            ?></label>
                    </td>
                    <td class="value"><?php

                        echo wc_pb_template_bundled_variation_attribute_options( array(
                            'options'      => $options,
                            'attribute'    => $attribute_name,
                            'bundled_item' => $bundled_item
                        ) );

                        ?>
                    </td>
                </tr>
                <?php
            }

            ?></tbody>
        </table>
    </div>
    <?php

    /**
     * 'woocommerce_bundled_product_add_to_cart' hook.
     *
     * Used to output content normally hooked to 'woocommerce_before_add_to_cart_button'.
     *
     * @param  int              $bundled_product_id
     * @param  WC_Bundled_Item  $bundled_item
     */
    do_action( 'woocommerce_bundled_product_add_to_cart', $bundled_product_id, $bundled_item );

    ?><div class="single_variation_wrap bundled_item_wrap"><?php

        /**
         * 'woocommerce_bundled_single_variation' hook.
         *
         * Used to output variation data.
         *
         * @since  4.12.0
         *
         * @param  int              $bundled_product_id
         * @param  WC_Bundled_Item  $bundled_item
         *
         * @hooked wc_bundles_single_variation          - 10
         * @hooked wc_bundles_single_variation_template - 20
         */
        do_action( 'woocommerce_bundled_single_variation', $bundled_product_id, $bundled_item );

        ?></div>
</div>
