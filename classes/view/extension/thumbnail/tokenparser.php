<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Parses a {% thumbnail %} tag
 *
 */
class View_Extension_Thumbnail_TokenParser extends Twig_TokenParser {

    /**
     * @param Twig_Token $token
     * @return object
     */
    public function parse(Twig_Token $token) {
        $lineno = $token->getLine();

        // Find the image we're matching
        $image = $this->parser->getExpressionParser()->parseExpression();

        // Check for arguments for the image
        if ($this->parser->getStream()->test(Twig_Token::PUNCTUATION_TYPE, ',')) {
            $this->parser->getStream()->expect(Twig_Token::PUNCTUATION_TYPE, ',');
            $params = $this->parser->getExpressionParser()->parseExpression();
        } else {
            $params = null;
        }

        $this->parser->getStream()->expect(Twig_Token::BLOCK_END_TYPE);

        return new View_Extension_Thumbnail_Node(array('image' => $image, 'params' => $params), array(), $lineno, $this->getTag());
    }

    /**
     * @return string
     */
    public function getTag() {
        return 'thumbnail';
    }

}
