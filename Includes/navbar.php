<style>
    header {
            background-color: white;
            font-family: 'Poppins', sans-serif;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.07);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            color: #1976d2;
        }

        nav {
            display: flex;
            gap: 20px;
        }

        nav a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            position: relative;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #1976d2;
        }

        nav a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -3px;
            width: 0%;
            height: 2px;
            background-color: #1976d2;
            transition: width 0.3s ease-in-out;
        }

        nav a:hover::after {
            width: 100%;
        }

        .menu-toggle {
            display: none;
            flex-direction: column;
            gap: 4px;
            cursor: pointer;
        }

        .menu-toggle div {
            width: 25px;
            height: 3px;
            background-color: #333;
            transition: all 0.3s ease-in-out;
        }

        @media (max-width: 768px) {
            nav {
                position: absolute;
                top: 70px;
                left: 0;
                width: 100%;
                background-color: white;
                flex-direction: column;
                gap: 15px;
                padding: 20px;
                transform: translateY(-100%);
                opacity: 0;
                pointer-events: none;
                transition: all 0.4s ease;
            }

            nav.active {
                transform: translateY(0);
                opacity: 1;
                pointer-events: auto;
            }

            .menu-toggle {
                display: flex;
            }
        }

</style>

    <header>
        <div class="logo">Vaccital</div>
        <div class="menu-toggle" onclick="toggleMenu(this)">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <nav id="nav-links">
    <a href="index.php">Home</a>
    <a href="about.php">About</a> 
    <a href="vaccine.php">Vaccine</a>
    <a href="contact.php">Contact</a>

    <?php if (isset($_SESSION['parent_logged_in']) && $_SESSION['parent_logged_in'] === true): ?>
        <a href="parent-panel.php">booking</a>
        <a href="assets/PHP/logout.php">Logout</a>
    <?php else: ?>
        <a href="#" onclick="openModal('login')">Login / Register</a>
    <?php endif; ?>
</nav>

</nav>

    </header>
