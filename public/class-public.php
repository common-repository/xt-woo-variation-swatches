<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://xplodedthemes.com
 * @since      1.0.0
 *
 * @package    XT_Woo_Variation_Swatches
 * @subpackage XT_Woo_Variation_Swatches/public
 */
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    XT_Woo_Variation_Swatches
 * @subpackage XT_Woo_Variation_Swatches/public
 * @author     XplodedThemes
 */
class XT_Woo_Variation_Swatches_Public {
    /**
     * Core class reference.
     *
     * @since    1.0.0
     * @access   private
     * @var      XT_Woo_Variation_Swatches    $core    Core Class
     */
    private $core;

    /**
     * Initialize the frontend and define public hooks
     *
     * @since    1.0.0
     * @param    XT_Woo_Variation_Swatches $core Core Class
     */
    public function __construct( &$core ) {
        $this->core = $core;
        add_action( 'wp_enqueue_scripts', array($this, 'enqueue_styles') );
        add_action( 'wp_enqueue_scripts', array($this, 'enqueue_scripts') );
        add_filter( 'body_class', array($this, 'body_class') );
        add_filter(
            'woocommerce_dropdown_variation_attribute_options_html',
            array($this, 'variation_attribute_options_html'),
            100,
            2
        );
        add_filter(
            'xt_woovs_swatch_html',
            array($this, 'swatch_html'),
            5,
            6
        );
        add_filter(
            'xt_woovs_swatch_meta_html',
            array($this, 'swatch_meta_html'),
            5,
            4
        );
        add_filter( 'woocommerce_ajax_variation_threshold', array($this, 'woocommerce_ajax_variation_threshold'), 999 );
        // This is a backup plan. Templates are already being overridden via function_exists.
        // However, in case another plugin is already overriding the function, we need to override the template it self.
        if ( !is_admin() ) {
            add_filter(
                'wc_get_template',
                array($this, 'woocommerce_override_variable_template'),
                10,
                5
            );
        }
        add_filter(
            'woocommerce_gallery_image_size',
            array($this, 'woocommerce_gallery_image_size'),
            10,
            1
        );
    }

    public function enabled( $type = null ) {
        $type = ( empty( $type ) ? xt_woovs_swatch_type() : $type );
        $default_value = $this->core->backend()->types_default_values( $type, true, false );
        $enabled = xt_woovs_option( $type . '_swatches_enabled', $default_value );
        if ( $type === 'archives' ) {
            $enabled = apply_filters( 'xt_woovs_shop_swatches_enabled', $enabled );
        }
        return $enabled;
    }

    public function woocommerce_override_variable_template(
        $template,
        $template_name,
        $args,
        $template_path,
        $default_path
    ) {
        if ( !xt_woovs_enabled_in_quick_views() ) {
            return $template;
        }
        if ( $template_name === 'single-product/add-to-cart/variable.php' ) {
            $template = $this->core->get_template(
                'variable',
                $args,
                null,
                true
            );
        } else {
            if ( $template_name === 'composited-product/variable-product.php' ) {
                $template = $this->core->get_template(
                    'composite-variable',
                    $args,
                    null,
                    true
                );
            } else {
                if ( $template_name === 'single-product/bundled-product-variable.php' ) {
                    $template = $this->core->get_template(
                        'bundle-variable',
                        $args,
                        null,
                        true
                    );
                }
            }
        }
        return $template;
    }

    public function woocommerce_gallery_image_size( $size ) {
        if ( xt_woovs_is_single_product() ) {
            return $size;
        }
        return 'woocommerce_thumbnail';
    }

    public function on_demand_enabled() {
        $on_demand = $this->on_demand_settings();
        return !empty( $on_demand );
    }

    public function on_demand_settings() {
        if ( !$this->enabled( 'archives' ) ) {
            return null;
        }
        $catalog_mode = xt_woovs_type_option_bool( 'catalog_mode', false );
        $display_type = xt_woovs_type_option( 'swatches_display_type', 'inline' );
        $visibility_type = ( $display_type === 'inline' ? xt_woovs_type_option( 'swatches_visibility_type', 'always' ) : null );
        $drawer_position = ( $display_type === 'drawer' ? xt_woovs_type_option( 'swatches_drawer_position', 'bottom' ) : null );
        $onDemand = $display_type === 'inline' && $visibility_type !== 'always' || $display_type !== 'inline';
        $onDemand = ( $catalog_mode ? false : $onDemand );
        return ( $onDemand ? array($display_type, $visibility_type, $drawer_position) : null );
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in XT_Woo_Variation_Swatches_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The XT_Woo_Variation_Swatches_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style(
            $this->core->plugin_slug(),
            $this->core->plugin_url( 'public/assets/css', 'frontend.css' ),
            array(),
            $this->core->plugin_version(),
            'all'
        );
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in XT_Woo_Variation_Swatches_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The XT_Woo_Variation_Swatches_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_register_script(
            $this->core->plugin_slug(),
            $this->core->plugin_url( 'public/assets/js', 'frontend' . XTFW_SCRIPT_SUFFIX . '.js' ),
            array('jquery'),
            $this->core->plugin_version(),
            false
        );
        $vars = array(
            'can_use_premium_code' => $this->core->access_manager()->can_use_premium_code__premium_only(),
            'catalog_mode'         => xt_woovs_option_bool( 'archives_catalog_mode' ),
            'catalog_mode_hover'   => xt_woovs_option_bool( 'archives_catalog_mode_hover' ),
        );
        wp_localize_script( $this->core->plugin_slug(), 'XT_WOOVS', $vars );
        wp_enqueue_script( $this->core->plugin_slug() );
    }

    public function body_class( $classes ) {
        if ( is_product() ) {
            $classes[] = 'xt_woovs-single';
        } else {
            $classes[] = 'xt_woovs-archives';
        }
        if ( $this->enabled( 'single' ) ) {
            $classes[] = 'xt_woovs-single-enabled';
        }
        if ( $this->enabled( 'archives' ) ) {
            $classes[] = 'xt_woovs-archives-enabled';
        }
        return $classes;
    }

    public function get_form_classes() {
        $is_single_product = xt_woovs_is_single_product();
        $form_classes = array();
        if ( $is_single_product ) {
            $form_classes[] = 'xt_woovs-single-product';
        } else {
            $form_classes[] = 'xt_woovs-archives-product';
        }
        $form_classes = apply_filters( 'xt_woovs_form_classes', $form_classes );
        return implode( " ", $form_classes );
    }

    public function get_wrap_classes() {
        $is_single_product = xt_woovs_is_single_product();
        $catalog_mode = xt_woovs_type_option_bool( 'catalog_mode', false );
        $wrap_classes = array('xt_woovs-swatches-wrap');
        $wrap_classes[] = 'xt_woovs-align-' . xt_woovs_type_option( 'swatches_align', 'left' );
        $wrap_classes[] = 'xt_woovs-reset-' . xt_woovs_type_option( 'variation_reset', 'visible' );
        $wrap_classes[] = 'xt_woovs-behavior-' . xt_woovs_type_option( 'swatch_behavior', 'hide' );
        $wrap_classes[] = 'xt_woovs-disabled-' . xt_woovs_type_option( 'swatch_disabled_clickable', 'unclickable' );
        if ( xt_woovs_type_option_bool( 'enable_deselect', true ) ) {
            $wrap_classes[] = 'xt_woovs-enable-deselect';
        }
        if ( xt_woovs_type_option_bool( 'auto_select_first', true ) ) {
            $wrap_classes[] = 'xt_woovs-auto-select';
        }
        if ( xt_woovs_type_option_bool( 'auto_select_first_on_select', true ) ) {
            $wrap_classes[] = 'xt_woovs-auto-select-on-select';
        }
        if ( $is_single_product ) {
            $wrap_classes[] = 'xt_woovs-attr-label-' . xt_woovs_type_option( 'attr_label_position', 'inherit' );
            if ( xt_woovs_type_option_bool( 'attr_selected_value', false ) ) {
                $wrap_classes[] = 'xt_woovs-attr-show-selected';
            }
        } else {
            if ( $catalog_mode ) {
                $wrap_classes[] = 'xt_woovs-catalog-mode';
            }
        }
        $wrap_classes = apply_filters( 'xt_woovs_wrap_classes', $wrap_classes );
        return implode( " ", $wrap_classes );
    }

    public function woocommerce_ajax_variation_threshold( $qty ) {
        if ( $this->enabled() ) {
            $disable_threshold = xt_woovs_option_bool( 'disable_ajax_variation_threshold', false );
            if ( $disable_threshold ) {
                $qty = 9999999999;
            } else {
                $qty = xt_woovs_option( 'ajax_variation_threshold', $qty );
            }
        }
        return $qty;
    }

    /**
     * Filter function to add swatches bellow the default selector
     *
     * @param $html
     * @param $args
     *
     * @return string
     */
    public function variation_attribute_options_html( $html, $args ) {
        if ( !xt_woovs_enabled_in_quick_views() ) {
            return $html;
        }
        if ( !$this->enabled() ) {
            return $html;
        }
        $swatches = '';
        $product = $args['product'];
        $attribute = $args['attribute'];
        $options = $args['options'];
        $attr = $this->core->backend()->get_tax_attribute( $attribute );
        $class = ( isset( $attr->attribute_type ) ? "variation-selector variation-select-{$attr->attribute_type}" : '' );
        $product_swatch_options = $product->get_meta( '_xt_woovs_swatch_type_options', true );
        if ( empty( $options ) && !empty( $product ) && !empty( $attribute ) ) {
            $attributes = $product->get_variation_attributes();
            $options = $attributes[$attribute];
        } else {
            $attributes = null;
        }
        if ( !empty( $options ) ) {
            $is_single = ( isset( $args["is_single"] ) ? $args["is_single"] : false );
            $catalog_mode = ( isset( $args["catalog_mode"] ) ? $args["catalog_mode"] : false );
            $catalog_mode_skipped_attribute = ( isset( $args["catalog_mode_skipped_attribute"] ) ? $args["catalog_mode_skipped_attribute"] : false );
            $slug = sanitize_title( $attribute );
            $key = md5( $slug );
            $is_featured = false;
            if ( $product && taxonomy_exists( $attribute ) ) {
                if ( $is_single ) {
                    $featured_attribute = xt_woovs_option( 'single_swatch_featured_global_attribute' );
                    $is_featured = !empty( $featured_attribute ) && strtolower( $featured_attribute ) === strtolower( $attribute );
                }
                // Get terms if this is a taxonomy - ordered. We need the names too.
                $terms = wc_get_product_terms( $product->get_id(), $attribute, array(
                    'fields' => 'all',
                ) );
                foreach ( $terms as $term ) {
                    if ( in_array( $term->slug, $options ) ) {
                        $meta_key = md5( $term->slug );
                        $selected = ( sanitize_title( $args['selected'] ) == $term->slug ? 'selected' : '' );
                        // Check if product has quick attributes with custom swatches, if yes use those instead.
                        $meta_values = $this->get_global_attribute_term_options(
                            $args,
                            $attr,
                            $term,
                            $product_swatch_options,
                            $key,
                            $meta_key
                        );
                        $swatches .= apply_filters(
                            'xt_woovs_swatch_html',
                            '',
                            $term,
                            $attributes,
                            $product,
                            $meta_values,
                            $selected
                        );
                    }
                }
            } else {
                if ( $is_single ) {
                    $featured_attribute = xt_woovs_option( 'single_swatch_featured_custom_attribute' );
                    $is_featured = !empty( $featured_attribute ) && strtolower( $featured_attribute ) === strtolower( $attribute );
                }
                foreach ( $options as $option ) {
                    $meta_key = md5( sanitize_title( strtolower( $option ) ) );
                    $selected = ( sanitize_title( $args['selected'] ) === sanitize_title( $option ) ? 'selected' : '' );
                    // Check if product has quick attributes with custom swatches, if yes use those instead.
                    $meta_values = $this->get_quick_attribute_term_options(
                        $args,
                        $attr,
                        $option,
                        $product_swatch_options,
                        $key,
                        $meta_key
                    );
                    $swatches .= apply_filters(
                        'xt_woovs_swatch_meta_html',
                        '',
                        $option,
                        $meta_values,
                        $selected
                    );
                }
            }
            if ( !empty( $swatches ) ) {
                $class .= ( !empty( $class ) ? $class . ' ' : $class );
                $class .= 'xt_woovs-hidden';
                $swatches_classes[] = 'xt_woovs-swatches';
                if ( $is_featured ) {
                    $featured_multiplier = xt_woovs_option( 'single_swatch_featured_attribute_size' );
                    $swatches_classes[] = 'xt_woovs-featured';
                    $swatches_classes[] = 'xt_woovs-featured-' . $featured_multiplier;
                }
                if ( $catalog_mode && $catalog_mode_skipped_attribute ) {
                    $swatches_classes[] = 'xt_woovs-catalog-mode-hidden';
                }
                $swatches_classes = apply_filters( 'xt_woovs_classes', $swatches_classes );
                $swatches_classes = implode( " ", $swatches_classes );
                // $swatches output has been sanitized earlier via below function "get_label_swatch_html", "get_color_swatch_html", "get_image_swatch_html"
                $swatches = '<ul class="' . esc_attr( $swatches_classes ) . '">' . $swatches . '</ul>';
                // $html value is the result of a woocommerce filter "woocommerce_dropdown_variation_attribute_options_html" already sanitized.
                // The filter is defined in class-core.php
                // We are simply wrapping the result.
                $html = '<div class="' . esc_attr( $class ) . '">' . $html . '</div>' . $swatches;
            }
        }
        return $html;
    }

    public function get_global_attribute_term_options(
        &$args,
        &$attr,
        &$term,
        &$product_swatch_options,
        $key,
        $meta_key
    ) {
        $meta_values = $this->get_quick_attribute_term_options(
            $args,
            $attr,
            $term->slug,
            $product_swatch_options,
            $key,
            $meta_key,
            false,
            $term
        );
        $overridden = !empty( $meta_values['value'] );
        $meta_values['type'] = ( !empty( $meta_values['type'] ) ? $meta_values['type'] : $attr->attribute_type );
        $type = $meta_values['type'];
        if ( $type === 'color' ) {
            if ( empty( $meta_values['value'] ) ) {
                $meta_values['value'] = get_term_meta( $term->term_id, 'color', true );
            }
        } else {
            if ( $type === 'image' ) {
                if ( empty( $meta_values['value'] ) ) {
                    $meta_values['value'] = get_term_meta( $term->term_id, 'image', true );
                }
                if ( !empty( $meta_values['value'] ) ) {
                    $meta_values['value'] = ( wp_attachment_is_image( $meta_values['value'] ) ? $meta_values['value'] : null );
                }
            }
        }
        if ( !$overridden ) {
            $this->swatch_type_override(
                $meta_values,
                $args,
                $attr,
                $term->slug,
                true
            );
        }
        return $meta_values;
    }

    public function get_quick_attribute_term_options(
        &$args,
        &$attr,
        &$option,
        &$product_swatch_options,
        $key,
        $meta_key,
        $enable_auto_convert = true,
        $term = null
    ) {
        $attribute_slug = sanitize_title( $args['attribute'] );
        $variations = $this->get_product_variations( $args['product'] );
        $meta_values = array(
            'type'          => ( !empty( $attr->attribute_type ) ? $attr->attribute_type : null ),
            'value'         => null,
            'style'         => null,
            'image'         => null,
            'tooltip'       => null,
            'tooltip_image' => null,
            'tooltip_text'  => null,
        );
        extract( $meta_values );
        /** @var $type */
        /** @var $value */
        /** @var $image */
        /** @var $style */
        /** @var $tooltip */
        if ( $enable_auto_convert && empty( $meta_values['value'] ) ) {
            $this->swatch_type_override(
                $meta_values,
                $args,
                $attr,
                $option
            );
            $type = $meta_values['type'];
        }
        if ( $type === 'color' ) {
            $meta_values['image'] = $this->get_variation_color_image( $variations, $attribute_slug, $option );
            $meta_values['style'] = $this->get_option_value(
                $product_attr_options,
                $product_attr_term_options,
                'color_swatch_style',
                'xt_woovs-round',
                $term
            );
            $meta_values['tooltip'] = $this->get_option_value(
                $product_attr_options,
                $product_attr_term_options,
                'color_swatch_tooltip',
                'disabled',
                $term
            );
        } else {
            if ( $type === 'image' ) {
                $meta_values['image'] = $meta_values['value'];
                $meta_values['style'] = $this->get_option_value(
                    $product_attr_options,
                    $product_attr_term_options,
                    'image_swatch_style',
                    'xt_woovs-round_corner',
                    $term
                );
                $meta_values['tooltip'] = $this->get_option_value(
                    $product_attr_options,
                    $product_attr_term_options,
                    'image_swatch_tooltip',
                    'disabled',
                    $term
                );
            } else {
                if ( $type === 'label' ) {
                    $meta_values['image'] = $this->get_variation_color_image( $variations, $attribute_slug, $option );
                    $meta_values['style'] = $this->get_option_value(
                        $product_attr_options,
                        $product_attr_term_options,
                        'label_swatch_style',
                        'xt_woovs-square',
                        $term
                    );
                    $meta_values['tooltip'] = $this->get_option_value(
                        $product_attr_options,
                        $product_attr_term_options,
                        'label_swatch_tooltip',
                        'disabled',
                        $term
                    );
                }
            }
        }
        if ( in_array( $type, array_keys( $this->core->types ) ) ) {
            if ( $meta_values['tooltip'] === 'image' ) {
                $meta_values['tooltip_image'] = $this->get_option_value(
                    $product_attr_options,
                    $product_attr_term_options,
                    'swatch_tooltip_image',
                    null,
                    $term
                );
            }
            if ( $meta_values['tooltip'] === 'text' ) {
                $meta_values['tooltip_text'] = $this->get_option_value(
                    $product_attr_options,
                    $product_attr_term_options,
                    'swatch_tooltip_text',
                    null,
                    $term
                );
            }
        }
        return $meta_values;
    }

    public function get_option_value(
        &$product_attr_options,
        &$product_attr_term_options,
        $key,
        $default,
        $term
    ) {
        // Product Level Attribute Term / Individual Swatch Options
        if ( !empty( $product_attr_term_options[$key] ) ) {
            return $product_attr_term_options[$key];
        } else {
            // Product Level Attribute Swatch Options
            if ( !empty( $product_attr_options[$key] ) ) {
                return $product_attr_options[$key];
            } else {
                // Global Attribute Term Level Swatch Options
                if ( !empty( $term ) ) {
                    $attr_term_option_value = get_term_meta( $term->term_id, $key, true );
                    if ( !empty( $attr_term_option_value ) ) {
                        return $attr_term_option_value;
                    }
                }
            }
        }
        // Global Customizer Swatch Options
        return xt_woovs_type_option( $key, $default );
    }

    public function swatch_type_override(
        &$meta_values,
        &$args,
        &$attr,
        $option,
        $is_term = false
    ) {
        extract( $meta_values );
        /** @var $type */
        /** @var $value */
        /** @var $image */
        /** @var $style */
        /** @var $tooltip */
        /** @var $tooltip_image */
        /** @var $tooltip_text */
        if ( (empty( $type ) || $type === 'select') && !empty( xt_woovs_type_option( 'other_to_label', true ) ) ) {
            $meta_values['value'] = '';
            $meta_values['type'] = 'label';
        }
        if ( $type === 'image' && !empty( $value ) ) {
            return false;
        }
        if ( !empty( xt_woovs_type_option( 'color_to_image', true ) ) ) {
            $attribute = $args['attribute'];
            $attribute_slug = sanitize_title( $attribute );
            $attribute = ( $is_term ? $attr->attribute_name : $attribute );
            $variations = $this->get_product_variations( $args['product'] );
            $custom_attributes = xt_woovs_type_option( 'color_to_image_custom_attributes', array() );
            $custom_attributes = XT_Framework_Customizer_Helpers::repeater_fields_string_to_array( $custom_attributes );
            if ( empty( $type ) || $type === 'select' ) {
                $attribute = strtolower( $attribute );
                $has_color = strpos( $attribute, 'color' ) !== false;
                $has_image = strpos( $attribute, 'image' ) !== false;
                if ( xt_woovs_search_attributes( $custom_attributes, 'attribute', $attribute ) !== null || $has_color || $has_image ) {
                    $new_value = $this->get_variation_color_image( $variations, $attribute_slug, $option );
                    $meta_values['type'] = ( !empty( $new_value ) ? 'image' : $type );
                    $meta_values['value'] = ( !empty( $new_value ) ? $new_value : $meta_values['value'] );
                }
            } else {
                if ( in_array( $type, array('color', 'image') ) ) {
                    $new_value = $this->get_variation_color_image( $variations, $attribute_slug, $option );
                    $meta_values['type'] = ( !empty( $new_value ) ? 'image' : $type );
                    $meta_values['value'] = ( !empty( $new_value ) ? $new_value : $meta_values['value'] );
                }
            }
        }
    }

    public function get_variation_color_image( &$variations, $attribute_slug, $option ) {
        $attribute_key = 'attribute_' . $attribute_slug;
        foreach ( $variations as $variation ) {
            if ( !empty( $variation['attributes'][$attribute_key] ) && $variation['attributes'][$attribute_key] === $option ) {
                return $variation["image_id"];
            }
        }
    }

    /**
     * Print HTML of a single swatch
     *
     * @param $html
     * @param $option
     * @param $meta_values
     * @param $selected
     *
     * @return string
     */
    public function swatch_meta_html(
        $html,
        $option,
        $meta_values = array(),
        $selected = null
    ) {
        extract( $meta_values );
        /** @var $type */
        /** @var $value */
        /** @var $image */
        /** @var $style */
        /** @var $tooltip */
        /** @var $tooltip_image */
        /** @var $tooltip_text */
        $tooltip_data = array(
            'tooltip'       => $tooltip,
            'tooltip_image' => ( $tooltip_image ? $tooltip_image : $image ),
            'tooltip_text'  => $tooltip_text,
        );
        switch ( $type ) {
            case 'color':
                $html = $this->get_color_swatch_html(
                    $option,
                    $option,
                    $value,
                    $tooltip_data,
                    $selected,
                    $style
                );
                break;
            case 'image':
                $html = $this->get_image_swatch_html(
                    $option,
                    $option,
                    $value,
                    $tooltip_data,
                    $selected,
                    $style
                );
                break;
            case 'label':
                $html = $this->get_label_swatch_html(
                    $option,
                    $option,
                    $tooltip_data,
                    $selected,
                    $style
                );
                break;
        }
        return $html;
    }

    /**
     * Print HTML of a single swatch
     *
     * @param $html
     * @param $term
     * @param $attributes
     * @param $product
     * @param $meta_values
     * @param $selected
     *
     * @return string
     */
    public function swatch_html(
        $html,
        $term,
        $attributes,
        $product,
        $meta_values = array(),
        $selected = null
    ) {
        $option = esc_html( apply_filters(
            'woocommerce_variation_option_name',
            $term->name,
            $term,
            $attributes,
            $product
        ) );
        $slug = $term->slug;
        extract( $meta_values );
        /** @var $type */
        /** @var $value */
        /** @var $image */
        /** @var $style */
        /** @var $tooltip */
        /** @var $tooltip_image */
        /** @var $tooltip_text */
        $tooltip_data = array(
            'tooltip'       => $tooltip,
            'tooltip_image' => ( $tooltip_image ? $tooltip_image : $image ),
            'tooltip_text'  => $tooltip_text,
        );
        switch ( $type ) {
            case 'color':
                $html = $this->get_color_swatch_html(
                    $slug,
                    $option,
                    $value,
                    $tooltip_data,
                    $selected,
                    $style
                );
                break;
            case 'image':
                $html = $this->get_image_swatch_html(
                    $slug,
                    $option,
                    $value,
                    $tooltip_data,
                    $selected,
                    $style
                );
                break;
            case 'label':
                $html = $this->get_label_swatch_html(
                    $slug,
                    $option,
                    $tooltip_data,
                    $selected,
                    $style
                );
                break;
        }
        return $html;
    }

    public function get_color_swatch_html(
        $slug,
        $name,
        $color,
        $tooltip_data,
        $selected,
        $style
    ) {
        extract( $tooltip_data );
        /** @var $tooltip */
        /** @var $tooltip_image */
        /** @var $tooltip_text */
        if ( empty( $color ) ) {
            $color = '#eaeaea';
        }
        $tooltip_class = '';
        $tooltip_value = '';
        $show_caption = false;
        return sprintf(
            '<li class="swatch swatch-color swatch-%s %s %s %s" title="%s" data-value="%s" data-tooltip_type="%s" data-tooltip_value="%s">%s<span class="swatch-inner swatch-color-inner"><span class="swatch-color-inner-inner" style="background-color:%s;"></span></span>%s</li>',
            esc_attr( $slug ),
            esc_attr( $selected ),
            esc_attr( $style ),
            esc_attr( $tooltip_class ),
            esc_attr( $name ),
            esc_attr( $slug ),
            esc_attr( $tooltip ),
            esc_attr( $tooltip_value ),
            ( $show_caption ? '<figure>' : '' ),
            esc_attr( $color ),
            ( $show_caption ? '<figcaption>' . esc_attr( ucfirst( $name ) ) . '</figcaption></figure>' : '' )
        );
    }

    public function get_image_swatch_html(
        $slug,
        $name,
        $image,
        $tooltip_data,
        $selected,
        $style
    ) {
        extract( $tooltip_data );
        /** @var $tooltip */
        /** @var $tooltip_image */
        /** @var $tooltip_text */
        $size = xt_woovs_type_option( 'image_swatch_size' );
        $image = $this->image_id_to_src( $image, array($size, $size) );
        $tooltip_class = '';
        $tooltip_value = '';
        $show_caption = false;
        return sprintf(
            '<li class="swatch swatch-image swatch-%s %s %s %s" title="%s" data-value="%s" data-tooltip_type="%s" data-tooltip_value="%s">%s<span class="swatch-inner swatch-image-inner"><img src="%s" alt="%s"></span>%s</li>',
            esc_attr( $slug ),
            esc_attr( $selected ),
            esc_attr( $style ),
            esc_attr( $tooltip_class ),
            esc_attr( $name ),
            esc_attr( $slug ),
            esc_attr( $tooltip ),
            esc_attr( $tooltip_value ),
            ( $show_caption ? '<figure>' : '' ),
            esc_url( $image ),
            esc_attr( $name ),
            ( $show_caption ? '<figcaption>' . esc_attr( ucfirst( $name ) ) . '</figcaption></figure>' : '' )
        );
    }

    public function get_label_swatch_html(
        $slug,
        $name,
        $tooltip_data,
        $selected,
        $style
    ) {
        extract( $tooltip_data );
        /** @var $tooltip */
        /** @var $tooltip_image */
        /** @var $tooltip_text */
        $tooltip_class = '';
        $tooltip_value = '';
        $flex_mode = xt_woovs_type_option_bool( 'label_swatch_flex_mode' );
        $flex_mode_class = ( $flex_mode ? 'xt_woovs-swatch-flex' : '' );
        return sprintf(
            '<li class="swatch swatch-label swatch-%s %s %s %s %s" title="%s" data-value="%s" data-tooltip_type="%s" data-tooltip_value="%s"><span class="swatch-inner swatch-label-inner">%s</span></li>',
            esc_attr( $slug ),
            esc_attr( $selected ),
            esc_attr( $style ),
            esc_attr( $flex_mode_class ),
            esc_attr( $tooltip_class ),
            esc_attr( $name ),
            esc_attr( $slug ),
            esc_attr( $tooltip ),
            esc_attr( $tooltip_value ),
            esc_html( $name )
        );
    }

    /**
     * Image id to src
     *
     * @param int $id
     * @param string|array $size
     *
     * @return string
     */
    public function image_id_to_src( $id, $size = 'woocommerce_thumbnail' ) {
        $image = ( $id ? wp_get_attachment_image_src( $id, $size ) : '' );
        $image = ( $image ? $image[0] : $this->core->plugin_url( 'admin/assets/images', 'placeholder.png' ) );
        return $image;
    }

    /**
     *
     * Get product variations
     *
     * @param $product
     *
     * @return array
     */
    public function get_product_variations( $product ) {
        $cache_key = 'xt_woovs_product_variations_' . $product->get_ID();
        return $this->core->cache()->result( $cache_key, function () use($product) {
            return $product->get_available_variations();
        } );
    }

}
