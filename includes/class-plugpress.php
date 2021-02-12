<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://controlzetadigital.com
 * @since      1.0.0
 *
 * @package    PlugPress
 * @subpackage PlugPress/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    PlugPress
 * @subpackage PlugPress/includes
 * @author     Control Zeta. <code@controlzetadigital.com>
 */

defined( 'ABSPATH' ) || exit;

Class PlugPress {

    /**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin    The string used to uniquely identify this plugin.
	 */
	protected static $plugin;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected static $version;

    public function __construct() {}

    /**
	 * Function that trigger all hooks
	 *
	 * @since    1.0.0
	 * @access   public
	 */
    public static function run() {
		if ( defined( 'PLUGPRESS_VERSION' ) ) {
            self::$version = PLUGPRESS_VERSION;
        } else {
            self::$version = '1.0.0';
        }
        self::$plugin = PLUGPRESS_PLUGIN;

        self::include_files();
        self::set_locale();

		PlugPress_Plugs_Controller::init();
		print_r(PlugPress_Plugs_Controller::get_plugs());

        PlugPress_Loader::run();
    }

	/**
	 * Return plugin's version
	 *
	 * @since    1.0.0
	 * @return   string		Plugin's version
	 */
	public static function get_version() {
		return self::$version;
	}

	/**
	 * Return plugin's name
	 *
	 * @since    1.0.0
	 * @return   string		Plugin's name
	 */
	public static function get_plugin_name() {
		return self::$plugin;
	}

    /**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Guroo_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private static function set_locale() {
		PlugPress_Loader::add_action( 'plugins_loaded', 'PlugPress_i18n', 'load_text_domain' );
	}

    /**
	 * Include all classes, functions and helpers
	 *
	 * @since    1.0.0
	 * @access   public
	 */
    private static function include_files() {
        self::include('classes');
        self::include('functions');
    }

    /**
	 * Include all php files inside a given folder
	 *
	 * @since    1.0.0
	 * @access   public
     * @param    mixed     $folders      Array / String of folders
	 */
    private static function include( $folders ) {
        if (!is_array($folders))
            $folders = array($folders);
            
        foreach ($folders as $folder) {    
            $path = PLUGPRESS_PATH . 'includes/' . $folder;

            $includes = glob( "$path/*.php" );
            sort( $includes );

            foreach ( $includes as $filename ) {
                $file = basename( $filename, '.php' );
                if ( file_exists( $filename ) && $file != 'index' )
                    require_once( $filename );
            }
        }
    }
}