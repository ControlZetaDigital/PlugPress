<?php
/**
 * Define methods for manage settings
 *
 * @link       http://controlzetadigital.com
 * @author     Control Zeta <code@controlzetadigital.com>
 * @since      1.0.0
 * @package    PlugPress
 * @subpackage PlugPress/includes/classes
 */

namespace PlugPress\Settings;

defined( 'ABSPATH' ) || exit;

class PlugPress_Settings_Controller {

    protected static $plug_data = array(
        'plug_id'       => '',
        'plug_name'     => '',
        'enabled'       => 0
    );

    protected static $prefix = 'plugpress_';

    protected static function get( $option_id ) {
        return get_option($option_id);
    }

    protected static function set( $option_id, $data ) {
        return update_option($option_id, $data);
    }

    protected static function del( $option_id ) {
        return delete_option($option_id);
    }
}

class Plugs extends PlugPress_Settings_Controller {

    protected static $prefix = 'plugpress_plug_';

    public static function update_setting() {
        $id = $_POST['plug_id'];
        $setting = $_POST['setting'];
        $value = $_POST['value'];

        $plug = \PlugPress\PC\Plugs::get_plug($id);        
        $plug_data = array(
            'plug_id'       => $plug['plug_id'],
            'plug_name'     => $plug['plug_name']
        );
        $plug_data[$setting] = $value;

        if (self::set_option($plug['plug_id'], $plug_data)) {
            wp_send_json_success( 'Done!' );
        } else {
            wp_send_json_success( 'Error!' );
        }
    }

    public static function is_enabled( $plug_id ) {
        $plug_settings = self::get_option( $plug_id );

        return (isset($plug_settings['enabled']) && $plug_settings['enabled'] == 1);
    }

    public static function get_option( $plug_id ) {
        $option_id = self::$prefix . $plug_id;
        return self::get($option_id);
    }

    public static function set_option( $plug_id, $data ) {
        $option_id = self::$prefix . $plug_id;
        return self::set($option_id, $data);
    }
}