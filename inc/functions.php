<?php
//Creates genre dropdown from database
function genre_dropdown() {
    include("connect.php");

    $html = "<option disabled selected>-- Select Genre --";
    $genres = array();
    $sql = "SELECT genre FROM genre ORDER BY genre";

    $results = $db->prepare($sql);
    $results->execute();

    while ($row = $results->fetchColumn()) {
        $html .= "<option value='$row'>$row</option>";
    }

    return $html;
}

//Creates state dropdown
function state_dropdown() {
    $state_list = "<option disabled selected>-- Select State --";
    
    $states = ["AL"=>"Alabama", "AK"=>"Alaska", "AZ"=>"Arizona", "AR"=>"Arkansas", "CA"=>"California", "CO"=>"Colorado", "CT"=>"Connecticut", "DE"=>"Delaware", "DC"=>"District of Columbia", "FL"=>"Florida", "GA"=>"Georgia", "HI"=>"Hawaii", "ID"=>"Idaho", "IL"=>"Illinois", "IN"=>"Indiana", "IA"=>"Iowa", "KS"=>"Kansas", "KY"=>"Kentucky", "LA"=>"Louisiana", "ME"=>"Maine", "MD"=>"Maryland", "MA"=>"Massachusetts", "MI"=>"Michigan", "MN"=>"Minnesota", "MO"=>"Mississippi", "MS"=>"Missouri", "MT"=>"Montana", "NE"=>"Nebraska", "NV"=>"Nevada", "NH"=>"New Hampshire", "NJ"=>"New Jersey", "NM"=>"New Mexico", "NY"=>"New York", "NV"=>"North Carolina", "NY"=>"North Dakota", "OH"=>"Ohio", "OK"=>"Oklahoma", "OR"=>"Oregon", "PA"=>"Pennsylvania", "RI"=>"Rhode Island", "SC"=>"South Carolina", "SD"=>"South Dakota", "TN"=>"Tennessee", "TX"=>"Texas", "UT"=>"Utah", "VT"=>"Vermont", "VA"=>"Virginia", "WA"=>"Washington", "WV"=>"West Virginia", "WI"=>"Wisconsin", "WY"=>"Wyoming"];

    foreach ($states as $key=>$val) {
        $state_list .= "<option value='" . $key . "'";
        if ($key === $_POST['state']) { 
            $state_list .= "selected";
        };
        $state_list .= ">$val ($key)</option>";
    }

    return $state_list;
}

//Removes all characters but numbers and letters
function format_file_name($str) {
    $output = preg_replace('@[^0-9a-z\.]+@i', '_', ucwords($str));
    return trim($output);
}
