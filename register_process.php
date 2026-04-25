<?php
include 'db.php';

if(isset($_POST['name'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "INSERT INTO users (name, email, password)
              VALUES ('$name', '$email', '$password')";

    if(mysqli_query($conn, $query)){
        echo "Registration Successful! <br><br>";
        echo "<a href='login.html'>Click Here to Login</a>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>