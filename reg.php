<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'test';
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection not established: " . mysqli_connect_error());
}

if (isset($_POST['enter'])) {
    $email = $_POST['uemail'];
    $pass = $_POST['upwd'];

    // Check if form values are empty
    if (empty($email) || empty($pass)) {
        echo "<script>alert('Email or Password cannot be empty!'); window.location.href='signup.html';</script>";
        exit();
    }

    // Check if the email is already registered (ignores password)
    $emailCheckQuery = "SELECT * FROM details WHERE email='$email'";
    $emailResult = mysqli_query($conn, $emailCheckQuery);

    if (mysqli_num_rows($emailResult) > 0) {
        // Email already registered, now check if the same email & password exist
        $checkQuery = "SELECT * FROM details WHERE email='$email' AND password='$pass'";
        $result = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($result) > 0) {
            // User already registered with the same email & password
            echo "<script>alert('You have already registered!'); window.location.href='login.html';</script>";
        } else {
            // Email is registered but with a different password
            echo "<script>alert('This email is already registered! Try logging in.'); window.location.href='login.html';</script>";
        }
    } else {
        // Insert new user
        $sql = "INSERT INTO details (email, password) VALUES ('$email', '$pass')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Registered Successfully!'); window.location.href='login.html';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href='signup.html';</script>";
        }
    }
}

mysqli_close($conn);
?>