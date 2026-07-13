<?php

define (DB_USER, "root");//Username

define (DB_PASSWORD, "root");//Password

define (DB_DATABASE, "new_blog"); //Database Name

define (DB_HOST, "localhost");

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);


$title = $_POST['title'];

$category = implode(', ', $_POST['category']);

$created_at = date();


$sql = "INSERT INTO posts (title,category) VALUES ('$title', '$category')";

$result = $mysqli->query($sql);


header('location:multiSelect.php')

?>