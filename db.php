<?php

$host = "localhost";
$dbname = "bank";
$username = "root";
$password = "root"; // MAMP default

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB kļūda: " . $e->getMessage());
}