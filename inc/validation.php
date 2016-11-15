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
                $empty_fields[] = ucfirst($index);
            }
        }

        if (!empty($empty_fields)) {
            $output .= implode(", ", $empty_fields) . ".";
            echo $output;
            return false;
        } 

        return true;
    }
    
    function isPhoneNumber() {
        $phone_number = preg_replace("/[^0-9.]+/", "", $this->fields["phone"]);

        if(strlen($phone_number) != 10) {
            echo "Invalid phone number. Please provide your 10 digit phone number.";
            return false;
        }

        return true;
    }
    
    function isEmail() {
        if ($this->fields["email"] !== $_POST["email"]) {
            echo "Invalid characters in email!";
            return false;
        } else if (!filter_var($this->fields["email"], FILTER_VALIDATE_EMAIL)) {
            echo "Please enter a valid email address!";
            return false;
        }

        return true;
    }
    
}
