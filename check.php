<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if (isset($_POST['submit'])) {
    $email = $_POST['pemail'];
    $pass = $_POST['ppwd'];
    $role = $_POST['login']; // Getting radio button value

    // Check user credentials
    $sql = "SELECT * FROM details WHERE email = '$email' AND password = '$pass'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
       header("Location: enter.html");
        
        exit();
    } else {
        echo "<script>alert('Invalid Email or Password!'); window.location.href='login.html';</script>";
    }
}
?>