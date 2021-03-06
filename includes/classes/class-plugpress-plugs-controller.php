<?php
/**
 * Define methods for manage plugs
 *
 * @link       http://controlzetadigital.com
 * @author     Control Zeta <code@controlzetadigital.com>
 * @since      1.0.0
 * @package    PlugPress
 * @subpackage PlugPress/includes/classes
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
                    if (strpos($line, 'Author: ') !== false)
                        $info_data['author'] = str_replace('Author: ', '', $line);
                    if (strpos($line, 'Author URI: ') !== false)
                        $info_data['author_uri'] = str_replace('Author URI: ', '', $line);
                    if (strpos($line, 'License: ') !== false)
                        $info_data['license'] = str_replace('License: ', '', $line);                        
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
                'author'        => $plug_info['author'],
                'author_uri'    => $plug_info['author_uri'],
                'plug_path'     => self::$path . "/{$plug}",
                'plug_url'      => PLUGPRESS_URL . "plugs/{$plug}",
                'exec_path'     => self::$path . "/{$plug}/{$plug}.php"
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

    public static function get_plug($id) {
        $key = array_search($id, array_column(self::$plugs, 'plug_id'));
        return ($key !== false) ? self::$plugs[$key] : false;
    }
}