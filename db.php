<?php
$conn = mysqli_connect("localhost", "root", "", "notes_system");

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>