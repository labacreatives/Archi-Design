<?php
/**
 * Created by PhpStorm.
 * User: ADONIAS
 * Date: 1/2/2019
 * Time: 2:57 PM
 */
class Helper{
    public static function arrayToCSV(array $dataArray, $delimiter = ","){
        $dataString = "";
        foreach ($dataArray as $data){
            $dataString .= $data.$delimiter;
        }
        return rtrim($dataString,$delimiter);
    }
}