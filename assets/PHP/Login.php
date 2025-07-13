<?php
session_start();
include('../../Includes/db.php');

$email = $_POST['email'];
$password = $_POST['password'];

// Check Admin Login
$admin_query = "SELECT * FROM admins WHERE email = '$email'";
$admin_result = mysqli_query($conn, $admin_query);

if (mysqli_num_rows($admin_result) == 1) {
    $admin = mysqli_fetch_assoc($admin_result);
    if ($admin['password'] == $password) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_name'] = $admin['name'];
        header("Location: ../../admin/dashboard.php");
        exit();
    }
}

// Check Hospital Login
$hospital_query = "SELECT * FROM hospitals WHERE email = '$email'";
$hospital_result = mysqli_query($conn, $hospital_query);

if (mysqli_num_rows($hospital_result) == 1) {
    $hospital = mysqli_fetch_assoc($hospital_result);
    if ($hospital['password'] == $password) {
        $_SESSION['hospital_logged_in'] = true;
        $_SESSION['hospital_id'] = $hospital['id'];
        $_SESSION['hospital_name'] = $hospital['name'];
        header("Location: ../../hospital/dashboard.php");
        exit();
    }
}

// Check Parent Login
$parent_query = "SELECT * FROM parents WHERE email = '$email'";
$parent_result = mysqli_query($conn, $parent_query);

if (mysqli_num_rows($parent_result) == 1) {
    $parent = mysqli_fetch_assoc($parent_result);
    if ($parent['password'] == $password) {
        $_SESSION['parent_logged_in'] = true;
        $_SESSION['parent_id'] = $parent['id'];
        $_SESSION['parent_name'] = $parent['name'];
        header("Location: ../../index.php");
        exit();
    }
}

echo "Invalid login credentials.";
?>
