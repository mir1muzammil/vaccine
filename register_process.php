<?php
session_start();
include './includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

 
    $check = mysqli_query($conn, "SELECT * FROM parents WHERE email = '$email'");
    if (mysqli_num_rows($check) > 0) {
        $_SESSION['register_error'] = "Email is already registered.";
        header("Location: register.php");
        exit();
    }

   
    $query = "INSERT INTO parents (name, email, password) VALUES ('$name', '$email', '$password')";
    if (mysqli_query($conn, $query)) {
        $_SESSION['register_success'] = "Registration successful. You can now log in.";
        header("Location: register.php");
        exit();
    } else {
        $_SESSION['register_error'] = "Something went wrong. Please try again.";
        header("Location: register.php"); 
        exit();
    }
}
?>
