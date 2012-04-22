<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Parses a {% url %} tag
 *
 */
class View_Extension_Thumbnail_Node extends Twig_Node {

    /**
     * Compiles the tag
     *
     * @param object $compiler
     */
    public function compile(Twig_Compiler $compiler) {
        if ($this->getNode('params')) {
            $compiler
                ->write('$params = ')
                ->subcompile($this->getNode('params'))
                ->raw(";\n");
        } else {
            $compiler
                ->write('$params = array()')
                ->raw(";\n");
        }

        // Output the route
        $compiler
            ->write('echo View_Helper::thumbnail(')
            ->subcompile($this->getNode('image'))
            ->write(', $params)')
            ->raw(";\n");
    }

}
