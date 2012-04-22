<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Loads a default set of filters and extensions for 
 * Twig based views
 *
 */
class View_Extensions extends Twig_Extension {

    /**
     * Returns the added token parsers
     *
     * @return array
     */
    public function getTokenParsers() {
        return array(
            new View_Extension_HTML_TokenParser(),
            new View_Extension_Form_TokenParser(),
            new View_Extension_URL_TokenParser(),
            new View_Extension_Thumbnail_TokenParser(),
            new View_Extension_Config_TokenParser(),
            new View_Extension_Session_TokenParser(),
        );
    }

    /**
     * Returns the added filters
     *
     * @return array
     */
    public function getFilters() {
        return array(
            // Date and time
            //'timestamp' => new Twig_Filter_Function('strtotime'),
            'fuzzy_timesince' => new Twig_Filter_Function('Date::fuzzy_span'),
            // Strings
            'plural'        => new Twig_Filter_Function('Inflector::plural'),
            'singular'      => new Twig_Filter_Function('Inflector::singular'),
            'humanize'      => new Twig_Filter_Function('Inflector::humanize'),
            // HTML 
            'obfuscate'     => new Twig_Filter_Function('HTML::obfuscate'),
            'nl2br'         => new Twig_Filter_Function('nl2br'),
            // Numbers
            'num_format'    => new Twig_Filter_Function('Num::format'),
            'phone_format'  => new Twig_Filter_Function('View_Helper::format_phone'),
            // Text
            'limit_words'   => new Twig_Filter_Function('Text::limit_words'),
            'limit_chars'   => new Twig_Filter_Function('Text::limit_chars'),
            'auto_link'     => new Twig_Filter_Function('Text::auto_link'),
            'auto_p'        => new Twig_Filter_Function('Text::auto_p'),
            'bytes'         => new Twig_Filter_Function('Text::bytes'),
            'slug'          => new Twig_Filter_Function('URL::slug'),
            'session'       => new Twig_Filter_Function('Session::instance()->get'),
        );
    }

    /**
     * @return string
     */
    public function getName() {
        return 'view_extension';
    }

}
