<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Parent Registration - Vaccine Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/register.css">
</head>
<body>
    <div class="register-box">
        <h2>Parent Registration</h2> 

        <?php if (isset($_SESSION['register_error'])): ?>
            <p style="color:red; text-align:center;"><?php echo $_SESSION['register_error']; unset($_SESSION['register_error']); ?></p>
        <?php endif; ?>

        <?php if (isset($_SESSION['register_success'])): ?>
            <p style="color:green; text-align:center;"><?php echo $_SESSION['register_success']; unset($_SESSION['register_success']); ?></p>
        <?php endif; ?>

        <form action="register_process.php" method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="index.php" onclick="openModal('login')">Login</a></p>
    </div>
</body>
</html>
