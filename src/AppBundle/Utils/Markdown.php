<?php
/**
 * Created by PhpStorm.
 * User: garystraughan
 * Date: 10/02/15
 * Time: 08:18
 */

namespace AppBundle\Utils;


class Markdown {

    private $parser;

    public function __construct()
    {
        $this->parser = new \Parsedown();
    }

    public function toHtml($text)
    {
        $html = $this->parser->text($text);

        return $html;
    }

}
