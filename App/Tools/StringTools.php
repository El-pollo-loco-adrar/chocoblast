<?php

namespace App\Tools;

class StringTools
{
    public static function sanitize($data)
    {
        return htmlentities(strip_tags(stripslashes(trim($data))), ENT_QUOTES, 'UTF-8');
    }
}
