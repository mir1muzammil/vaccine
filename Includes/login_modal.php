
<div id="authModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <form id="loginForm" class="auth-form" action="./assets/PHP/login.php" method="POST">
            <h2>Login</h2>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </form>
    </div>
</div>
<link rel="stylesheet" href="assets/css/index.css">
<script src="assets/js/login.js"></script>
 