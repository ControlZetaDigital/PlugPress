<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://controlzetadigital.com
 * @since      1.0.0
 * @package    PlugPress
 * @subpackage PlugPress/includes/classes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    PlugPress
 * @subpackage PlugPress/includes/classes
 * @author     Control Zeta <code@controlzetadigital.com>
 */

defined( 'ABSPATH' ) || exit;

class PlugPress_i18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public static function load_text_domain() {

		load_plugin_textdomain(
			'plugpress',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages'
		);

	}

}
