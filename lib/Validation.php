<?php
require_once('Input.php');
class Validation{
	public $passed,$errors=array();
	private $database;
	public function __construct(){
		$this->passed = false;
		$this->errors = array();
		$this->database = Database::getinstance();
	}
    public function validateInput($data=array()){
            foreach ($data as $element => $ruleset) {
                foreach ((array)$ruleset as $rule => $value) {
                    if($rule == 'require' && $value && empty(Input::get($element)) && Input::get($element) == '')
                    {
                            $this->errors[]="{$element} is required";
                    }
                    else if(Input::exists($element))
                    {
                        switch ($rule) 
                        {
                            case 'unique':
                                $input = Input::get($element);
                                $row = $this->database->select($value,array($element),"WHERE {$element} = '{$input}'");
                                if(count($row)){
                                        $this->errors[] = "{$element} already exists";
                                }
                                break;
                            case 'min':
                                if(strlen(Input::get($element)) < $value)
                                {
                                        $this->errors[] = "{$element} must be atleast {$value} characters!";
                                }
                                break;
                            case 'max':
                                if(strlen(Input::get($element)) > $value)
                                {
                                        $this->errors[] = "{$element} can be a maximum of {$value} characters!";
                                }
                                break;
                            case 'match':
                                if(Input::get($element) != Input::get($value))
                                {
                                        $this->errors[] = "{$element} and re-{$element} don't match!";
                                }
                                break;
                            case 'min_val':
                                if(Input::get($element) < Input::get($value)){
                                    $this->errors[] = "{$element} can be a minimum of {$value}";
                                }
                                break;
                            case 'max_val':
                                if(Input::get($element) > Input::get($value)){
                                    $this->errors[] = "{$element} can be a maximum of {$value}";
                                }
                                break;
                            case 'max_size':
                                if(Input::get($element, 'FILES', 'size') > $value){
                                    $this->errors[] = "{$element} can be a maximum size of {$value}";
                                }
                                break;
                            case 'file_type':
                                $str_exploded = explode(".",Input::get($element, 'FILES','name'));
                                $file_type = strtolower(end($str_exploded));
                                if(!in_array($file_type, $value)){
                                    $extentions = '';
                                    foreach ($value as $extention) {
                                        $extentions.=$extention.",";
                                    }
                                    $extentions = rtrim($extentions, ',');
                                    $this->errors[] = "{$element} can only be a type of {$extentions}";
                                }
                                break;
                            default:
                                # code...
                                break;
                        }
                    }
                }
            }
            if (empty($this->errors)) {
                    $this->passed = true;
            }
    }

    public function validate($dataSet, $rulesSet){
	    foreach ($dataSet as $dataName => $dataValue) {
            if(isset($rulesSet[$dataName])) {
                foreach ($rulesSet[$dataName] as $ruleName => $ruleValue) {
                    switch ($ruleName) {
                        case 'unique':
                            $result = $this->database->select($ruleValue, array($dataName), "WHERE {$dataName} = '{$dataValue}'");
                            if (count($result)) {
                                $this->errors[] = "{$dataName} already exists";
                            }
                            break;
                        case 'min':
                            if (strlen($dataValue) < $ruleValue) {
                                $this->errors[] = "{$dataName} must be atleast {$ruleValue} characters!";
                            }
                            break;
                        case 'max':
                            if (strlen($dataValue) > $ruleValue) {
                                $this->errors[] = "{$dataName} can be a maximum of {$ruleValue} characters!";
                            }
                            break;
                        case 'match':
                            if ($dataValue != $ruleValue) {
                                $this->errors[] = "{$dataName} and re-{$dataName} don't match!";
                            }
                            break;
                        case 'min_val':
                            if ($dataValue < $ruleValue) {
                                $this->errors[] = "{$dataName} can be a minimum of {$ruleValue}";
                            }
                            break;
                        case 'max_val':
                            if ($dataValue > $ruleValue) {
                                $this->errors[] = "{$dataName} can be a maximum of {$ruleValue}";
                            }
                            break;
                        case 'max_size':
                            if (Input::get($dataName, 'FILES', 'size') > $ruleValue) {
                                $this->errors[] = "{$dataName} can be a maximum size of {$ruleValue}";
                            }
                            break;
                        case 'file_type':
                            $str_exploded = explode(".", Input::get($dataName, 'FILES', 'name'));
                            $file_type = strtolower(end($str_exploded));
                            if (!in_array($file_type, $ruleValue)) {
                                $this->errors[] = "{$dataName} can only be a type of ".implode("|",$ruleValue);
                            }
                            break;
                        default:
                            # code...
                            break;
                    }
                }
            }
        }
        if (empty($this->errors)) {
            $this->passed = true;
        }
    }
    public function printErrors(){
            foreach ((array)$this->errors as $value) {
                    echo "<ul><li>$value</li></ul>";
            }
    }
}