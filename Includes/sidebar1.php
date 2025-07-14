<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    :root {
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
        width: 250px; 
        background: linear-gradient(180deg, var(--dashboard-blue-dark) 0%, var(--dashboard-grey-dark) 100%);
        color: var(--text-light);
        padding: 30px 15px;
        height: 100vh;
        position: fixed;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 5px 0 15px rgba(0, 0, 0, 0.3);
        z-index: 10; 
        backdrop-filter: blur(10px);
        border-right: 1px solid var(--glass-border); 
    }

    .sidebar h4 {
        color: var(--text-light);
        margin-bottom: 40px;
        font-size: 1.6rem; 
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
        margin-bottom: 10px;
    }

    .sidebar a {
        color: var(--text-light);
        text-decoration: none;
        display: flex; 
        align-items: center;
        padding: 12px 20px; 
        border-radius: 12px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        font-weight: 500;
    }

    .sidebar a .fa-solid, .sidebar a i { 
        margin-right: 12px;
        font-size: 1.1rem; 
    }

    .sidebar a:hover {
        background: rgba(255, 255, 255, 0.2); 
        transform: translateX(5px); 
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }


    .sidebar a.active {
        background: linear-gradient(90deg, var(--accent-blue), #2980b9); 
        color: white;
        font-weight: 600;
        box-shadow: 0 0 10px rgba(52, 152, 219, 0.7), 0 0 20px rgba(52, 152, 219, 0.5); 
        transform: scale(1.02); 
        border: 1px solid rgba(255, 255, 255, 0.5); 
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
        background: linear-gradient(90deg, #dc3545, #bb2d3b); 
        color: white;
        border: none; 
        padding: 12px 15px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(220, 53, 69, 0.4);
        margin-top: 30px; 
    }

    .logout-btn:hover {
        background: linear-gradient(90deg, #bb2d3b, #dc3545);
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(220, 53, 69, 0.6);
        color: white;
    }

    .main-content {
        margin-left: 250px; 
        padding: 30px;
        width: calc(100% - 250px);
     }

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
            position: relative; 
            box-shadow: none;
            border-right: none;
            padding-bottom: 0;
        }
        .sidebar h4 {
            margin-bottom: 20px;
            font-size: 1.4rem;
        }
        .sidebar .nav-links {
            display: flex; 
            flex-wrap: wrap; 
            justify-content: center; 
            gap: 10px; 
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
        .sidebar a .fa-solid, .sidebar a i {
            margin-right: 8px;
            font-size: 1rem;
        }
        .sidebar .logout-btn {
            width: auto;
            margin: 0 auto 20px auto; 
            display: block;
        }
        .main-content {
            margin-left: 0;
            width: 100%;
            padding-top: 20px;
        }
    }

    @media (max-width: 480px) {
        .sidebar .nav-links {
            flex-direction: column; 
            align-items: center;
        }
        .sidebar a {
            width: calc(100% - 20px);
            text-align: center;
            justify-content: center;
        }
        .sidebar a .fa-solid, .sidebar a i {
            margin-right: 0;
            margin-bottom: 5px; 
        }
    }
</style>

<div class="sidebar">
    <div>
        <h4>Hospital Panel</h4>
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
                <a href="appointment-manage.php" class="<?= ($currentPage == 'booking') ? 'active' : '' ?>">
                    <i class="fa-solid fa-book-medical"></i>Management
                </a>
            </li>
            <li class="nav-item">
                <a href="reports.php" class="<?= ($currentPage == 'reports') ? 'active' : '' ?>">
                    <i class="fa-solid fa-book-open"></i>Reports
                </a>
            </li>
        </ul>
    </div>

    <a href="../assets/PHP/logout.php" class="btn logout-btn w-100">
        <i class="fa-solid fa-right-from-bracket"></i> Logout
    </a>
</div>