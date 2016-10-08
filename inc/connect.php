<?php
// Include db credentials file here
include("credentials.php");

try { 
$db = new PDO(DB_HOST, DB_USERNAME, DB_PASSWORD);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Unable to connect ";
    echo $e->getMessage();
    exit;
}