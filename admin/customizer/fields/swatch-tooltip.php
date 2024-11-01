<?php

$fields[] = array(
    'id'      => $type . '_tooltip_features',
    'section' => $type . '-swatch-tooltip',
    'type'    => 'xt-premium',
    'default' => array(
        'type'  => 'image',
        'value' => $this->core->plugin_url() . 'admin/customizer/assets/images/' . $type . '-tooltip.png',
        'link'  => $this->core->plugin_upgrade_url(),
    ),
);