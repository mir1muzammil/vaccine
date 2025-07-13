<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    :root {
        /* Define colors based on the dashboard's gradient and accent */
        --dashboard-blue-dark: #1e3c72;
        --dashboard-blue-medium: #2a5298;
        --dashboard-blue-light: #3498db;
        --dashboard-grey-dark: #2c3e50;
        --dashboard-grey-medium: #34495e;
        --glass-white-light: rgba(255, 255, 255, 0.15);
        --glass-white-lighter: rgba(255, 255, 255, 0.05);
        --glass-border: rgba(255, 255, 255, 0.25);
        --text-light: #f8f9fa;
        --text-dark: #5a6c7d;
        --accent-blue: #3498db;
    }

    body, html {
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
    }

    .wrapper {
        display: flex;
        min-height: 100vh;
    }

    .sidebar {
        width: 250px; /* Slightly wider */
        background: linear-gradient(180deg, var(--dashboard-blue-dark) 0%, var(--dashboard-grey-dark) 100%); /* Use dashboard gradient */
        color: var(--text-light);
        padding: 30px 15px; /* More padding */
        height: 100vh;
        position: fixed;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 5px 0 15px rgba(0, 0, 0, 0.3); /* Subtle shadow for depth */
        z-index: 10; /* Ensure it's above other elements if needed */
        backdrop-filter: blur(10px); /* Glassmorphism effect */
        border-right: 1px solid var(--glass-border); /* Border for glass effect */
    }

    .sidebar h4 {
        color: var(--text-light);
        margin-bottom: 40px; /* More space */
        font-size: 1.6rem; /* Larger heading */
        font-weight: 700;
        text-align: center;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
    }

    .sidebar .nav-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar .nav-item {
        margin-bottom: 10px; /* Space between items */
    }

    .sidebar a {
        color: var(--text-light);
        text-decoration: none;
        display: flex; /* Use flex for icon and text alignment */
        align-items: center;
        padding: 12px 20px; /* Larger clickable area */
        border-radius: 12px; /* More rounded corners for softness */
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        font-weight: 500;
    }

    .sidebar a .fa-solid {
        margin-right: 12px; /* More space for icon */
        font-size: 1.1rem; /* Slightly larger icons */
    }

    .sidebar a:hover {
        background: rgba(255, 255, 255, 0.2); /* Lighter glass effect on hover */
        transform: translateX(5px); /* Subtle slide effect */
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    /* Active link styles to match dashboard header/card accents */
    .sidebar a.active {
        background: linear-gradient(90deg, var(--accent-blue), #2980b9); /* Vibrant gradient for active state */
        color: white;
        font-weight: 600;
        box-shadow: 0 0 10px rgba(52, 152, 219, 0.7), 0 0 20px rgba(52, 152, 219, 0.5); /* Glowing effect */
        transform: scale(1.02); /* Slightly pop out */
        border: 1px solid rgba(255, 255, 255, 0.5); /* Stronger border for active */
    }

    .sidebar a.active::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        animation: activeShine 1.5s infinite;
        pointer-events: none;
    }

    @keyframes activeShine {
        0% { left: -100%; }
        100% { left: 100%; }
    }


    .sidebar .logout-btn {
        background: linear-gradient(90deg, #dc3545, #bb2d3b); /* Red gradient for logout */
        color: white;
        border: none; /* Remove default button border */
        padding: 12px 15px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(220, 53, 69, 0.4);
    }

    .sidebar .logout-btn:hover {
        background: linear-gradient(90deg, #bb2d3b, #dc3545);
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(220, 53, 69, 0.6);
    }

    .main-content {
        margin-left: 250px; /* Adjust margin for wider sidebar */
        padding: 30px;
        width: calc(100% - 250px);
        /* The main-content background is handled by the dashboard body style */
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .sidebar {
            width: 200px;
            padding: 20px 10px;
        }
        .main-content {
            margin-left: 200px;
            width: calc(100% - 200px);
        }
        .sidebar a {
            padding: 10px 15px;
        }
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative; /* Make it block level on small screens */
            box-shadow: none;
            border-right: none;
            padding-bottom: 0;
        }
        .sidebar h4 {
            margin-bottom: 20px;
            font-size: 1.4rem;
        }
        .sidebar .nav-links {
            display: flex; /* Horizontal layout for nav links */
            flex-wrap: wrap; /* Allow wrapping */
            justify-content: center; /* Center items */
            gap: 10px; /* Space between links */
            margin-bottom: 20px;
        }
        .sidebar .nav-item {
            margin-bottom: 0;
        }
        .sidebar a {
            padding: 8px 12px;
            font-size: 0.9rem;
            border-radius: 8px;
        }
        .sidebar a .fa-solid {
            margin-right: 8px;
            font-size: 1rem;
        }
        .sidebar .logout-btn {
            width: auto;
            margin: 0 auto 20px auto; /* Center button */
            display: block;
        }
        .main-content {
            margin-left: 0;
            width: 100%;
            padding-top: 20px; /* Adjust padding for content below sidebar */
        }
    }

    @media (max-width: 480px) {
        .sidebar .nav-links {
            flex-direction: column; /* Stack vertically on very small screens */
            align-items: center;
        }
        .sidebar a {
            width: calc(100% - 20px); /* Almost full width */
            text-align: center;
            justify-content: center; /* Center icon and text */
        }
        .sidebar a .fa-solid {
            margin-right: 0; /* Remove margin as text will be below or less space */
            margin-bottom: 5px; /* Add margin below icon if stacked */
        }
    }
</style>

<div class="sidebar">
    <div>
        <h4>Admin Panel</h4>
        <ul class="nav-links">
            <li class="nav-item">
                <a href="dashboard.php" class="<?= ($currentPage == 'dashboard') ? 'active' : '' ?>">
                    <i class="fa-solid fa-table-columns"></i>Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="vaccines.php" class="<?= ($currentPage == 'vaccines') ? 'active' : '' ?>">
                    <i class="fa-solid fa-syringe"></i>Vaccines
                </a>
            </li>
            <li class="nav-item">
                <a href="hospitals.php" class="<?= ($currentPage == 'hospitals') ? 'active' : '' ?>">
                    <i class="fa-solid fa-hospital"></i>Hospitals
                </a>
            </li>
            <li class="nav-item">
                <a href="children.php" class="<?= ($currentPage == 'children') ? 'active' : '' ?>">
                    <i class="fa-solid fa-children"></i>Children
                </a>
            </li>
            <li class="nav-item">
                <a href="booking.php" class="<?= ($currentPage == 'booking') ? 'active' : '' ?>">
                    <i class="fa-solid fa-book-medical"></i>Bookings
                </a>
            </li>
            <li class="nav-item">
                <a href="reports.php" class="<?= ($currentPage == 'reports') ? 'active' : '' ?>">
                    <i class="fa-solid fa-book-open"></i>Reports
                </a>
            </li>
        </ul>
    </div>

    <div>
        <a href="../assets/PHP/logout.php" class="btn logout-btn w-100">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>
    </div>
</div>