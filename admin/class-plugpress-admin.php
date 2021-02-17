<?php
/**
 * Define admin methods
 *
 * @link       http://controlzetadigital.com
 * @author     Control Zeta <code@controlzetadigital.com>
 * @since      1.0.0
 * @package    PlugPress
 * @subpackage PlugPress/admin
 */

class PlugPress_Admin {

    protected static $prefix;

    protected static $plugin;

    protected static $version;

    protected static $admin;

    public static function init() {
        self::$plugin = PlugPress::get_plugin_name();
        self::$version = PlugPress::get_version();
        self::$admin = 'PlugPress_Admin';
        self::$prefix = self::$plugin . "_";
    }

    public static function enqueue_styles() {
        $plugin = self::$plugin;
        $version = self::$version;
        
        if (is_admin()) {
            wp_enqueue_style("{$plugin}__admin-styles", plugin_dir_url( __FILE__ ) . 'css/styles.css', [], $version, 'all' );
        }
    }

    public static function enqueue_scripts() {
        $plugin = self::$plugin;
        $version = self::$version;
        
        if (is_admin()) {
            wp_register_script("{$plugin}__admin-scripts", plugin_dir_url( __FILE__ ) . 'js/scripts.js', ['jquery', 'wp-util'], $version, true );

            wp_enqueue_script(["{$plugin}__admin-scripts"]);
        }
    }

    /**
	 * Register the plugin admin menu items.
	 *
	 * @since    1.0.0
	 */
    public static function add_admin_menu() {
        $admin = self::$admin;
        $prefix = self::$prefix;
        $plugin = self::$plugin;

        $page_title = '';
        $menu_title = __( 'PlugPress',  'plugpress' );
        $capability = 'read';
        $menu_slug  = "{$prefix}menu";
        $function   = array( $admin, 'render_dashboard_page' );
        //$icon_url   = plugin_dir_url( dirname( __FILE__ ) ) . "assets/img/{$plugin}-icon_24x24.png";
        $icon_url   = 'dashicons-welcome-learn-more';
        $position   = 12;

        add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );

        $submenu_pages = array(
            array(
                'parent_slug' => "{$prefix}menu",
                'page_title'  => '',
                'menu_title'  => __( 'Dashboard',  'plugpress' ),
                'capability'  => 'read',
                'menu_slug'   => "{$prefix}menu",
                'function'    => array( $admin, 'render_dashboard_page' )
            ),
            array(
                'parent_slug' => "{$prefix}menu",
                'page_title'  => '',
                'menu_title'  => __( 'My Plugs',  'plugpress' ),
                'capability'  => 'read',
                'menu_slug'   => "{$prefix}plugs",
                'function'    => array( $admin, 'render_plugs_page' )
            )/*,
            array(
                'parent_slug' => $this->prefix . 'menu',
                'page_title'  => '',
                'menu_title'  => __( 'Courses',  '__guroo__' ),
                'capability'  => 'read',
                'menu_slug'   => 'edit.php?post_type=' . $this->prefix . 'courses',
                'function'    => null
            ),
            array(
                'parent_slug' => $this->prefix . 'menu',
                'page_title'  => '',
                'menu_title'  => __( 'Categories',  '__guroo__' ),
                'capability'  => 'read',
                'menu_slug'   => 'edit-tags.php?taxonomy=' . $this->prefix . 'courses_categories&post_type=' . $this->prefix . 'courses',
                'function'    => null
            ),*/
        );

        foreach ( $submenu_pages as $submenu ) {
            add_submenu_page(
                $submenu['parent_slug'],
                $submenu['page_title'],
                $submenu['menu_title'],
                $submenu['capability'],
                $submenu['menu_slug'],
                $submenu['function']
            );
        }
    }

    /**
     * Creates the settings page for the plugin options page.
     * 
     * @since    1.0.0
     */
    /*public function add_plugin_settings_page() {
        acf_add_options_sub_page(array(
            'parent_slug' => $this->prefix . 'menu',
            'page_title'  => __( 'Settings',  '__guroo__' ) . ' (' . __( 'Guroo',  '__guroo__' ) . ')',
            'menu_title'  => __( 'Settings',  '__guroo__' ),
            'menu_slug'   => $this->prefix . 'settings'
        ));
    }*/

    /**
     * Renders the plugin's dashboard page.
     * 
     * @since    1.0.0
     */
    public static function render_dashboard_page() {

        require plugin_dir_path( dirname( __FILE__ ) ) . 'admin/views/pages/dashboard.php';
    }

    /**
     * Renders the plugs list page.
     * 
     * @since    1.0.0
     */
    public static function render_plugs_page() {
        $prefix = self::$prefix;
        $plugs = PlugPress\PC\Plugs::get_plugs();
        $settings = 'PlugPress\Settings\Plugs';

        require plugin_dir_path( dirname( __FILE__ ) ) . 'admin/views/pages/plugs.php';
    }
}