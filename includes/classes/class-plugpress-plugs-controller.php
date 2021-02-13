<?php

/**
 * Define methods for manage plugs
 *
 * @link       http://controlzetadigital.com
 * @since      1.0.0
 * @package    PlugPress
 * @subpackage PlugPress/includes/classes
 */

/**
 * Define methods for manage plugs
 *
 * @since      1.0.0
 * @package    PlugPress
 * @subpackage PlugPress/includes/classes
 * @author     Control Zeta <code@controlzetadigital.com>
 */

namespace PlugPress\PC;

defined( 'ABSPATH' ) || exit;

class PlugPress_Plugs_Controller {

    protected static $path = PLUGPRESS_PATH . 'plugs';

    protected static $plugs = array();

    public static function find_plugs() {
        $plugs_path = self::$path;
        $temp_plugs = glob( "$plugs_path/*", GLOB_ONLYDIR );
        sort($temp_plugs);

        $plugs = array();
        foreach ($temp_plugs as $dir) {
            $plugs[] = basename($dir);
        }

        return $plugs;
    }

    public static function get_plug_info( $plug ) {
        $plug_file = self::$path . "/$plug/$plug.php";

        if ( file_exists( $plug_file ) ) {
            $tokens = token_get_all(file_get_contents($plug_file));
            $comments = array();
            foreach($tokens as $token) {
                if($token[0] == T_COMMENT || $token[0] == T_DOC_COMMENT) {
                    $comments[] = $token[1];
                }
            }
            if(strpos($comments[0], 'Plug Name:') !== false) {
                $first_comment = str_replace(['/*', '*/'], '', $comments[0]);
                $info = array();
                foreach(preg_split("/((\r?\n)|(\r\n?))/", $first_comment) as $line)
                    $info[] = $line;

                $info_data = array();
                foreach ($info as $line) {
                    if (strpos($line, 'Plug Name: ') !== false)
                        $info_data['plug_name'] = str_replace('Plug Name: ', '', $line);
                    if (strpos($line, 'Description: ') !== false)
                        $info_data['description'] = str_replace('Description: ', '', $line);
                    if (strpos($line, 'Version: ') !== false)
                        $info_data['version'] = str_replace('Version: ', '', $line);
                }

                return $info_data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function get_plugs_with_data() {
        $plugs = self::find_plugs();
        $plugs_width_data = array();
        foreach ($plugs as $plug) {
            $plug_info = self::get_plug_info( $plug );
            $plugs_width_data[] = array(
                'plug_id'       => $plug,
                'plug_name'     => $plug_info['plug_name'],
                'description'   => $plug_info['description'],
                'version'       => $plug_info['version'],
                'plug_path'     => self::$path . "/{$plug}",
                'plug_url'      => PLUGPRESS_URL . "plugs/{$plug}",
                'exec_path'     => self::$path . "/{$plug}/{$plug}.php",
                'name_space'    => str_replace( "-", "", ucwords( $plug, "-" ) )
            );
        }

        return $plugs_width_data;
    }
}

class Plugs extends PlugPress_Plugs_Controller {

    public static function init() {
        self::$plugs = self::get_plugs_with_data();
    }

    public static function get_plugs() {
        return self::$plugs;
    }
}