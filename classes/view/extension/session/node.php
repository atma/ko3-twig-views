<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Parses a {% session %} tag
 *
 */
class View_Extension_Session_Node extends Twig_Node {

    /**
     * Compiles the tag
     *
     * @param object $compiler 
     */
    public function compile(Twig_Compiler $compiler) {
        $params = $this->getNode('expression')->getIterator();
        $nodeTag = ucfirst($this->getNodeTag());
        
        // Output the session method		
        $compiler->write('' . $nodeTag . '::instance()->' . $this->getAttribute('method') . '(');

        foreach ($params as $i => $row) {
            $compiler->subcompile($row);

            if (($params->count() - 1) !== $i) {
                $compiler->write(',');
            }
        }

        $compiler->write(')')->raw(';');
    }

}
