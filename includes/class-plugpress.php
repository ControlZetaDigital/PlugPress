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
		self::include_plugs();
		self::set_locale();
		self::setup_admin_context();
		self::setup_public_context();

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
	 * @access   private
	 */
    private static function include_files() {
        self::include_dir('classes');
        self::include_dir('functions');
        self::include('class-plugpress-admin', 'admin');
        self::include('class-plugpress-public', 'public');
    }

    /**
	 * Include all php files inside a given directory
	 *
	 * @since    1.0.0
	 * @access   private
     * @param    mixed     $directories      Array / String of directories
	 */
    private static function include_dir( $directories ) {
        if (!is_array($directories))
            $directories = array($directories);
            
        foreach ($directories as $directory) {    
            $path = PLUGPRESS_PATH . 'includes/' . $directory;

            $includes = glob( "$path/*.php" );
            sort( $includes );

            foreach ( $includes as $filename ) {
                $file_name = basename( $filename, '.php' );
                if ( file_exists( $filename ) && $file_name != 'index' )
                    require_once( $filename );
            }
        }
    }

	/**
	 * Include all php files
	 *
	 * @since    1.0.0
	 * @access   private
     * @param    mixed     $files      Array / String of files
	 */
    private static function include( $files, $dir = 'includes' ) {
        if (!is_array($files))
            $files = array($files);
            
        foreach ($files as $file) {
            $filename = PLUGPRESS_PATH . "{$dir}/{$file}.php";
			$file_name = basename( $filename, '.php' );
			if ( file_exists( $filename ) && $file != 'index' )
				require_once( $filename );
        }
    }

	/**
	 * Include and load plugs
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private static function include_plugs() {
		PlugPress\PC\Plugs::init();
        foreach(PlugPress\PC\Plugs::get_plugs() as $plug_data) {
			extract($plug_data);
            require_once $exec_path;
        }
    }

	/**
	 * Setup admin hooks and logic
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private static function setup_admin_context() {
		$admin = 'PlugPress_Admin';

		PlugPress_Loader::add_action( 'admin_enqueue_scripts', $admin, 'enqueue_styles' );
		PlugPress_Loader::add_action( 'admin_enqueue_scripts', $admin, 'enqueue_scripts' );
	}

	/**
	 * Setup public hooks and logic
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private static function setup_public_context() {
		$public = 'PlugPress_Public';

		PlugPress_Loader::add_action( 'wp_enqueue_scripts', $public, 'enqueue_styles' );
		PlugPress_Loader::add_action( 'wp_enqueue_scripts', $public, 'enqueue_scripts' );
	}
}