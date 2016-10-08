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