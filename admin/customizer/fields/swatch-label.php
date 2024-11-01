<?php

/** @global $type */
/** @global $element_prefix */
/** @global $page_prefix */
if ( $type === 'archives' && $this->core->access_manager()->can_use_premium_code__premium_only() || $type === 'single' ) {
    $fields[] = array(
        'id'          => $type . '_label_swatch_style',
        'section'     => $type . '-swatch-label',
        'label'       => esc_html__( 'Label Swatch Style', 'xt-woo-variation-swatches' ),
        'type'        => 'radio-buttonset',
        'input_attrs' => array(
            'data-col' => '3',
        ),
        'default'     => 'xt_woovs-square',
        'choices'     => array(
            'xt_woovs-square'       => esc_html__( 'Square', 'xt-woo-variation-swatches' ),
            'xt_woovs-round'        => esc_html__( 'Circle', 'xt-woo-variation-swatches' ),
            'xt_woovs-round_corner' => esc_html__( 'Rounded', 'xt-woo-variation-swatches' ),
        ),
        'transport'   => 'postMessage',
        'js_vars'     => array(array(
            'element'  => $element_prefix . ' .xt_woovs-swatches .swatch.swatch-label',
            'function' => 'class',
        )),
    );
    $fields[] = array(
        'id'          => $type . '_label_swatch_flex_mode',
        'section'     => $type . '-swatch-label',
        'label'       => esc_html__( 'Label Swatch Flex Mode', 'xt-woo-variation-swatches' ),
        'type'        => 'radio-buttonset',
        'input_attrs' => array(
            'data-col' => '3',
        ),
        'default'     => '0',
        'choices'     => array(
            '0' => esc_html__( 'No', 'xt-woo-variation-swatches' ),
            '1' => esc_html__( 'Yes', 'xt-woo-variation-swatches' ),
        ),
        'transport'   => 'postMessage',
        'js_vars'     => array(array(
            'element'  => $element_prefix . ' .xt_woovs-swatches .swatch.swatch-label',
            'function' => 'toggleClass',
            'class'    => 'xt_woovs-swatch-flex',
            'value'    => '1',
        )),
    );
    $fields[] = array(
        'id'              => $type . '_label_swatch_stretch',
        'section'         => $type . '-swatch-label',
        'label'           => esc_html__( 'Stretch Label Swatch', 'xt-woo-variation-swatches' ),
        'type'            => 'radio-buttonset',
        'input_attrs'     => array(
            'data-col' => '3',
        ),
        'default'         => '0',
        'choices'         => array(
            '0' => esc_html__( 'No', 'xt-woo-variation-swatches' ),
            '1' => esc_html__( 'Yes', 'xt-woo-variation-swatches' ),
        ),
        'transport'       => 'auto',
        'output'          => array(array(
            'element'  => ':root',
            'property' => '--xt-woovs-' . $type . '-label-flex',
        )),
        'active_callback' => array(array(
            'setting'  => $type . '_label_swatch_flex_mode',
            'operator' => '==',
            'value'    => '1',
        )),
    );
    $fields[] = array(
        'id'              => $type . '_label_swatch_max_per_row',
        'section'         => $type . '-swatch-label',
        'label'           => esc_html__( 'Max Swatches Per Row', 'xt-woo-variation-swatches' ),
        'description'     => esc_html__( 'How many swatches would you like to display per row.', 'xt-woo-variation-swatches' ),
        'default'         => self::types_default_values( $type, 4, 8 ),
        'type'            => 'slider',
        'choices'         => array(
            'min'  => '1',
            'max'  => '10',
            'step' => '1',
        ),
        'transport'       => 'auto',
        'output'          => array(array(
            'element'  => ':root',
            'property' => '--xt-woovs-' . $type . '-labels-per-row',
        )),
        'active_callback' => array(array(
            'setting'  => $type . '_label_swatch_flex_mode',
            'operator' => '==',
            'value'    => '1',
        )),
    );
    $fields[] = array(
        'id'              => $type . '_label_swatch_min_width',
        'section'         => $type . '-swatch-label',
        'label'           => esc_html__( 'Label Swatch Min Width', 'xt-woo-variation-swatches' ),
        'default'         => self::types_default_values( $type, 50, 25 ),
        'type'            => 'slider',
        'choices'         => array(
            'min'  => '10',
            'max'  => '100',
            'step' => '1',
        ),
        'transport'       => 'auto',
        'output'          => array(
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches .swatch.swatch-label',
                'property'      => 'min-width',
                'value_pattern' => '$px',
            ),
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches.xt_woovs-featured-2 .swatch.swatch-label',
                'property'      => 'min-width',
                'value_pattern' => 'calc($px * 1.2)',
            ),
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches.xt_woovs-featured-3 .swatch.swatch-label',
                'property'      => 'min-width',
                'value_pattern' => 'calc($px * 1.3)',
            ),
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches.xt_woovs-featured-4 .swatch.swatch-label',
                'property'      => 'min-width',
                'value_pattern' => 'calc($px * 1.4)',
            ),
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches.xt_woovs-featured-5 .swatch.swatch-label',
                'property'      => 'min-width',
                'value_pattern' => 'calc($px * 1.5)',
            )
        ),
        'active_callback' => array(array(
            'setting'  => $type . '_label_swatch_flex_mode',
            'operator' => '!=',
            'value'    => '1',
        )),
    );
    $fields[] = array(
        'id'        => $type . '_label_swatch_height',
        'section'   => $type . '-swatch-label',
        'label'     => esc_html__( 'Label Swatch Height', 'xt-woo-variation-swatches' ),
        'default'   => self::types_default_values( $type, 30, 20 ),
        'type'      => 'slider',
        'choices'   => array(
            'min'  => '10',
            'max'  => '100',
            'step' => '1',
        ),
        'transport' => 'auto',
        'output'    => array(
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches .swatch.swatch-label',
                'property'      => 'height',
                'value_pattern' => '$px',
            ),
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches .swatch.swatch-label',
                'property'      => 'line-height',
                'value_pattern' => '$px',
            ),
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches.xt_woovs-featured-2 .swatch.swatch-label',
                'property'      => 'height',
                'value_pattern' => 'calc($px * 1.2)',
            ),
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches.xt_woovs-featured-2 .swatch.swatch-label',
                'property'      => 'line-height',
                'value_pattern' => 'calc($px * 1.2)',
            ),
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches.xt_woovs-featured-3 .swatch.swatch-label',
                'property'      => 'height',
                'value_pattern' => 'calc($px * 1.5)',
            ),
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches.xt_woovs-featured-3 .swatch.swatch-label',
                'property'      => 'line-height',
                'value_pattern' => 'calc($px * 1.5)',
            ),
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches.xt_woovs-featured-4 .swatch.swatch-label',
                'property'      => 'height',
                'value_pattern' => 'calc($px * 1.8)',
            ),
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches.xt_woovs-featured-4 .swatch.swatch-label',
                'property'      => 'line-height',
                'value_pattern' => 'calc($px * 1.8)',
            ),
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches.xt_woovs-featured-5 .swatch.swatch-label',
                'property'      => 'height',
                'value_pattern' => 'calc($px * 2.1)',
            ),
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches.xt_woovs-featured-5 .swatch.swatch-label',
                'property'      => 'line-height',
                'value_pattern' => 'calc($px * 2.1)',
            )
        ),
    );
    $fields[] = array(
        'id'        => $type . '_label_swatch_size',
        'section'   => $type . '-swatch-label',
        'label'     => esc_html__( 'Label Swatch Font Size', 'xt-woo-variation-swatches' ),
        'default'   => self::types_default_values( $type, 13, 10 ),
        'type'      => 'slider',
        'choices'   => array(
            'min'  => '10',
            'max'  => '60',
            'step' => '1',
        ),
        'transport' => 'auto',
        'output'    => array(
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches .swatch.swatch-label',
                'property'      => 'font-size',
                'value_pattern' => '$px',
            ),
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches.xt_woovs-featured-2 .swatch.swatch-label',
                'property'      => 'font-size',
                'value_pattern' => 'calc($px * 1.2)',
            ),
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches.xt_woovs-featured-3 .swatch.swatch-label',
                'property'      => 'font-size',
                'value_pattern' => 'calc($px * 1.3)',
            ),
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches.xt_woovs-featured-4 .swatch.swatch-label',
                'property'      => 'font-size',
                'value_pattern' => 'calc($px * 1.4)',
            ),
            array(
                'element'       => $element_prefix . ' .xt_woovs-swatches.xt_woovs-featured-5 .swatch.swatch-label',
                'property'      => 'font-size',
                'value_pattern' => 'calc($px * 1.5)',
            )
        ),
    );
}
$fields[] = array(
    'id'      => $type . '_label_features',
    'section' => $type . '-swatch-label',
    'type'    => 'xt-premium',
    'default' => array(
        'type'  => 'image',
        'value' => $this->core->plugin_url() . 'admin/customizer/assets/images/' . $type . '-label-swatch.png',
        'link'  => $this->core->plugin_upgrade_url(),
    ),
);