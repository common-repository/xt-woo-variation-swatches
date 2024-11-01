<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://xplodedthemes.com
 * @since      1.0.0
 *
 * @package    XT_Woo_Variation_Swatches
 * @subpackage XT_Woo_Variation_Swatches/admin
 */
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    XT_Woo_Variation_Swatches
 * @subpackage XT_Woo_Variation_Swatches/admin
 * @author     XplodedThemes
 */
class XT_Woo_Variation_Swatches_Admin {
    /**
     * Core class reference.
     *
     * @since    1.0.0
     * @access   private
     * @var      XT_Woo_Variation_Swatches    $core    Core Class
     */
    protected $core;

    /**
     * Var that holds the product class object.
     *
     * @since    1.0.0
     * @access   protected
     * @var      XT_Woo_Variation_Swatches_Admin_Product    $product   Product Class
     */
    protected $product;

    /**
     * Var that holds the page types array
     *
     * @since    1.0.0
     * @access   protected
     * @var      array    $types   Types Array
     */
    public static $types = array();

    /**
     * Initialize the backend and define admin hooks
     *
     * @since    1.0.0
     * @param    XT_Woo_Variation_Swatches $core Core Class
     */
    public function __construct( &$core ) {
        $this->core = $core;
        self::$types = array(array(
            'id'    => 'single',
            'title' => esc_html__( 'Single Product', 'xt-woo-variation-swatches' ),
            'icon'  => 'dashicons-align-left',
        ), array(
            'id'    => 'archives',
            'title' => esc_html__( 'Archives / Shop', 'xt-woo-variation-swatches' ),
            'icon'  => 'dashicons-grid-view',
        ));
        add_action( 'admin_enqueue_scripts', array($this, 'enqueue_styles') );
        add_action( 'admin_enqueue_scripts', array($this, 'enqueue_scripts') );
        add_action( 'admin_init', array($this, 'init_attribute_hooks'), 1 );
        add_action(
            'woocommerce_product_option_terms',
            array($this, 'product_option_terms'),
            10,
            2
        );
        add_action(
            'xt_woovs_product_attribute_field',
            array($this, 'attribute_fields'),
            10,
            5
        );
        add_filter( 'product_attributes_type_selector', array($this, 'add_attribute_types') );
        // Init modules
        add_filter(
            $this->core->plugin_prefix( 'modules' ),
            array($this, 'modules'),
            1,
            1
        );
        // Init customizer options
        add_filter(
            $this->core->plugin_prefix( 'customizer_panels' ),
            array($this, 'customizer_panels'),
            1,
            1
        );
        add_filter(
            $this->core->plugin_prefix( 'customizer_sections' ),
            array($this, 'customizer_sections'),
            1,
            1
        );
        add_filter(
            $this->core->plugin_prefix( 'customizer_fields' ),
            array($this, 'customizer_fields'),
            1,
            2
        );
        add_action( $this->core->plugin_prefix( 'customizer_controls_assets' ), array($this, 'customizer_controls_assets'), 1 );
        $this->init_backend_dependencies();
    }

    public function init_backend_dependencies() {
        $this->product = new XT_Woo_Variation_Swatches_Admin_Product($this->core);
    }

    public function modules( $modules ) {
        $modules[] = 'add-to-cart';
        return $modules;
    }

    public function customizer_panels( $panels ) {
        $panels[] = array(
            'title' => $this->core->plugin_menu_name(),
            'icon'  => 'dashicons-screenoptions',
        );
        foreach ( self::$types as $type ) {
            $panels[] = array(
                'id'    => $type['id'],
                'title' => $type['title'],
                'icon'  => $type['icon'],
            );
        }
        return $panels;
    }

    public function customizer_sections( $sections ) {
        $sections[] = array(
            'id'    => 'swatch-global',
            'title' => esc_html__( 'Global Settings', 'xt-woo-variation-swatches' ),
            'icon'  => 'dashicons-admin-generic',
        );
        foreach ( self::$types as $_type ) {
            $type = $_type['id'];
            $sections[] = array(
                'id'    => $type . '-swatch-general',
                'title' => esc_html__( 'General Swatch Settings', 'xt-woo-variation-swatches' ),
                'panel' => $type,
                'icon'  => 'dashicons-admin-generic',
            );
            $sections[] = array(
                'id'    => $type . '-swatch-styling',
                'title' => esc_html__( 'General Look & Feel', 'xt-woo-variation-swatches' ),
                'panel' => $type,
                'icon'  => 'dashicons-admin-settings',
            );
            if ( $type === 'archives' ) {
                $sections[] = array(
                    'id'    => $type . '-swatch-display',
                    'title' => esc_html__( 'Display Settings', 'xt-woo-variation-swatches' ),
                    'panel' => $type,
                    'icon'  => 'dashicons-ellipsis',
                );
            }
            $sections[] = array(
                'id'    => $type . '-swatch-label',
                'title' => esc_html__( 'Label Swatch Settings', 'xt-woo-variation-swatches' ),
                'panel' => $type,
                'icon'  => 'dashicons-editor-bold',
            );
            $sections[] = array(
                'id'    => $type . '-swatch-color',
                'title' => esc_html__( 'Color Swatch Settings', 'xt-woo-variation-swatches' ),
                'panel' => $type,
                'icon'  => 'dashicons-admin-appearance',
            );
            $sections[] = array(
                'id'    => $type . '-swatch-image',
                'title' => esc_html__( 'Image Swatch Settings', 'xt-woo-variation-swatches' ),
                'panel' => $type,
                'icon'  => 'dashicons-format-image',
            );
            $sections[] = array(
                'id'    => $type . '-swatch-tooltip',
                'title' => esc_html__( 'Swatch Tooltip Settings', 'xt-woo-variation-swatches' ),
                'panel' => $type,
                'icon'  => 'dashicons-admin-comments',
            );
        }
        return $sections;
    }

    public function customizer_fields( $fields, $customizer ) {
        require $this->core->plugin_path( 'admin/customizer/fields', 'swatch-global.php' );
        foreach ( self::$types as $_type ) {
            $type = $_type['id'];
            $element_prefix = '.xt_woovs-' . $type . '-product';
            $page_prefix = '.xt_woovs-' . $type;
            require $this->core->plugin_path( 'admin/customizer/fields', 'swatch-general.php' );
            require $this->core->plugin_path( 'admin/customizer/fields', 'swatch-styling.php' );
            if ( $type === 'archives' ) {
                require $this->core->plugin_path( 'admin/customizer/fields', 'swatch-display.php' );
            }
            require $this->core->plugin_path( 'admin/customizer/fields', 'swatch-label.php' );
            require $this->core->plugin_path( 'admin/customizer/fields', 'swatch-color.php' );
            require $this->core->plugin_path( 'admin/customizer/fields', 'swatch-image.php' );
            require $this->core->plugin_path( 'admin/customizer/fields', 'swatch-tooltip.php' );
        }
        return $fields;
    }

    public function customizer_controls_assets() {
        wp_register_script(
            $this->core->plugin_prefix( 'customizer-controls' ),
            $this->core->plugin_url() . 'admin/customizer/assets/js/customizer-controls' . XTFW_SCRIPT_SUFFIX . '.js',
            array('jquery', 'customize-preview'),
            $this->core->plugin_version(),
            true
        );
        $variations = get_posts( array(
            'post_type'   => 'product_variation',
            'numberposts' => 1,
        ) );
        $single_url = '';
        $archives_url = get_permalink( wc_get_page_id( 'shop' ) );
        if ( !empty( $variations ) ) {
            $variation = array_shift( $variations );
            $product_id = $variation->post_parent;
            $single_url = get_permalink( $product_id );
        }
        wp_localize_script( $this->core->plugin_prefix( 'customizer-controls' ), 'woovs_controls', array(
            'single_url'  => $single_url,
            'archive_url' => $archives_url,
            'is_shop'     => is_shop(),
        ) );
        wp_enqueue_script( $this->core->plugin_prefix( 'customizer-controls' ) );
    }

    public function get_product_attributes_options( $types = null, $allowEmpty = false ) {
        $attributes = ( function_exists( 'wc_get_attribute_taxonomies' ) ? wc_get_attribute_taxonomies() : array() );
        $options = array();
        foreach ( $attributes as $attribute ) {
            if ( !empty( $types ) && !in_array( $attribute->attribute_type, $types ) ) {
                continue;
            }
            $options['pa_' . $attribute->attribute_name] = $attribute->attribute_label;
        }
        return $options;
    }

    public function types_default_values( $type, $single_value, $archive_value ) {
        return ( $type === 'single' ? $single_value : $archive_value );
    }

    /**
     * Register the stylesheets for the admin area.
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
            $this->core->plugin_slug( 'admin' ),
            $this->core->plugin_url( 'admin/assets/css', 'admin.css' ),
            array('wp-color-picker'),
            $this->core->plugin_version(),
            'all'
        );
    }

    /**
     * Register the JavaScript for the admin area.
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
        wp_enqueue_media();
        wp_register_script(
            $this->core->plugin_slug( 'admin' ),
            $this->core->plugin_url( 'admin/assets/js', 'admin' . XTFW_SCRIPT_SUFFIX . '.js' ),
            array('jquery', 'wp-color-picker', 'wp-util'),
            $this->core->plugin_version(),
            true
        );
        wp_localize_script( $this->core->plugin_slug( 'admin' ), 'xt_woovs', array(
            'i18n'              => array(
                'mediaTitle'  => esc_html__( 'Choose an image', 'xt-woo-variation-swatches' ),
                'mediaButton' => esc_html__( 'Use image', 'xt-woo-variation-swatches' ),
            ),
            'placeholder'       => $this->core->plugin_url( 'admin/assets/images', 'placeholder.png' ),
            'color_placeholder' => "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAE4AAABQAQMAAACNuNG1AAAABlBMVEXMzMz////TjRV2AAAAHElEQVR4AWNg+A+Ff6jL/A+HVGUOZfeOunfUvQAbQI4IO7xuxwAAAABJRU5ErkJggg==",
        ) );
        wp_enqueue_script( $this->core->plugin_slug( 'admin' ) );
    }

    /**
     * Init hooks for adding fields to attribute screen
     * Save new term meta
     * Add thumbnail column for attribute term
     */
    public function init_attribute_hooks() {
        $attribute_taxonomies = ( function_exists( 'wc_get_attribute_taxonomies' ) ? wc_get_attribute_taxonomies() : array() );
        if ( empty( $attribute_taxonomies ) ) {
            return;
        }
        foreach ( $attribute_taxonomies as $tax ) {
            add_action( 'pa_' . $tax->attribute_name . '_add_form_fields', array($this, 'add_attribute_fields') );
            add_action(
                'pa_' . $tax->attribute_name . '_edit_form_fields',
                array($this, 'edit_attribute_fields'),
                10,
                2
            );
            add_filter( 'manage_edit-pa_' . $tax->attribute_name . '_columns', array($this, 'add_attribute_columns') );
            add_filter(
                'manage_pa_' . $tax->attribute_name . '_custom_column',
                array($this, 'add_attribute_column_content'),
                10,
                3
            );
        }
        add_action(
            'created_term',
            array($this, 'save_term_meta'),
            10,
            2
        );
        add_action(
            'edit_term',
            array($this, 'save_term_meta'),
            10,
            2
        );
        add_action(
            'quick_edit_custom_box',
            array($this, 'quick_edit_attribute_type_field'),
            10,
            2
        );
    }

    /**
     * Add extra attribute types
     * Add color, image and label type
     *
     * @param array $types
     *
     * @return array
     */
    public function add_attribute_types( $types ) {
        if ( !empty( $_POST['action'] ) && $_POST['action'] === 'woocommerce_save_attributes' ) {
            return $types;
        }
        $types = array_merge( $types, $this->core->types );
        return $types;
    }

    /**
     * Get attribute's properties
     *
     * @param string $taxonomy
     *
     * @return object
     */
    public function get_tax_attribute( $taxonomy ) {
        global $wpdb;
        $cache_key = $this->core->plugin_short_prefix( 'get_tax_attribute_' . $taxonomy );
        $attr = wp_cache_get( $cache_key );
        if ( false === $attr ) {
            $attr = substr( $taxonomy, 3 );
            $attr = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . "woocommerce_attribute_taxonomies WHERE attribute_name = %s", $attr ) );
            wp_cache_set( $cache_key, $attr );
        }
        return $attr;
    }

    /**
     * Create hook to add fields to add attribute term screen
     *
     * @param string $taxonomy
     */
    public function add_attribute_fields( $taxonomy ) {
        $attr = $this->get_tax_attribute( $taxonomy );
        if ( !in_array( $attr->attribute_type, array_keys( $this->core->types ) ) ) {
            return false;
        }
        do_action(
            'xt_woovs_product_attribute_field',
            $attr->attribute_type,
            $attr->attribute_type,
            ucfirst( $attr->attribute_type ),
            '',
            'add'
        );
        do_action(
            'xt_woovs_product_attribute_field',
            'tooltip',
            $attr->attribute_type . '_swatch_tooltip',
            'Tooltip',
            '',
            'add'
        );
    }

    /**
     * Create hook to fields to edit attribute term screen
     *
     * @param object $term
     * @param string $taxonomy
     */
    public function edit_attribute_fields( $term, $taxonomy ) {
        $attr = $this->get_tax_attribute( $taxonomy );
        if ( !in_array( $attr->attribute_type, array_keys( $this->core->types ) ) ) {
            return false;
        }
        $value = get_term_meta( $term->term_id, $attr->attribute_type, true );
        $tooltip = get_term_meta( $term->term_id, $attr->attribute_type . '_swatch_tooltip', true );
        do_action(
            'xt_woovs_product_attribute_field',
            $attr->attribute_type,
            $attr->attribute_type,
            ucfirst( $attr->attribute_type ),
            $value,
            'edit'
        );
        do_action(
            'xt_woovs_product_attribute_field',
            'tooltip',
            $attr->attribute_type . '_swatch_tooltip',
            'Tooltip',
            $tooltip,
            'edit'
        );
        if ( $tooltip === 'image' ) {
            $tooltip_image = get_term_meta( $term->term_id, 'swatch_tooltip_image', true );
            do_action(
                'xt_woovs_product_attribute_field',
                'tooltip_image',
                'swatch_tooltip_image',
                'Tooltip Image',
                $tooltip_image,
                'edit'
            );
        } else {
            if ( $tooltip === 'text' ) {
                $tooltip_text = get_term_meta( $term->term_id, 'swatch_tooltip_text', true );
                do_action(
                    'xt_woovs_product_attribute_field',
                    'tooltip_text',
                    'swatch_tooltip_text',
                    'Tooltip Text',
                    $tooltip_text,
                    'edit'
                );
            }
        }
    }

    /**
     * Print HTML of custom fields on attribute term screens
     *
     * @param $type
     * @param $value
     * @param $form
     */
    public function attribute_fields(
        $id,
        $meta_key,
        $label,
        $value,
        $form
    ) {
        // Return if this is a default attribute type
        if ( in_array( $id, array('select', 'text', 'label') ) ) {
            return;
        }
        // Print the open tag of field container
        printf(
            '<%s class="form-field">%s<label for="xt_woovs-term-%s">%s</label>%s',
            ( 'edit' == $form ? 'tr' : 'div' ),
            ( 'edit' == $form ? '<th>' : '' ),
            $id,
            $label,
            ( 'edit' == $form ? '</th><td>' : '' )
        );
        $this->attribute_swatch_type_field( $id, $meta_key, $value );
        // Print the close tag of field container
        echo ( 'edit' == $form ? '</td></tr>' : '</div>' );
    }

    /**
     * Display markup or template for custom field
     */
    function quick_edit_attribute_type_field( $column_name, $screen ) {
        // If we're not iterating over our custom column, then skip
        if ( $screen == 'edit-tag' && $column_name != 'thumb' ) {
            return false;
        }
        $post_type = sanitize_text_field( $_REQUEST['post_type'] );
        if ( $post_type !== 'product' ) {
            return false;
        }
        if ( empty( $_REQUEST['taxonomy'] ) ) {
            return false;
        }
        $attr = $this->get_tax_attribute( $_REQUEST['taxonomy'] );
        if ( empty( $attr->attribute_type ) || !in_array( $attr->attribute_type, array_keys( $this->core->types ) ) ) {
            return false;
        }
        ?>
        <fieldset>
            <div id="gwp-first-appeared" class="inline-edit-col">
                <label>
                    <span class="title"><?php 
        echo esc_html__( 'Swatch', 'xt-woo-variation-swatches' );
        ?></span>
                    <span class="input-text-wrap">
	                	<?php 
        $this->attribute_swatch_type_field( $attr->attribute_type, $attr->attribute_type );
        ?>
	                </span>
                </label>
                <label>
                    <span class="title"><?php 
        echo esc_html__( 'Tooltip', 'xt-woo-variation-swatches' );
        ?></span>
                    <span class="input-text-wrap">
	                	<?php 
        $this->attribute_swatch_type_field( 'tooltip', $attr->attribute_type . '_swatch_tooltip' );
        ?>
	                </span>
                </label>
                <label class="xt_woovs-inline-edit-hidden">
                    <span class="title"><?php 
        echo esc_html__( 'Tooltip Image', 'xt-woo-variation-swatches' );
        ?></span>
                    <span class="input-text-wrap">
	                	<?php 
        $this->attribute_swatch_type_field( 'tooltip_image', 'swatch_tooltip_image' );
        ?>
	                </span>
                </label>
                <label class="xt_woovs-inline-edit-hidden">
                    <span class="title"><?php 
        echo esc_html__( 'Tooltip Text', 'xt-woo-variation-swatches' );
        ?></span>
                    <span class="input-text-wrap">
	                	<?php 
        $this->attribute_swatch_type_field( 'tooltip_text', 'swatch_tooltip_text' );
        ?>
	                </span>
                </label>
            </div>
        </fieldset>
        <?php 
    }

    public function attribute_swatch_type_field( $id, $meta_key, $value = '' ) {
        switch ( $id ) {
            case 'image':
                $image = ( $value ? wp_get_attachment_image_src( $value ) : '' );
                $image_preview = ( $image ? $image[0] : $this->core->plugin_url( 'admin/assets/images', 'placeholder.png' ) );
                $image_remove_hidden = ( $image ? '' : 'hidden' );
                ?>

                <div class="xt_woovs_image_picker swatch_image">
                    <img src="<?php 
                echo esc_url( $image_preview );
                ?>" width="60px" height="60px" />
                    <input type="hidden" class="xt_woovs-term-image" name="<?php 
                echo esc_attr( $meta_key );
                ?>" value="<?php 
                echo esc_attr( $value );
                ?>" />
                    <a href="#" class="button xt_woovs-meta-uploader" data-uploader-title="<?php 
                echo esc_html__( 'Add image to Attribute ', 'xt-woo-variation-swatches' );
                ?>" data-uploader-button-text="<?php 
                echo esc_html__( 'Add image to Attribute ', 'xt-woo-variation-swatches' );
                ?>  "> <?php 
                echo esc_html__( 'Upload/Add image', 'xt-woo-variation-swatches' );
                ?></a>
                    <a href="#" class="xt_woovs_remove_meta_img button <?php 
                echo esc_attr( $image_remove_hidden );
                ?>"><?php 
                echo esc_html__( 'Remove image', 'xt-woo-variation-swatches' );
                ?></a>
                </div>
                <div class="xt_woovs-clearfix"></div>
                <?php 
                break;
            case 'color':
                ?>
                <input type="text" class="xt_woovs-term-<?php 
                echo esc_attr( $meta_key );
                ?> xt_woovs-color-picker" name="<?php 
                echo esc_attr( $meta_key );
                ?>" value="<?php 
                echo esc_attr( $value );
                ?>" />
                <?php 
                break;
            case 'tooltip':
                $this->render_upgrade_notice();
                break;
            case 'tooltip_image':
                $this->render_upgrade_notice();
                break;
            case 'tooltip_text':
                $this->render_upgrade_notice();
                break;
            default:
                break;
        }
    }

    public function render_upgrade_notice() {
        ?>
        <div>
            <span>
                <strong><?php 
        echo __( 'Premium Feature!', 'xt-woo-variation-swatches' );
        ?></strong>
                <a href="<?php 
        echo esc_url( $this->core->access_manager()->get_upgrade_url() );
        ?>"><?php 
        echo __( 'Upgrade to Unlock!', 'xt-woo-variation-swatches' );
        ?></a>
            </span>
        </div>
        <br>
        <?php 
    }

    /**
     * Save term meta
     *
     * @param int $term_id
     * @param int $tt_id
     */
    public function save_term_meta( $term_id ) {
        foreach ( xt_woo_variation_swatches()->types as $type => $label ) {
            $meta_key = $type;
            if ( isset( $_POST[$meta_key] ) ) {
                update_term_meta( $term_id, $meta_key, sanitize_text_field( $_POST[$meta_key] ) );
            }
            $meta_key = $type . '_swatch_tooltip';
            if ( isset( $_POST[$meta_key] ) ) {
                update_term_meta( $term_id, $meta_key, sanitize_text_field( $_POST[$meta_key] ) );
            }
            $meta_key = 'swatch_tooltip_text';
            if ( isset( $_POST[$meta_key] ) ) {
                update_term_meta( $term_id, $meta_key, sanitize_text_field( $_POST[$meta_key] ) );
            }
            $meta_key = 'swatch_tooltip_image';
            if ( isset( $_POST[$meta_key] ) ) {
                update_term_meta( $term_id, $meta_key, sanitize_text_field( $_POST[$meta_key] ) );
            }
        }
    }

    /**
     * Add selector for extra attribute types
     *
     * @param $taxonomy
     * @param $index
     */
    public function product_option_terms( $taxonomy, $index ) {
        if ( !array_key_exists( $taxonomy->attribute_type, xt_woo_variation_swatches()->types ) ) {
            return;
        }
        $taxonomy_name = wc_attribute_taxonomy_name( $taxonomy->attribute_name );
        global $thepostid;
        ?>

        <select multiple="multiple" data-placeholder="<?php 
        esc_attr_e( 'Select terms', 'xt-woo-variation-swatches' );
        ?>" class="multiselect attribute_values wc-enhanced-select" name="attribute_values[<?php 
        echo esc_attr( $index );
        ?>][]">
            <?php 
        $all_terms = get_terms( $taxonomy_name, apply_filters( 'woocommerce_product_attribute_terms', array(
            'orderby'    => 'name',
            'hide_empty' => false,
        ) ) );
        if ( $all_terms ) {
            foreach ( $all_terms as $term ) {
                echo '<option value="' . esc_attr( $term->term_id ) . '" ' . selected( has_term( absint( $term->term_id ), $taxonomy_name, $thepostid ), true, false ) . '>' . esc_attr( apply_filters( 'woocommerce_product_attribute_term_name', $term->name, $term ) ) . '</option>';
            }
        }
        ?>
        </select>
        <button class="button plus select_all_attributes"><?php 
        esc_html_e( 'Select all', 'xt-woo-variation-swatches' );
        ?></button>
        <button class="button minus select_no_attributes"><?php 
        esc_html_e( 'Select none', 'xt-woo-variation-swatches' );
        ?></button>

        <?php 
    }

    /**
     * Add thumbnail column to column list
     *
     * @param array $columns
     *
     * @return array
     */
    public function add_attribute_columns( $columns ) {
        $new_columns = array();
        $new_columns['cb'] = $columns['cb'];
        $new_columns['thumb'] = esc_html( 'Preview', 'xt-woo-variation-swatches' );
        unset($columns['cb']);
        return array_merge( $new_columns, $columns );
    }

    /**
     * Render thumbnail HTML depends on attribute type
     *
     * @param $columns
     * @param $column
     * @param $term_id
     */
    public function add_attribute_column_content( $columns, $column, $term_id ) {
        $attr = $this->get_tax_attribute( $_REQUEST['taxonomy'] );
        $this->render_attribute_swatch_type_field_value( $term_id, $attr->attribute_type, $attr->attribute_type );
        $this->render_attribute_swatch_type_field_value( $term_id, 'tooltip', $attr->attribute_type . '_swatch_tooltip' );
        $this->render_attribute_swatch_type_field_value( $term_id, 'tooltip_image', 'swatch_tooltip_image' );
        $this->render_attribute_swatch_type_field_value( $term_id, 'tooltip_text', 'swatch_tooltip_text' );
    }

    public function render_attribute_swatch_type_field_value( $term_id, $id, $meta_key ) {
        $value = get_term_meta( $term_id, $meta_key, true );
        switch ( $id ) {
            case 'color':
                echo sprintf( '<div class="swatch-preview swatch-color" style="background-color:%1$s;"></div>', esc_attr( $value ) );
                break;
            case 'image':
                $image = ( is_numeric( $value ) ? wp_get_attachment_image_src( $value ) : $value );
                $image = ( is_array( $image ) ? $image[0] : $image );
                $image = ( empty( $image ) ? $this->core->plugin_url( 'admin/assets/images', 'placeholder.png' ) : $image );
                echo sprintf(
                    '
                    <img class="swatch-preview swatch-image" src="%1$s" width="50px" height="50px">
                    <input class="swatch-image-input" type="hidden" data-url="%2$s" value="%3$s"  />',
                    esc_url( $image ),
                    esc_url( $image ),
                    esc_textarea( $value )
                );
                break;
            case 'radio':
                echo sprintf( '<input type="radio" name="radio" value="%1$s" />', esc_textarea( $value ) );
                break;
            case 'tooltip':
                echo sprintf( '<input class="swatch-tooltip-input" type="hidden" value="%1$s" />', esc_textarea( $value ) );
                break;
            case 'tooltip_image':
                $image = ( is_numeric( $value ) ? wp_get_attachment_image_src( $value ) : $value );
                $image = ( is_array( $image ) ? $image[0] : $image );
                $image = ( empty( $image ) ? $this->core->plugin_url( 'admin/assets/images', 'placeholder.png' ) : $image );
                echo sprintf( '<input class="swatch-tooltip-image-input" type="hidden" data-url="%1$s" value="%2$s" />', esc_url( $image ), esc_textarea( $value ) );
                break;
            case 'tooltip_text':
                echo sprintf( '<input class="swatch-tooltip-text-input" type="hidden" value="%1$s" />', esc_textarea( $value ) );
                break;
        }
    }

}
