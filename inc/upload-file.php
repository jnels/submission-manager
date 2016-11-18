<?php

function upload_file() {
    $target_dir = "uploads/" . date("my") . "/";
    $file_name = format_file_name(basename($_FILES["file-to-upload"]["name"]));

    $target_file = $target_dir . $file_name;
    $fileType = pathinfo($target_file, PATHINFO_EXTENSION);

    if (!$file_name) {
        echo "<p class='error'>Oops! It looks like you forgot to attach a file.</p>";
        return false;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "<p class='error'>Sorry, file name already exists.</p>";
        return false;
    }

    // Check file size
    if ($_FILES["file-to-upload"]["size"] > 50000000) {
        echo "<p class='error'>Your file is way too large--you need to cut it!</p>";
        return false;
    }

    // Check for file type
    $allowed_file_types = ["doc", "docx", "txt", "rtf", "pdf", "ppf"];
    $valid_extension = in_array($fileType, $allowed_file_types);

    if(!$valid_extension) {
        echo "<p class='error'>Please check file type.</p>";
        return false;
    }

    // Stores file in directory
    if (!is_dir($target_dir)) {
        mkdir($target_dir);
    }

    if (move_uploaded_file($_FILES["file-to-upload"]["tmp_name"], $target_file)) {
        echo "<p class='success' id='submitted'>Your submission has been received!</p>";
        return $target_file;
    } else {
        echo "<p class='error'>Sorry, there was an error uploading your file.</p>";
        return false;
    }
}