<?php
require_once("../inc/connect.php");
$rating_data = ["submissionId"=>"2", "readerId"=>"1", "rating"=>"5"];

// if(isset($_POST["ratingData"])) {
    // $post_data = $_POST["ratingData"];
    // $rating_data = json_decode($post_data);
    $is_duplicate = check_ratings($rating_data, $db);


    //need to specify empty
    if ($is_duplicate) {
        //update
        echo json_encode("update!");
    } else {
        new_rating($rating_data, $db);
        echo json_encode("new!");
    }
      
// } else {
//       echo json_encode("Fail!");
// }


function check_ratings(array $data, $db) {
    $sql = "SELECT *
            FROM rating 
            WHERE submission_id = :submission_id
            AND reader_id = :reader_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":submission_id", $rating_data["submissionId"], PDO::PARAM_STR, 29);
    $stmt->bindParam(":reader_id", $rating_data["readerId"], PDO::PARAM_STR, 29);
    $stmt->execute();

    $result = $stmt->fetchAll();
    return $result;
}

function new_rating(array $data, $db) {
    require_once("../inc/connect.php");
    $sql = "INSERT INTO rating (submission_id, rating, reader_id)
                VALUES (:submission_id, :rating, :reader_id)";
    $stmt = $db->prepare($sql);

    $stmt->bindParam(":submission_id", $data["submissionId"], PDO::PARAM_STR, 29);
    $stmt->bindParam(":rating", $data["rating"], PDO::PARAM_STR, 29);
    $stmt->bindParam(":reader_id", $data["readerId"], PDO::PARAM_STR, 29);

    $stmt->execute();
}