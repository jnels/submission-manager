<?php
require_once("connect.php");
include("upload-file.php");

//Sanitize form info
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $valid = false;
  
    $user_data = [
        "name"=>trim(filter_input(INPUT_POST,"name", FILTER_SANITIZE_STRING)),
        "email"=>trim(filter_input(INPUT_POST,"email", FILTER_SANITIZE_EMAIL)),
        "address1"=>trim(filter_input(INPUT_POST,"address1", FILTER_SANITIZE_STRING)),
        "address2"=>trim(filter_input(INPUT_POST,"address2", FILTER_SANITIZE_STRING)),
        "city"=>trim(filter_input(INPUT_POST,"city", FILTER_SANITIZE_STRING)),
        "state"=>trim(filter_input(INPUT_POST,"state", FILTER_SANITIZE_STRING)),
        "zip"=>trim(filter_input(INPUT_POST,"zip", FILTER_SANITIZE_STRING)),
        "phone"=>trim(filter_input(INPUT_POST,"phone", FILTER_SANITIZE_STRING)),
        "email"=>trim(filter_input(INPUT_POST,"email", FILTER_SANITIZE_EMAIL))
    ];

    $submission_data = [
        "title"=>trim(filter_input(INPUT_POST,"title", FILTER_SANITIZE_STRING)),
        "genre"=>trim(filter_input(INPUT_POST,"genre", FILTER_SANITIZE_STRING)),
        "cover_letter"=>trim(filter_input(INPUT_POST,"cover_letter", FILTER_SANITIZE_STRING))
    ];

    if ($valid) {
    
    //Checks to see if user ID exists
    $user_id = get_user_id($db, $user_data);

    //Creates new user if ID does not exist
    if (!$user_id) {
        $user_id = add_user($db, $user_data);
    }

    //Uploads file
    $file_path = upload_file($db);
    
    if ($file_path) {
        new_submission($db, $submission_data, $user_id, $file_path);
    } 
    }
}

function get_user_id($db, $user_data) {
    $sql = "SELECT user_id FROM user_info
            WHERE email = :email";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(":email", $user_data["email"], PDO::PARAM_STR, 29);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result["user_id"];
}

function add_user($db, $user_data) {
    try {
        $sql = "INSERT INTO user_info (name, address1, address2, city, state, zip, phone, email)
        VALUES (:name, :address1, :address2, :city, :state, :zip, :phone, :email)";

        $stmt = $db->prepare($sql);

        $stmt->bindParam(":name", $user_data["name"], PDO::PARAM_STR, 29);
        $stmt->bindParam(":address1", $user_data["address1"], PDO::PARAM_STR, 29); 
        $stmt->bindParam(":address2", $user_data["address2"], PDO::PARAM_STR, 29);
        $stmt->bindParam(":city", $user_data["city"], PDO::PARAM_STR, 29);
        $stmt->bindParam(":state", $user_data["state"], PDO::PARAM_STR, 2);
        $stmt->bindParam(":zip", $user_data["zip"], PDO::PARAM_STR, 10);
        $stmt->bindParam(":phone", $user_data["phone"], PDO::PARAM_STR, 29);
        $stmt->bindParam(":email", $user_data["email"], PDO::PARAM_STR, 19);

        $stmt->execute();
        echo "Record created successfully";

        return get_user_id($db, $user_data);
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
}

function new_submission($db, $submission_data, $user_id, $file_path) {
    try {
        $submission_date = date("m/d/y");

        $sql = "INSERT INTO submission_info (user_id, submission_date, title, genre, cover_letter, file_path)
                VALUES (:user_id, :submission_date, :title, :genre, :cover_letter, :file_path)";

        $stmt = $db->prepare($sql);

        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_STR, 29);
        $stmt->bindParam(":submission_date", $submission_date, PDO::PARAM_STR, 29);
        $stmt->bindParam(":title", $submission_data["title"], PDO::PARAM_STR, 29);
        $stmt->bindParam(":genre", $submission_data["genre"], PDO::PARAM_STR, 29);
        $stmt->bindParam(":cover_letter", $submission_data["cover_letter"], PDO::PARAM_STR, 29);
        $stmt->bindParam(":file_path", $file_path, PDO::PARAM_STR, 29);

        $stmt->execute();
        echo "Submission received!";
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
}