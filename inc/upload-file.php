<?php

function upload_file() {
    $target_dir = "uploads/" . date("my") . "/";
    $file_name = format_file_name(basename($_FILES["file-to-upload"]["name"]));

    $target_file = $target_dir . $file_name;
    $fileType = pathinfo($target_file, PATHINFO_EXTENSION);

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file name already exists.";
        return false;
    }

    // Check file size
    if ($_FILES["file_to_upload"]["size"] > 50000000) {
        echo "Your file is way too large--you need to cut it!";
        return false;
    }

    // Check for file type
    $allowed_file_types = ["doc", "docx", "txt", "rtf", "pdf", "ppf"];
    $valid_extension = in_array($fileType, $allowed_file_types);

    if(!$valid_extension) {
        echo "Please check file type.";
        return false;
    }

    // Stores file in directory
    if (!is_dir($target_dir)) {
        mkdir($target_dir);
    }

    if (move_uploaded_file($_FILES["file-to-upload"]["tmp_name"], $target_file)) {
        echo "Your file ". basename( $_FILES["file-to-upload"]["name"]). " has been uploaded. ";
        return $target_file;
    } else {
        echo "Sorry, there was an error uploading your file.";
        return false;
    }
}

var_dump($_FILES);