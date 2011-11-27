<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Token Parser for {% html.method %}
 *
 */
class View_Extension_Form_TokenParser extends View_Extension_Helper_TokenParser {

    /**
     * @return string
     */
    public function getTag() {
        return 'form';
    }

}
