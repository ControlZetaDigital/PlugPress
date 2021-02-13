<?php
/**
 * Main class for PlugPress Custom Post Types
 *
 * @link       http://controlzetadigital.com
 * @since      1.0.0
 * @package    PpCustomPostTypes
 * @subpackage PpCustomPostTypes/includes
 */

class Plug_CustomPostTypes extends PlugPress_Plug {

    public function __construct( $data ) {
        $this->id = $data['plug_id'];
        $this->data = $data;
    }

}