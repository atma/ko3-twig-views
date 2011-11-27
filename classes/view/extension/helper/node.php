<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Compiler for helpers, which allows a public static methods to be called on a class
 *
 */
class View_Extension_Helper_Node extends Twig_Node {

    /**
     * @var array Case sensitive class names
     */
    protected $cs_tags = array(
        'html' => 'HTML',
        'form' => 'Form',
    );

    /**
     * @param object $compiler 
     * @return void
     */
    public function compile(Twig_Compiler $compiler) {
        $params = $this->getNode('expression')->getIterator();
        $nodeTag = $this->getNodeTag();
        $nodeTag = isset($this->cs_tags[strtolower($nodeTag)]) ? $this->cs_tags[strtolower($nodeTag)] : $nodeTag;

        // Output the route		
        $compiler->write('echo ' . $nodeTag . '::' . $this->getAttribute('method') . '(');

        foreach ($params as $i => $row) {
            $compiler->subcompile($row);

            if (($params->count() - 1) !== $i) {
                $compiler->write(',');
            }
        }

        $compiler->write(')')->raw(';');
    }

}
