<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Parses a {% config %} tag
 *
 */
class View_Extension_Config_Node extends Twig_Node {

    /**
     * Compiles the tag
     *
     * @param object $compiler 
     */
    public function compile(Twig_Compiler $compiler) {
        // Output the config key
        $compiler
                ->write('echo Kohana::$config->load(')
                ->subcompile($this->getNode('config_key'))
                ->write(')')
                ->raw(";\n");
    }

}
