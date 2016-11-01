<?php

function upload_file() {

    $target_dir = "uploads/" . date("my") . "/";
    $target_file = $target_dir . basename($_FILES["file-to-upload"]["name"]);
    $uploadOk = 1;
    $fileType = pathinfo($target_file, PATHINFO_EXTENSION);

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file name already exists.";
        return false;
    }

    // Check file size
    if ($_FILES["file-to-upload"]["size"] > 50000000) {
        echo "Your file is way too large--you need to cut it!";
        return false;
    }

    $allowed_file_types = ["doc", "docx", "txt", "rtf", "pdf", "ppf"];
    $valid_extension = in_array($fileType, $allowed_file_types);

    if(!$valid_extension) {
        echo "Please check file type.";
        return false;
    }

    if (!is_dir($target_dir)) {
        mkdir($target_dir);
    }

    if (move_uploaded_file($_FILES["file-to-upload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["file-to-upload"]["name"]). " has been uploaded.";
        return $target_file;
    } else {
        echo "Sorry, there was an error uploading your file.";
        return false;
    }
}

// Allowed formats
// function check_file_type($fileType) {
//     //Store in database?
//     $allowed_file_types = ["doc", "docx", "txt", "rtf", "pdf", "ppf"];

//     $valid_extension = in_array($fileType, $allowed_file_types)

//     foreach ($allowed_file_types as $type) {
//         if ($fileType === $type) {
//             return true;
//         }
//     }
//     return false;
// }