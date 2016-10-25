<?php
require_once("../inc/connect.php");
// $rating_data = ["submissionId"=>"3", "readerId"=>"1", "rating"=>"5"];

if(isset($_POST["ratingData"])) {
    $post_data = $_POST["ratingData"];
    $rating_data = json_decode($post_data, true);
    $is_duplicate = check_ratings($rating_data, $db);

    if ($is_duplicate) {
        echo "Updated!";
    } else {
        new_rating($rating_data, $db);
        echo "New Rating!";
    }
      
} else {
      echo "Fail!";
}


function check_ratings($rating_data, $db) {
    $sql = "SELECT *
            FROM rating 
            WHERE submission_id = :submission_id
            AND reader_id = :reader_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":submission_id", $rating_data["submissionId"], PDO::PARAM_STR, 29);
    $stmt->bindParam(":reader_id", $rating_data["readerId"], PDO::PARAM_STR, 29);
    $stmt->execute();

    $result = $stmt->fetchAll();

    if (empty($result)) {
        return false;
    } else {
        return true;
    }
}

function new_rating(array $rating_data, $db) {
    require_once("../inc/connect.php");
    $sql = "INSERT INTO rating (submission_id, rating, reader_id)
                VALUES (:submission_id, :rating, :reader_id)";
    $stmt = $db->prepare($sql);

    $stmt->bindParam(":submission_id", $rating_data["submissionId"], PDO::PARAM_STR, 29);
    $stmt->bindParam(":rating", $rating_data["rating"], PDO::PARAM_STR, 29);
    $stmt->bindParam(":reader_id", $rating_data["readerId"], PDO::PARAM_STR, 29);

    $stmt->execute();
}