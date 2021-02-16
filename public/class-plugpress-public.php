<?php
/**
 * Define public methods
 *
 * @link       http://controlzetadigital.com
 * @author     Control Zeta <code@controlzetadigital.com>
 * @since      1.0.0
 * @package    PlugPress
 * @subpackage PlugPress/public
 */

class PlugPress_Public {
    
    public static function enqueue_styles() {
        $plugin = PlugPress::get_plugin_name();
        $version = PlugPress::get_version();
        
        wp_enqueue_style("{$plugin}__public-styles", plugin_dir_url( __FILE__ ) . 'css/styles.css', [], $version, 'all' );
    }

    public static function enqueue_scripts() {
        $plugin = PlugPress::get_plugin_name();
        $version = PlugPress::get_version();
        
        wp_register_script("{$plugin}__public-scripts", plugin_dir_url( __FILE__ ) . 'js/scripts.js', ['jquery'], $version, true );

        wp_enqueue_script(["{$plugin}__public-scripts"]);
    }
}