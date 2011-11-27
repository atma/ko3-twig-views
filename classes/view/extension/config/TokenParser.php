<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Parses a {% config %} tag
 *
 */
class View_Extension_Config_TokenParser extends Twig_TokenParser {

    /**
     * @param Twig_Token $token 
     * @return object
     */
    public function parse(Twig_Token $token) {
        $lineno = $token->getLine();

        // Find the route we're matching
        $config_key = $this->parser->getExpressionParser()->parseExpression();
        $params = null;
        $this->parser->getStream()->expect(Twig_Token::BLOCK_END_TYPE);

        return new View_Extension_Config_Node(array('config_key' => $config_key, 'params' => $params), array(), $lineno, $this->getTag());
    }

    /**
     * @return string
     */
    public function getTag() {
        return 'config';
    }

}
