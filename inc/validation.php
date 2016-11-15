<?php

class FormValidation
{
    public $fields;
    
    function __construct(array $fields) {
        $this->fields = $fields;
    }
    
    function isEmpty() {
        $empty_fields = [];
        $output = "Please fill out the following required fields: ";
        
        foreach ($this->fields as $index=>$field) {
            if (empty($field)) {
                $empty_fields[] = $index;
            }
        }

        $output .= implode($empty_fields) . ".";
    }
    
    function isPhoneNumber() {
        
    }
    
    function isEmail() {
        
    }
    
}

$array = ["name"=>"test", "address1"=>"er", "phone"=>"chicken", "email"=>""];

$test = new FormValidation($array);
$test->isEmpty();