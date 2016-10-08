<?php
//Sanitize form info
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim(filter_input(INPUT_POST,"name", FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST,"email", FILTER_SANITIZE_EMAIL));
	$address1 = trim(filter_input(INPUT_POST,"address1", FILTER_SANITIZE_STRING));
	$address2 = trim(filter_input(INPUT_POST,"address2", FILTER_SANITIZE_STRING));
	$city = trim(filter_input(INPUT_POST,"city", FILTER_SANITIZE_STRING));
	$state = trim(filter_input(INPUT_POST,"state", FILTER_SANITIZE_STRING));
	$zip = trim(filter_input(INPUT_POST,"zip", FILTER_SANITIZE_STRING));
	$phone = trim(filter_input(INPUT_POST,"phone", FILTER_SANITIZE_STRING));
	$email = trim(filter_input(INPUT_POST,"email", FILTER_SANITIZE_STRING));

// Validate form

    $message = "";
    if ($name === "") {
        $message = "Please enter a name;"
    }
    
    if ($message !== "") {
        echo "<p>$message</p>";
    }



// Create user record
// Load submission including user id


}