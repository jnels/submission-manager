<?php

if(isset($_POST)) {

}

function upload_file() {

    $target_dir = "uploads/" . date("my") . "/";
    $target_file = $target_dir . basename($_FILES["file-to-upload"]["name"]);
    $uploadOk = 1;
    $fileType = pathinfo($target_file, PATHINFO_EXTENSION);

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["file-to-upload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["file-to-upload"]["size"] > 50000000) {
        echo "Your file is way too large--you need to cut it!";
        $uploadOk = 0;
    }

    if (check_file_type($fileType)) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
        echo "Please check file type.";
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Allowed formats
function check_file_type($fileType) {
    //Store in database?
    $allowed_file_types = ["doc", "docx", "txt", "rtf", "pdf", "ppf"];

    foreach ($allowed_file_types as $type) {
        if ($fileType === $type) {
            return true;
        }
    }
    return false;
}