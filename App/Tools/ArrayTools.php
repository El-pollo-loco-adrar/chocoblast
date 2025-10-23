<?php

namespace App\Tools;

class ArrayTools
{
    //Sanitize pour les tableaux
    public static function sanitizeArray($array)
    {
        return array_map('sanitize', $array);
    }
}
