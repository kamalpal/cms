<?php
$servername = "localhost";
$username = "dev";
$password = "info@del";

try {
    global $db;
    $db = new PDO("mysql:host=$servername;dbname=cms", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
