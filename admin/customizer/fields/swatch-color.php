<?php

/** @global $type */
/** @global $element_prefix */
/** @global $page_prefix */
if ( $type === 'archives' && $this->core->access_manager()->can_use_premium_code__premium_only() || $type === 'single' ) {
    $fields[] = array(
        'id'          => $type . '_color_swatch_style',
        'section'     => $type . '-swatch-color',
        'label'       => esc_html__( 'Color Swatch Style', 'xt-woo-variation-swatches' ),
        'type'        => 'radio-buttonset',
        'input_attrs' => array(
            'data-col' => '3',
        ),
        'default'     => 'xt_woovs-round',
        'choices'     => array(
            'xt_woovs-square'       => esc_html__( 'Square', 'xt-woo-variation-swatches' ),
            'xt_woovs-round'        => esc_html__( 'Circle', 'xt-woo-variation-swatches' ),
            'xt_woovs-round_corner' => esc_html__( 'Rounded', 'xt-woo-variation-swatches' ),
        ),
        'transport'   => 'postMessage',
        'js_vars'     => array(array(
            'element'  => $element_prefix . ' .xt_woovs-swatches .swatch.swatch-color',
            'function' => 'class',
        )),
    );
    $fields[] = array(
        'id'        => $type . '_color_swatch_width',
        'section'   => $type . '-swatch-color',
        'label'     => esc_html__( 'Color Swatch Width', 'xt-woo-variation-swatches' ),
        'default'   => self::types_default_values( $type, 50, 25 ),
        'type'      => 'slider',
        'choices'   => array(
            'min'  => '10',
            'max'  => '80',
            'step' => '1',
        ),
        'transport' => 'auto',
        'output'    => array(
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches .swatch.swatch-color .swatch-inner',
                'property'      => 'width',
                'value_pattern' => '$px',
            ),
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches .swatch.swatch-color figcaption',
                'property'      => 'font-size',
                'value_pattern' => 'calc($px * 0.25)',
            ),
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches.xt_woovs-featured-2 .swatch.swatch-color .swatch-inner',
                'property'      => 'width',
                'value_pattern' => 'calc($px * 1.2)',
            ),
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches.xt_woovs-featured-2 .swatch.swatch-color figcaption',
                'property'      => 'font-size',
                'value_pattern' => 'calc(($px * 1.2) * 0.25)',
            ),
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches.xt_woovs-featured-3 .swatch.swatch-color .swatch-inner',
                'property'      => 'width',
                'value_pattern' => 'calc($px * 1.5)',
            ),
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches.xt_woovs-featured-3 .swatch.swatch-color figcaption',
                'property'      => 'width',
                'value_pattern' => 'calc(($px * 1.5) * 0.25)',
            ),
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches.xt_woovs-featured-4 .swatch.swatch-color .swatch-inner',
                'property'      => 'width',
                'value_pattern' => 'calc($px * 1.8)',
            ),
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches.xt_woovs-featured-4 .swatch.swatch-color figcaption',
                'property'      => 'width',
                'value_pattern' => 'calc(($px * 1.8) * 0.25)',
            ),
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches.xt_woovs-featured-5 .swatch.swatch-color .swatch-inner',
                'property'      => 'width',
                'value_pattern' => 'calc($px * 2.1)',
            ),
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches.xt_woovs-featured-5 .swatch.swatch-color figcaption',
                'property'      => 'width',
                'value_pattern' => 'calc(($px * 2.1) * 0.25)',
            )
        ),
    );
    $fields[] = array(
        'id'        => $type . '_color_swatch_height',
        'section'   => $type . '-swatch-color',
        'label'     => esc_html__( 'Color Swatch Height', 'xt-woo-variation-swatches' ),
        'default'   => self::types_default_values( $type, 50, 25 ),
        'type'      => 'slider',
        'choices'   => array(
            'min'  => '10',
            'max'  => '80',
            'step' => '1',
        ),
        'transport' => 'auto',
        'output'    => array(array(
            'element'       => $element_prefix . ' .xt_woovs-swatches .swatch.swatch-color .swatch-inner',
            'property'      => 'height',
            'value_pattern' => '$px',
        )),
    );
}
$fields[] = array(
    'id'      => $type . '_color_features',
    'section' => $type . '-swatch-color',
    'type'    => 'xt-premium',
    'default' => array(
        'type'  => 'image',
        'value' => $this->core->plugin_url() . 'admin/customizer/assets/images/' . $type . '-color-swatch.png',
        'link'  => $this->core->plugin_upgrade_url(),
    ),
);