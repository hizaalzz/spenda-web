<?php
namespace App\Helpers;

class ArrayHelper {
    public static function searchMultiDimension($searchValue, $array) 
    {
        return array_search($searchValue, array_column($array, 'nama')) === false;
    }
}