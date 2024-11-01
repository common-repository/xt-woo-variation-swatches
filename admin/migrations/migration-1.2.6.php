<?php

$customizer = xt_woo_variation_swatches()->customizer();

$convert_bool_to_string = array(
	'archives_swatches_enabled',
	'archives_other_to_label',
	'archives_color_to_image',
    'single_swatches_enabled',
    'single_other_to_label',
    'single_color_to_image',
);

$options = $customizer->get_options();

foreach ( $convert_bool_to_string as $key ) {

	if(isset($options[$key]) && is_bool($options[$key])) {

		$options[$key] = $options[$key] ? '1' : '0';
	}
}

$customizer->update_options( $options );