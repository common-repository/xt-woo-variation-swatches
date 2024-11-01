<?php

/**
 * This file is used to markup the composite product variable add to cart.
 *
 * This template can be overridden by copying it to yourtheme/xt-woo-variation-swatches/composite-variable.php.
 *
 * Available global vars:
 *
 * @var $product_variations
 * @var $product
 * @var $component_id
 * @var $composite_product
 * @var $attributes
 * @var $custom_data
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

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$form_classes = xt_woo_variation_swatches()->frontend()->get_form_classes();
$wrap_classes = xt_woo_variation_swatches()->frontend()->get_wrap_classes();
?>
<div class="variations_form details component_data <?php echo esc_attr($form_classes); ?>" data-price="0" data-regular_price="0" data-product_type="variable" data-product_variations="<?php echo htmlspecialchars( json_encode( $product_variations ) ); ?>" data-custom="<?php echo esc_attr( json_encode( $custom_data ) ); ?>"><?php

    /**
     * 'woocommerce_composited_product_details' hook.
     *
     * @since 3.2.0
     *
     * @hooked wc_cp_composited_product_excerpt - 10
     */
    do_action( 'woocommerce_composited_product_details', $product, $component_id, $composite_product );

    ?>
    <div class="<?php echo esc_attr($wrap_classes); ?>">
        <table class="variations">
            <tbody><?php

            foreach ( $attributes as $attribute_name => $options ) {

                $key = strtolower($attribute_name);
                $default_option = !empty($selected_attributes[$key]) ? $selected_attributes[$key] : '';
                ?>
                <tr class="attribute_options" data-attribute="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>" data-attribute_label="<?php echo esc_attr( wc_attribute_label( $attribute_name ) ); ?>">
                    <td class="label">
                        <label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>">
                            <?php echo wc_attribute_label( $attribute_name ); ?><span>:</span>
                            <abbr class="required" title="<?php _e( 'Required option', 'xt-woo-variation-swatches' ); ?>">*</abbr>
                        </label>
                        <?php if(!empty($default_option)): ?>
                            <span class="xt_woovs-attribute-value"><?php echo esc_html($default_option);?></span>
                        <?php endif; ?>
                    </td>
                    <td class="value">
                    <?php
                        echo wc_cp_composited_single_variation_attribute_options( array(
                            'options'    => $options,
                            'attributes' => $attributes,
                            'attribute'  => $attribute_name,
                            'product'    => $product,
                            'component'  => $composite_product->get_component( $component_id )
                        ) );
                    ?>
                    </td>
                </tr>
                <?php
            }

            ?>
            </tbody>
        </table>
    </div>
    <?php

    /**
     * 'woocommerce_composited_product_add_to_cart' hook.
     *
     * Useful for outputting content normally hooked to 'woocommerce_before_add_to_cart_button'.
     */
    do_action( 'woocommerce_composited_product_add_to_cart', $product, $component_id, $composite_product );

    ?>
    <div class="single_variation_wrap component_wrap">
    <?php

        /**
         * 'woocommerce_composited_single_variation' hook.
         *
         * Used to output the cart button and placeholder for variation data.
         *
         * @since 3.4.0
         *
         * @hooked wc_cp_composited_single_variation          - 10
         * @hooked wc_cp_composited_single_variation_template - 20
         */
        do_action( 'woocommerce_composited_single_variation', $product, $component_id, $composite_product );

    ?>
    </div>
</div>