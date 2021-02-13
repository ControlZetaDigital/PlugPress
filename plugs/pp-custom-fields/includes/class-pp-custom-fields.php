<?php
/**
 * Main class for PlugPress Custom Fields
 *
 * @link       http://controlzetadigital.com
 * @since      1.0.0
 * @package    PpCustomFields
 * @subpackage PpCustomFields/includes
 */

class Plug_CustomFields extends PlugPress_Plug {

    public function __construct( $data ) {
        $this->id = $data['plug_id'];
        $this->data = $data;
    }

}