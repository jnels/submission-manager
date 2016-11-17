<?php

class FormValidation
{
    private $fields;
    
    function __construct(array $fields) {
        $this->fields = $fields;
    }

    public function runValidation() {
        if (!$this->hasValue() || !$this->isPhoneNumber() || !$this->isEmail() ) {
            return false;
        } else {
            return true;
        }
    }
    
    private function hasValue() {
        $empty_fields = [];
        $output = "Please fill out the following required fields: ";
        
        foreach ($this->fields as $index=>$field) {
            if ($index !== "address2") {
                if (empty($field)) {  
                    //Replaces non-alphanumeric characters with space
                    $index = preg_replace("/[^A-Za-z0-9 ]/", " ", $index);
                    $empty_fields[] = ucwords($index);
                }
            }
        }

        //Checks if $empty_fields array has values
        if (!empty($empty_fields)) {
            $output .= implode(", ", $empty_fields) . ".";
            echo "<p class='error'>" . $output . "</p>";
            return false;
        } 

        return true;
    }
    
    private function isPhoneNumber() {
        $phone_number = preg_replace("/[^0-9.]+/", "", $this->fields["phone"]);

        if(strlen($phone_number) != 10) {
            echo "<p class='error'>Invalid phone number. Please provide your 10 digit phone number.</p>";
            return false;
        }

        return true;
    }
    
    private function isEmail() {
        if ($this->fields["email"] !== $_POST["email"]) {
            echo "<p class='error'>Invalid characters in email!</p>";
            return false;
        } else if (!filter_var($this->fields["email"], FILTER_VALIDATE_EMAIL)) {
            echo "<p class='error'>Please enter a valid email address!</p>";
            return false;
        }

        return true;
    }
}
