<?php
$id = $_GET['id'];
$newTemp = $_GET['temp'];

try {
    $conn = new PDO('mysql:host=localhost;dbname=chart', 'cava', '');
    $sql = "UPDATE data SET temperature = '$newTemp' WHERE id = $id";
    $points = $conn->query($sql);
} catch (PDOException $e) {
    die("Could not connect to db");
}