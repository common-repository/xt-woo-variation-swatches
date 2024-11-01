<?php

$fields[] = array(
    'id'      => $type . '_catalog_mode',
    'section' => $type . '-swatch-display',
    'type'    => 'xt-premium',
    'default' => array(
        'type'  => 'image',
        'value' => $this->core->plugin_url() . 'admin/customizer/assets/images/' . $type . '-display.png',
        'link'  => $this->core->plugin_upgrade_url(),
    ),
);