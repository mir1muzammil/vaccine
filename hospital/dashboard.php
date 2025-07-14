<?php
include('../includes/db.php');
$currentPage = 'dashboard';


session_start();
if (!isset($_SESSION['hospital_logged_in']) || !$_SESSION['hospital_logged_in']) {
    header("Location: ../login.php");
    exit;
}

$hospital_id = $_SESSION['hospital_id']; 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hospital Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>

        :root {
            --dashboard-blue-dark: #1e3c72;
            --dashboard-blue-medium: #2a5298;
            --dashboard-grey-dark: #2c3e50;
            --dashboard-grey-medium: #34495e;
            --accent-blue-light: #3498db;
            --accent-blue-dark: #2980b9;
            --text-light: #f8f9fa;
            --text-dark-grey: #5a6c7d;
            --white-glass-bg: rgba(255, 255, 255, 0.15);
            --white-glass-border: rgba(255, 255, 255, 0.25);
            --card-light-bg-start: #ffffff;
            --card-light-bg-end: #f8fafc;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
            background: linear-gradient(135deg, var(--dashboard-blue-dark) 0%, var(--dashboard-blue-medium) 25%, var(--dashboard-grey-medium) 50%, var(--dashboard-grey-dark) 75%, #1a252f 100%);
            background-size: 300% 300%;
            animation: gradientShift 15s ease infinite;
            background-attachment: fixed;
            overflow-x: hidden;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(52, 152, 219, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.03) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        .main-content {
            margin-left: 250px;
            padding: 40px; 
            width: calc(100% - 250px);
            background: var(--white-glass-bg);
            border-radius: 25px; 
            margin: 20px; 
            backdrop-filter: blur(25px); 
            box-shadow:
                0 20px 40px rgba(0, 0, 0, 0.15),
                0 8px 20px rgba(0, 0, 0, 0.1),
                inset 0 1px 0 var(--white-glass-border);
            border: 1px solid var(--white-glass-border);
            animation: fadeIn 1.2s ease-out;
            position: relative;
            z-index: 1;
        }

        .main-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.05) 50%, transparent 70%);
            border-radius: 25px;
            pointer-events: none;
        }

        .main-content > h2 {
            font-size: clamp(2.2rem, 5vw, 3.5rem);
            font-weight: 900;
            text-align: center;
            margin-bottom: 50px;
            padding: 25px;
            color: white;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--dashboard-grey-dark) 0%, var(--dashboard-grey-medium) 25%, var(--accent-blue-light) 50%, var(--accent-blue-dark) 75%, var(--dashboard-blue-dark) 100%);
            background-size: 200% 200%;
            animation: headerGradient 8s ease infinite;
            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.3),
                0 4px 12px rgba(0, 0, 0, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            text-shadow: 0 3px 10px rgba(0, 0, 0, 0.4);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .main-content > h2::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            animation: slideShine 3s infinite;
        }

        @keyframes headerGradient {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        @keyframes slideShine {
            0% { left: -100%; }
            100% { left: 100%; }
        }


        .card-summary {
            display: flex;
            flex-wrap: wrap;
            gap: 30px; 
            margin-bottom: 40px; 
            position: relative;
            z-index: 1; 
        }

        .card-summary::before {
            content: '';
            position: absolute;
            inset: -15px; 
            background: var(--glass-white-lighter);
            border-radius: 20px;
            pointer-events: none;
            backdrop-filter: blur(5px);
            z-index: 0;
        }

        .dashboard-card {
            flex: 1;
            min-width: 280px; 
            border-radius: 20px;
            padding: 35px; 
            text-align: center;
            background: linear-gradient(145deg, var(--card-light-bg-start) 0%, var(--card-light-bg-end) 100%);
            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.12),
                0 4px 12px rgba(0, 0, 0, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.8);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.9);
            z-index: 1; 
            animation: fadeInUp 0.8s ease-out forwards; 
            opacity: 0;
        }
        .dashboard-card:nth-child(1) { animation-delay: 0.2s; }
        .dashboard-card:nth-child(2) { animation-delay: 0.4s; }
        .dashboard-card:nth-child(3) { animation-delay: 0.6s; }
        .dashboard-card:nth-child(4) { animation-delay: 0.8s; }


        .dashboard-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.6s ease;
        }

        .dashboard-card:hover::before {
            left: 100%;
        }

        .dashboard-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow:
                0 20px 40px rgba(0, 0, 0, 0.15),
                0 8px 20px rgba(0, 0, 0, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }

        .dashboard-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--accent-blue-light), var(--accent-blue-dark), var(--dashboard-grey-medium), var(--dashboard-grey-dark));
            background-size: 200% 100%;
            animation: shimmer 3s linear infinite;
            border-radius: 20px 20px 0 0;
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        .dashboard-card h4 { 
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-dark-grey);
            letter-spacing: 1px;
            margin-bottom: 15px;
            text-transform: uppercase;
            position: relative;
            z-index: 2;
        }

        .dashboard-card p { 
            font-size: clamp(2.5rem, 6vw, 3.5rem);
            font-weight: 900;
            background: linear-gradient(135deg, var(--dashboard-grey-dark) 0%, var(--dashboard-grey-medium) 25%, var(--accent-blue-light) 50%, var(--accent-blue-dark) 75%, var(--dashboard-blue-dark) 100%);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradientText 4s ease infinite;
            position: relative;
            margin: 0;
            z-index: 2;
            text-shadow: 0 0 30px rgba(52, 152, 219, 0.3);
        }

        @keyframes gradientText {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .dashboard-card p::before,
        .dashboard-card p::after {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            height: 3px;
            width: 60px;
            background: linear-gradient(90deg, var(--accent-blue-light), var(--accent-blue-dark), var(--dashboard-grey-medium));
            border-radius: 2px;
            animation: pulse 2s ease-in-out infinite;
        }

        .dashboard-card p::before {
            top: -15px;
        }

        .dashboard-card p::after {
            bottom: -15px;
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.6; width: 60px; }
            50% { opacity: 1; width: 80px; }
        }


        .table {
            border-radius: 15px;
            overflow: hidden; 
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1), 0 4px 12px rgba(0, 0, 0, 0.05);
            animation: fadeInUp 1s ease-out forwards;
            animation-delay: 1s; 
            opacity: 0;
        }

        .table thead th {
            background: linear-gradient(90deg, var(--accent-blue-light), var(--accent-blue-dark)); 
            color: white;
            font-weight: 600;
            padding: 15px;
            border-bottom: none;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            background-color: var(--card-light-bg-start); 
            transition: background-color 0.3s ease;
        }

        .table tbody tr:nth-child(even) {
            background-color: var(--card-light-bg-end);
        }

        .table tbody tr:hover {
            background-color: #e9ecef;
        }

        .table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
            color: #333;
            border-top: 1px solid #dee2e6;
        }

        .table tbody td:last-child {
            font-weight: bold;
        }
        .table tbody td:last-child[data-status="Pending"] {
            color: #ffc107; 
        }
        .table tbody td:last-child[data-status="Completed"] {
            color: #28a745; 
        }

        /* Responsive Fixes */
        @media (max-width: 768px) {
            .main-content {
                padding: 25px;
                margin: 15px;
                margin-left: 0; 
                width: auto; 
            }

            .card-summary {
                flex-direction: column;
                gap: 20px;
            }

            .dashboard-card {
                min-width: 100%; 
                padding: 30px;
            }

            .main-content > h2 {
                font-size: 2.2rem;
                padding: 20px;
                margin-bottom: 30px;
            }

            .table thead {
                display: none; 
            }

            .table tbody, .table tr, .table td {
                display: block; 
                width: 100%;
            }

            .table tr {
                margin-bottom: 15px;
                border: 1px solid #dee2e6;
                border-radius: 8px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            }

            .table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            .table td::before {
                content: attr(data-label); 
                position: absolute;
                left: 10px;
                width: calc(50% - 20px);
                text-align: left;
                font-weight: bold;
                color: var(--text-dark-grey);
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 20px;
                margin: 10px;
            }

            .dashboard-card {
                padding: 25px;
            }
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
    </style>
</head>
<body>


</head>
<body>

<?php include('../includes/sidebar1.php'); ?>
<div class="main-content">
    <h2 class="mb-4">Hospital Dashboard</h2>

    <?php
    $total = $conn->query("SELECT COUNT(*) AS count FROM bookings WHERE hospital_id = $hospital_id")->fetch_assoc()['count'];
    $pending = $conn->query("SELECT COUNT(*) AS count FROM bookings WHERE hospital_id = $hospital_id AND status = 'Pending'")->fetch_assoc()['count'];
    $vaccines = $conn->query("SELECT COUNT(*) AS count FROM vaccines WHERE available = 1")->fetch_assoc()['count'];
    ?>

    <div class="card-summary">
        <div class="dashboard-card">
            <h4>Total Bookings</h4>
            <p><?= $total ?></p>
        </div>
        <div class="dashboard-card">
            <h4>Pending</h4>
            <p><?= $pending ?></p>
        </div>
    </div>

    <div class="card-summary">
        <div class="dashboard-card">
            <h4>Vaccines Available</h4>
            <p><?= $vaccines ?></p>
        </div>
    </div>

</div>
</body>
</html>