<?php
include('../includes/db.php');
$currentPage = 'vaccines';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Manage Vaccines</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            display: flex;
            min-height: 100vh;
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 25%, #34495e 50%, #2c3e50 75%, #1a252f 100%);
            background-size: 300% 300%;
            animation: gradientShift 15s ease infinite;
            background-attachment: fixed;
            overflow-x: hidden;
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Floating particles background */
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

        /* Main layout */
        .main-content {
            margin-left: 220px;
            padding: 40px;
            width: calc(100% - 220px);
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(25px);
            border-radius: 25px;
            box-shadow:
                0 20px 40px rgba(0, 0, 0, 0.15),
                0 8px 20px rgba(0, 0, 0, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.25);
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

        /* Page Header */
        .main-content h2 {
            font-size: clamp(2.2rem, 5vw, 3.5rem);
            font-weight: 900;
            text-align: center;
            margin-bottom: 50px;
            padding: 25px;
            color: white;
            border-radius: 20px;
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 25%, #3498db 50%, #2980b9 75%, #1e3c72 100%);
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

        .main-content h2::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            animation: slideShine 3s infinite;
        }

        @keyframes slideShine {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }

        @keyframes headerGradient {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        /* Card Wrapper */
        .card {
            background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 20px;
            box-shadow:
                0 15px 35px rgba(0, 0, 0, 0.1),
                0 5px 15px rgba(0, 0, 0, 0.07),
                inset 0 1px 0 rgba(255, 255, 255, 0.8);
            padding: 30px;
            animation: fadeIn 1.2s ease-out;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.9);
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #3498db, #2980b9, #34495e, #2c3e50);
            background-size: 200% 100%;
            animation: shimmer 3s linear infinite;
            border-radius: 20px 20px 0 0;
        }

        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 15px;
            font-size: 1.05rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            margin-bottom: 0;
        }
        .table-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }
        thead {
            background: linear-gradient(135deg, #2c3e50 0%, #2980b9 100%);
            color: white;
            text-transform: uppercase;
        }


        thead.table-primary {
            background: linear-gradient(135deg, #2c3e50 0%, #2980b9 100%);
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        thead.table-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%);
            pointer-events: none;
        }

        thead th {
            padding: 16px;
            font-weight: bold;
            border: none;
            text-align: left;
        }

        tbody td {
            padding: 16px;
            background-color: rgba(255, 255, 255, 0.95);
            color: #333;
            font-weight: 500;
            border-bottom: 1px solid #ddd;
        }

        tbody tr:nth-child(even) td {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background: linear-gradient(90deg, #f8fafc 0%, #ffffff 100%);
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        tbody tr:hover td {
            background-color: #eef5ff;
        }

        /* Status Badge Styling */
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-available {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            color: white;
        }

        .status-unavailable {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
        }

        /* Delete Button */
        .btn-sm {
            font-size: 0.85rem;
            padding: 8px 16px;
            border-radius: 10px;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .btn-danger {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            border: none;
            color: white;
        }

        .btn-danger::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .btn-danger:hover::before {
            left: 100%;
        }

        .btn-sm:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
        }

        .btn-sm:active {
            transform: translateY(0) scale(0.98);
        }

        /* Alert styling */
        .alert {
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 25px;
            border: none;
            font-weight: 500;
            animation: slideInDown 0.6s ease-out;
        }

        .alert-success {
            background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(46, 204, 113, 0.3);
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 20px;
                border-radius: 0;
            }

            .card {
                padding: 20px;
            }

            .main-content h2 {
                font-size: 2rem;
                padding: 20px;
            }

            table {
                font-size: 0.9rem;
            }

            thead th,
            tbody td {
                padding: 12px;
            }
        }

        @media (max-width: 576px) {
            .main-content {
                padding: 15px;
            }

            .card {
                padding: 15px;
            }

            table {
                font-size: 0.8rem;
            }

            thead th,
            tbody td {
                padding: 8px;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Staggered table row animation */
        tbody tr {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
        }

        tbody tr:nth-child(1) {
            animation-delay: 0.1s;
        }

        tbody tr:nth-child(2) {
            animation-delay: 0.2s;
        }

        tbody tr:nth-child(3) {
            animation-delay: 0.3s;
        }

        tbody tr:nth-child(4) {
            animation-delay: 0.4s;
        }

        tbody tr:nth-child(5) {
            animation-delay: 0.5s;
        }

        tbody tr:nth-child(n+6) {
            animation-delay: 0.6s;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Print styles */
        @media print {
            body {
                background: white !important;
            }

            .main-content {
                background: white !important;
                box-shadow: none !important;
                margin-left: 0 !important;
                width: 100% !important;
            }

            .card {
                box-shadow: none !important;
            }

            .btn-danger {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <?php include('../includes/sidebar.php'); ?>

    <div class="main-content">
        <h2 class="mb-4"><i class="fas fa-syringe me-2"></i>Manage Vaccines</h2>

        <?php

        if (isset($_GET['del'])) {
            $id = intval($_GET['del']);
            $conn->query("DELETE FROM vaccines WHERE id = $id");
            echo "<div class='alert alert-success'>Vaccine deleted successfully.</div>";
        }

        $res = $conn->query("SELECT * FROM vaccines ORDER BY id DESC");

        echo "<div class='table-container'>";
        echo "<table class='table-striped'>";
        echo "<thead><tr>
            <th><i class='fas fa-syringe me-2'></i>Name</th>
            <th><i class='fas fa-file-text me-2'></i>Description</th>
            <th><i class='fas fa-info-circle me-2'></i>Status</th>
            <th><i class='fas fa-cogs me-2'></i>Action</th>
          </tr></thead><tbody>";

        while ($row = $res->fetch_assoc()) {
            $status = $row['available'] ? 'Available' : 'Unavailable';
            $statusClass = $row['available'] ? 'status-available' : 'status-unavailable';
            echo "<tr>
                <td><i class='fas fa-syringe me-2' style='color: #27ae60;'></i>{$row['name']}</td>
                <td><i class='fas fa-file-text me-2' style='color: #3498db;'></i>{$row['description']}</td>
                <td><span class='status-badge {$statusClass}'>{$status}</span></td>
                <td><a href='?del={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Delete this vaccine?');\">
                    <i class='fas fa-trash me-1'></i>Delete
                </a></td>
              </tr>";
        }

        echo "</tbody></table></div>";
        ?>
    </div>

</body>

</html>