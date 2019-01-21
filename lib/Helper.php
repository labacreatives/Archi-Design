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
    public static function filterDirtyFields(array $originalData):array {
        $dirtyData = array();
        foreach ($originalData as $dataName=>$dataValue){
            if(Input::exists($dataName) && Input::get($dataName) != $dataValue){
                $dirtyData[$dataName] = Input::get($dataName);
            }
        }
        return $dirtyData;
    }
    public static function toForwardSlash($string){
        return str_replace("\\","/",$string);
    }
    public static function toBackSlash($string){
        $s = str_replace("/","\\",$string);
        return $s;
    }
}