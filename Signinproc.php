<?php
require "dbcon.php";

$pass = $_POST["password"];
$uname = $_POST["username"];

// Query to select the user with the provided email and password
$query = "SELECT * FROM user WHERE username='$uname' AND password='$pass'";

// Execute the query
$res = mysqli_query($con, $query);


if (mysqli_num_rows($res) >= 1) {
    echo '<script>alert("Signed in successfully")</script>';
    require "option.html";
} else {
    echo '<script>alert("Incorrect admin username or password")</script>';
    require 'logIn.html';
}

mysqli_close($con);
?>
