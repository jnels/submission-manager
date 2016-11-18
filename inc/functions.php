<?php
//Creates genre dropdown from database
function genre_dropdown() {
    include("connect.php");

    $html = "<option selected value=''>-- Select Genre --";
    $genres = array();
    $sql = "SELECT genre FROM genre ORDER BY genre";

    $results = $db->prepare($sql);
    $results->execute();

    while ($row = $results->fetchColumn()) {
        $html .= "<option value='$row'";
        if (isset($_POST["genre"]) && $row === $_POST["genre"]) {
            $html .= "selected";
        }
        $html .= ">$row</option>";
    }

    return $html;
}

//Creates state dropdown
function state_dropdown() {
    $state_list = "<option disabled selected value=''>-- Select State --";

    $states = ["AL"=>"Alabama", "AK"=>"Alaska", "AZ"=>"Arizona", "AR"=>"Arkansas", "CA"=>"California", "CO"=>"Colorado", "CT"=>"Connecticut", "DE"=>"Delaware", "DC"=>"District of Columbia", "FL"=>"Florida", "GA"=>"Georgia", "HI"=>"Hawaii", "ID"=>"Idaho", "IL"=>"Illinois", "IN"=>"Indiana", "IA"=>"Iowa", "KS"=>"Kansas", "KY"=>"Kentucky", "LA"=>"Louisiana", "ME"=>"Maine", "MD"=>"Maryland", "MA"=>"Massachusetts", "MI"=>"Michigan", "MN"=>"Minnesota", "MO"=>"Mississippi", "MS"=>"Missouri", "MT"=>"Montana", "NE"=>"Nebraska", "NV"=>"Nevada", "NH"=>"New Hampshire", "NJ"=>"New Jersey", "NM"=>"New Mexico", "NY"=>"New York", "NC"=>"North Carolina", "ND"=>"North Dakota", "OH"=>"Ohio", "OK"=>"Oklahoma", "OR"=>"Oregon", "PA"=>"Pennsylvania", "RI"=>"Rhode Island", "SC"=>"South Carolina", "SD"=>"South Dakota", "TN"=>"Tennessee", "TX"=>"Texas", "UT"=>"Utah", "VT"=>"Vermont", "VA"=>"Virginia", "WA"=>"Washington", "WV"=>"West Virginia", "WI"=>"Wisconsin", "WY"=>"Wyoming"];

    foreach ($states as $key=>$val) {
        $state_list .= "<option value='" . $key . "'";
        if (isset($_POST['state']) && $key === $_POST['state']) { 
            $state_list .= "selected";
        };
        $state_list .= ">$val ($key)</option>";
    }

    return $state_list;
}

// Removes all characters but numbers and letters
function format_file_name($str) {
    $output = preg_replace('@[^0-9a-z\.]+@i', '_', ucwords($str));
    return trim($output);
}


// SQL Functions for manager.php //

function delete_submission($db, $submission_to_delete) {
    $sql = "DELETE submission_info, rating 
            FROM submission_info 
            LEFT OUTER JOIN rating 
            ON submission_info.submission_id = rating.submission_id
            WHERE submission_info.submission_id = :submission_to_delete";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(":submission_to_delete", $submission_to_delete, PDO::PARAM_STR, 29);
    $stmt->execute();
}

function generate_submission_list($db, $rated_by_user, $view) {
    $sql = "SELECT * 
            FROM submission_info
            JOIN user_info
            ON submission_info.user_id = user_info.user_id";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    $result = [];

    if ($view === "rated") {
        while ($record = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rated_already = already_rated($rated_by_user, $record["submission_id"]);

            if ($rated_already) {
                $result[] = $record;
            }
        }
    } else if ($view === "all") {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        while ($record = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rated_already = already_rated($rated_by_user, $record["submission_id"]);

            if (!$rated_already) {
                $result[] = $record;
            }
        }
    } 

    return $result;
}

//Returns already rated submissions
function already_rated($rated_by_user, $submission_id) {
    foreach($rated_by_user as $rated) {
        if ($rated["submission_id"] === $submission_id) {
            return $rated["rating"];
        } 
    }
    return false;
}

// Returns avg rating for rated submissions
function avg_ratings($db, $submission_id) {
    $sql = "SELECT rating
            FROM rating 
            WHERE submission_id = :sub_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":sub_id", $submission_id , PDO::PARAM_STR, 29);
    $stmt->execute();
    $list = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

    $result = array_sum($list)/count($list);

    return $result;
}

function user_rated_submissions($db, $reader_id) {
    $sql = "SELECT submission_id, rating
            FROM rating 
            WHERE rating.reader_id = :reader_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":reader_id", $reader_id, PDO::PARAM_STR, 29);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
