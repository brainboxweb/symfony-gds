<?php
/**
 * Created by PhpStorm.
 * User: garystraughan
 * Date: 16/10/2014
 * Time: 06:33
 */

namespace AppBundle\Utils;


class Slugger {

    public function slugify($string)
    {
        return preg_replace(
            '/[^a-z0-9]/', '-', strtolower(trim(strip_tags($string)))
        );
    }

} 