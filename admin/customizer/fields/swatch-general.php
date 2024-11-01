<?php

/** @global $type */
/** @global $element_prefix */
/** @global $page_prefix */
if ( $type === 'archives' && $this->core->access_manager()->can_use_premium_code__premium_only() || $type === 'single' ) {
    $fields[] = array(
        'id'      => $type . '_swatches_enabled',
        'section' => $type . '-swatch-general',
        'label'   => esc_html__( 'Enable Swatches.', 'xt-woo-variation-swatches' ),
        'type'    => 'radio-buttonset',
        'choices' => array(
            '0' => esc_attr__( 'No', 'xt-woo-variation-swatches' ),
            '1' => esc_attr__( 'Yes', 'xt-woo-variation-swatches' ),
        ),
        'default' => self::types_default_values( $type, '1', '0' ),
    );
    $fields[] = array(
        'id'      => $type . '_other_to_label',
        'section' => $type . '-swatch-general',
        'label'   => esc_html__( 'Automatically convert Dropdowns to Label Swatch by default.', 'xt-woo-variation-swatches' ),
        'type'    => 'radio-buttonset',
        'choices' => array(
            '0' => esc_attr__( 'No', 'xt-woo-variation-swatches' ),
            '1' => esc_attr__( 'Yes', 'xt-woo-variation-swatches' ),
        ),
        'default' => '1',
    );
    $fields[] = array(
        'id'      => $type . '_color_to_image',
        'section' => $type . '-swatch-general',
        'label'   => esc_html__( 'Automatically convert Dropdowns to Image Swatch if variation has an image.', 'xt-woo-variation-swatches' ),
        'type'    => 'radio-buttonset',
        'choices' => array(
            '0' => esc_attr__( 'No', 'xt-woo-variation-swatches' ),
            '1' => esc_attr__( 'Yes', 'xt-woo-variation-swatches' ),
        ),
        'default' => '1',
    );
    $fields[] = array(
        'id'              => $type . '_color_to_image_custom_attributes',
        'section'         => $type . '-swatch-general',
        'label'           => esc_html__( 'Select Custom Attributes', 'xt-woo-variation-swatches' ),
        'description'     => esc_html__( 'Enter attribute names that will be converted to image swatches. If more than one attribute is available, only the first one will be converted. Note: this will only work if each variation has an image assigned.', 'xt-woo-variation-swatches' ),
        'type'            => 'repeater',
        'row_label'       => array(
            'type'  => 'text',
            'value' => esc_html__( 'Custom attribute', 'xt-woo-variation-swatches' ),
        ),
        'default'         => array(array(
            'attribute' => 'color',
        ), array(
            'attribute' => 'image',
        )),
        'fields'          => array(
            'attribute' => array(
                'type'    => 'text',
                'label'   => esc_html__( 'Custom Attribute', 'xt-woo-variation-swatches' ),
                'default' => '',
            ),
        ),
        'active_callback' => array(array(
            'setting'  => $type . '_color_to_image',
            'operator' => '==',
            'value'    => '1',
        )),
    );
    $fields[] = array(
        'id'      => $type . '_attribute_image_preview',
        'section' => $type . '-swatch-general',
        'label'   => esc_html__( 'Use images from attribute options as a variation image preview.', 'xt-woo-variation-swatches' ),
        'desc'    => esc_html__( 'This could be useful if you have lot\'s of variations without images assigned to them. Instead of having to add an image for each variation, you can use the images that are already set within one of your Global or Custom attributes of type image.', 'xt-woo-variation-swatches' ),
        'type'    => 'radio-buttonset',
        'choices' => array(
            '0' => esc_attr__( 'No', 'xt-woo-variation-swatches' ),
            '1' => esc_attr__( 'Yes', 'xt-woo-variation-swatches' ),
        ),
        'default' => '0',
    );
    $fields[] = array(
        'id'              => $type . '_attribute_image_preview_attributes',
        'section'         => $type . '-swatch-general',
        'label'           => esc_html__( 'Select Global Attributes', 'xt-woo-variation-swatches' ),
        'description'     => esc_html__( 'Select global attributes (image type) where their option images will be used as main image preview. If more than one attribute is available for a product, only the first one will be used.', 'xt-woo-variation-swatches' ),
        'type'            => 'repeater',
        'row_label'       => array(
            'type'  => 'text',
            'value' => esc_html__( 'Global attribute', 'xt-woo-variation-swatches' ),
        ),
        'default'         => array(),
        'fields'          => array(
            'attribute' => array(
                'type'    => 'select',
                'choices' => $this->get_product_attributes_options( array('image') ),
                'label'   => esc_html__( 'Global Attribute', 'xt-woo-variation-swatches' ),
                'default' => 'color',
            ),
        ),
        'active_callback' => array(array(
            'setting'  => $type . '_attribute_image_preview',
            'operator' => '==',
            'value'    => '1',
        )),
    );
    $fields[] = array(
        'id'          => $type . '_enable_deselect',
        'section'     => $type . '-swatch-general',
        'label'       => esc_html__( 'Deselect on Click', 'xt-woo-variation-swatches' ),
        'description' => esc_html__( 'If a swatch is selected, clicking on it again will deselect it.', 'xt-woo-variation-swatches' ),
        'type'        => 'radio-buttonset',
        'choices'     => array(
            '0' => esc_attr__( 'No', 'xt-woo-variation-swatches' ),
            '1' => esc_attr__( 'Yes', 'xt-woo-variation-swatches' ),
        ),
        'default'     => '1',
    );
    $fields[] = array(
        'id'          => $type . '_auto_select_first_on_select',
        'section'     => $type . '-swatch-general',
        'label'       => esc_html__( 'Auto Select First Option after selecting at least 1 option', 'xt-woo-variation-swatches' ),
        'description' => esc_html__( 'This will auto select first option of each attribute only after selecting at least 1 option. This will force the image to switch without having to select all options.', 'xt-woo-variation-swatches' ),
        'type'        => 'radio-buttonset',
        'choices'     => array(
            '0' => esc_attr__( 'No', 'xt-woo-variation-swatches' ),
            '1' => esc_attr__( 'Yes', 'xt-woo-variation-swatches' ),
        ),
        'default'     => '1',
    );
    $fields[] = array(
        'id'          => $type . '_auto_select_first',
        'section'     => $type . '-swatch-general',
        'label'       => esc_html__( 'Auto Select First Option on page load', 'xt-woo-variation-swatches' ),
        'description' => esc_html__( 'This will auto select first option of each attribute by default', 'xt-woo-variation-swatches' ),
        'type'        => 'radio-buttonset',
        'choices'     => array(
            '0' => esc_attr__( 'No', 'xt-woo-variation-swatches' ),
            '1' => esc_attr__( 'Yes', 'xt-woo-variation-swatches' ),
        ),
        'default'     => '0',
    );
    $fields[] = array(
        'id'        => $type . '_variation_reset',
        'section'   => $type . '-swatch-general',
        'label'     => esc_html__( 'Hide Variation Reset Link', 'xt-woo-variation-swatches' ),
        'type'      => 'radio-buttonset',
        'choices'   => array(
            'visible' => esc_attr__( 'No', 'xt-woo-variation-swatches' ),
            'hide'    => esc_attr__( 'Yes', 'xt-woo-variation-swatches' ),
        ),
        'default'   => 'visible',
        'transport' => 'postMessage',
        'js_vars'   => array(array(
            'element'  => $element_prefix . ' .xt_woovs-swatches-wrap',
            'function' => 'class',
            'prefix'   => 'xt_woovs-reset-',
        )),
    );
}
if ( $type === 'archives' ) {
    $fields[] = array(
        'id'      => $type . '_general_features',
        'section' => $type . '-swatch-general',
        'type'    => 'xt-premium',
        'default' => array(
            'type'  => 'image',
            'value' => $this->core->plugin_url() . 'admin/customizer/assets/images/' . $type . '-general.png',
            'link'  => $this->core->plugin_upgrade_url(),
        ),
    );
}