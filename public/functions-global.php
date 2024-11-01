<?php

function xt_woovs_option( $id, $default = null ) {

	return xt_woo_variation_swatches()->customizer()->get_option($id, $default);
}

function xt_woovs_option_bool( $id, $default = null ) {

	return xt_woo_variation_swatches()->customizer()->get_option_bool($id, $default);
}

function xt_woovs_update_option( $id, $value ) {

	xt_woo_variation_swatches()->customizer()->update_option($id, $value);
}

function xt_woovs_delete_option( $id ) {

	xt_woo_variation_swatches()->customizer()->delete_option($id);
}

function xt_woovs_swatch_type() {
    return (xt_woovs_is_single_product()) ? 'single' : 'archives';
}

function xt_woovs_type_option($id, $default = null) {

    $type = xt_woovs_swatch_type();
    return xt_woovs_option($type.'_'.$id, $default);
}

function xt_woovs_type_option_bool($id, $default = null) {

    return (bool)xt_woovs_type_option($id, $default);
}

function xt_woovs_option_style($attribute, $id, $default = null, $prefix = null, $suffix = null) {

    $value = xt_woovs_option($id, $default);

    if(empty($value)) {
        return "";
    }

    if($prefix) {
        $value = $prefix.$value;
    }

    if($suffix) {
        $value .= $suffix;
    }

    return esc_attr($attribute.':'.$value.';');
}

function xt_woovs_type_option_style($attribute, $id, $default = null, $prefix = null, $suffix = null) {

    $type = xt_woovs_swatch_type();
    return xt_woovs_option_style($attribute, $type.'_'.$id, $default, $prefix, $suffix);
}

function xt_woovs_enabled_in_quick_views() {

    $is_ajax = xt_woo_variation_swatches()->doing_ajax();

    if($is_ajax && !xt_woo_variation_swatches()->access_manager()->can_use_premium_code__premium_only()) {
        return false;
    }
    return true;
}

function xt_woovs_is_single_product() {

    global $product;

    $queried_object = get_queried_object();

    $is_single = (is_admin()) || (is_product() && method_exists($product, 'get_id') && $queried_object && ($queried_object->ID === $product->get_id()));

    if($is_single && !xtfw_doing_ajax()) {

        if(did_action( 'woocommerce_template_single_add_to_cart' ) > 0) {
            $is_single = false;
        }
    }

    return $is_single;
}

function xt_woovs_search_attributes(&$array, $k, $v, $ignoreCase = true) {

    if(!is_array($array)) {
        return null;
    }

    foreach ($array as $key => $value) {

        if($ignoreCase) {
            $v = strtolower($v);
            $value[$k] = strtolower($value[$k]);
        }

        if ($value[$k] === $v || 'pa_'.$value[$k] === $v) {
            return $key;
        }
    }

    return null;
}
