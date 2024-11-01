<?php

/** @global $type */
/** @global $element_prefix */
/** @global $page_prefix */
if ( $type === 'archives' && $this->core->access_manager()->can_use_premium_code__premium_only() || $type === 'single' ) {
    $fields[] = array(
        'id'          => $type . '_swatches_align',
        'section'     => $type . '-swatch-styling',
        'label'       => esc_html__( 'Swatches Alignment', 'xt-woo-variation-swatches' ),
        'type'        => 'radio-buttonset',
        'input_attrs' => array(
            'data-col' => '3',
        ),
        'choices'     => array(
            'left'   => esc_attr__( 'Left', 'xt-woo-variation-swatches' ),
            'center' => esc_attr__( 'Center', 'xt-woo-variation-swatches' ),
            'right'  => esc_attr__( 'Right', 'xt-woo-variation-swatches' ),
        ),
        'default'     => self::types_default_values( $type, 'left', 'center' ),
        'transport'   => 'postMessage',
        'js_vars'     => array(array(
            'element'  => $element_prefix . ' .xt_woovs-swatches-wrap',
            'function' => 'class',
            'prefix'   => 'xt_woovs-align-',
        ), array(
            'element'  => '.xt_woovs-archives-product .variations_form.xt_woovs-support',
            'property' => 'text-align',
        )),
        'output'      => array(array(
            'element'  => '.xt_woovs-archives-product .variations_form.xt_woovs-support',
            'property' => 'text-align',
        )),
    );
}
$fields[] = array(
    'id'      => $type . '_styling_features',
    'section' => $type . '-swatch-styling',
    'type'    => 'xt-premium',
    'default' => array(
        'type'  => 'image',
        'value' => $this->core->plugin_url() . 'admin/customizer/assets/images/' . $type . '-styling.png',
        'link'  => $this->core->plugin_upgrade_url(),
    ),
);