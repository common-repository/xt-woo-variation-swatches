<?php

$fields[] = array(
    'id'      => 'disable_ajax_variation_threshold',
    'section' => 'swatch-global',
    'label'   => esc_html__( 'Disable Ajax Variation Threshold', 'xt-woo-variation-swatches' ),
    'type'    => 'custom',
    'default' => '<span class="description customize-control-description">' . esc_html__( 'When your variable product has more than X variations, WooCommerce starts to use ajax to load your selected variation. This changes the way the dropdown fields / swatches work – where before you could select some options and others would become unavailable/disabled, now you have to select all options before finding out the variation you selected is not available. You can either disable ajax threshold or increase it to avoid that, however keep in mind that if a product has a lot of variations, loading them on demand via ajax is faster than loading them all at once.', 'xt-woo-variation-swatches' ) . '</span>',
);
$fields[] = array(
    'id'      => 'disable_ajax_variation_threshold',
    'section' => 'swatch-global',
    'label'   => esc_html__( 'Disable Ajax Variation Threshold', 'xt-woo-variation-swatches' ),
    'type'    => 'radio-buttonset',
    'choices' => array(
        '0' => esc_attr__( 'No', 'xt-woo-variation-swatches' ),
        '1' => esc_attr__( 'Yes', 'xt-woo-variation-swatches' ),
    ),
    'default' => '0',
);
$fields[] = array(
    'id'              => 'ajax_variation_threshold',
    'section'         => 'swatch-global',
    'label'           => esc_html__( 'Ajax Variation Threshold', 'xt-woo-variation-swatches' ),
    'type'            => 'slider',
    'choices'         => array(
        'min'  => '10',
        'max'  => '1000',
        'step' => '1',
    ),
    'default'         => 50,
    'active_callback' => array(array(
        'setting'  => 'disable_ajax_variation_threshold',
        'operator' => '!=',
        'value'    => '1',
    )),
);
$fields[] = array(
    'id'      => 'global-features',
    'section' => 'swatch-global',
    'type'    => 'xt-premium',
    'default' => array(
        'type'  => 'image',
        'value' => $this->core->plugin_url() . 'admin/customizer/assets/images/swatch-global.png',
        'link'  => $this->core->plugin_upgrade_url(),
    ),
);