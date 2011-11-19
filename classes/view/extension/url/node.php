<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Parses a {% url %} tag
 *
 */
class View_Extension_URL_Node extends Twig_Node {

    /**
     * Compiles the tag
     *
     * @param object $compiler 
     */
    public function compile(Twig_Compiler $compiler) {
        if ($this->getNode('params')) {
            $compiler
                    ->write('$route_params = ')
                    ->subcompile($this->getNode('params'))
                    ->raw(";\n");
        } else {
            $compiler
                    ->write('$route_params = array()')
                    ->raw(";\n");
        }

        // Output the route
        $compiler
                ->write('echo Route::url(')
                ->subcompile($this->getNode('route'))
                ->write(', $route_params)')
                ->raw(";\n");
    }

}
