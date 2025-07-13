<?php include('../includes/db.php');
$currentPage = 'dashboard'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
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
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
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

        /* Dashboard Container */
        .main-content {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 25px;
            margin: 20px;
            padding: 40px;
            flex: 1;
            backdrop-filter: blur(25px);
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

        /* Dashboard Cards */
        .dashboard-card {
            border-radius: 20px;
            padding: 35px;
            text-align: center;
            background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
            box-shadow:
                0 10px 30px rgba(0, 0, 0, 0.12),
                0 4px 12px rgba(0, 0, 0, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.8);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.9);
        }

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
            background: linear-gradient(90deg, #3498db, #2980b9, #34495e, #2c3e50);
            background-size: 200% 100%;
            animation: shimmer 3s linear infinite;
            border-radius: 20px 20px 0 0;
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        .dashboard-card h5 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #5a6c7d;
            letter-spacing: 1px;
            margin-bottom: 15px;
            text-transform: uppercase;
            position: relative;
            z-index: 2;
        }

        .dashboard-card h2 {
            font-size: clamp(2.5rem, 6vw, 3.5rem);
            font-weight: 900;
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 25%, #3498db 50%, #2980b9 75%, #1e3c72 100%);
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

        .dashboard-card h2::before,
        .dashboard-card h2::after {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            height: 3px;
            width: 60px;
            background: linear-gradient(90deg, #3498db, #2980b9, #34495e);
            border-radius: 2px;
            animation: pulse 2s ease-in-out infinite;
        }

        .dashboard-card h2::before {
            top: -15px;
        }

        .dashboard-card h2::after {
            bottom: -15px;
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.6; width: 60px; }
            50% { opacity: 1; width: 80px; }
        }

        /* Container Header */
        .container-custom > h2 {
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

        .container-custom > h2::before {
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
            0% { left: -100%; }
            100% { left: 100%; }
        }

        @keyframes headerGradient {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        /* Glass row background layer */
        .row {
            position: relative;
        }

        .row::before {
            content: '';
            position: absolute;
            inset: -15px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            pointer-events: none;
            backdrop-filter: blur(5px);
        }

        /* Responsive Fixes */
        @media (max-width: 768px) {
            .main-content {
                padding: 25px;
                margin: 15px;
            }
            
            .dashboard-card {
                padding: 30px;
            }
            
            .container-custom > h2 {
                font-size: 2.2rem;
                padding: 20px;
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

        /* Fade-In Animation */
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

        /* Staggered animation for cards */
        .dashboard-card {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
        }

        .col-md-6:nth-child(1) .dashboard-card {
            animation-delay: 0.2s;
        }

        .col-md-6:nth-child(2) .dashboard-card {
            animation-delay: 0.4s;
        }

        .col-12:nth-child(1) .dashboard-card {
            animation-delay: 0.6s;
        }

        .row:last-child .col-12 .dashboard-card {
            animation-delay: 0.8s;
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

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Focus styles for accessibility */
        .dashboard-card:focus-visible {
            outline: 2px solid #667eea;
            outline-offset: 2px;
        }

        /* Print styles */
        @media print {
            body {
                background: white !important;
            }
            
            .main-content {
                background: white !important;
                box-shadow: none !important;
            }
            
            .dashboard-card {
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) !important;
            }
        }
    </style>
</head>

<body>
    <?php include('../includes/sidebar.php'); ?>
    

    <div class="main-content">
        <div class="container-custom">
            <h2 class="mb-4">Admin Dashboard</h2>


            <div class="row mb-4">
                <?php
                $pairs = [
                    'Bookings' => 'SELECT COUNT(*) FROM bookings',
                    'Hospitals' => 'SELECT COUNT(*) FROM hospitals'
                ];
                foreach ($pairs as $label => $sql) {
                    $res = $conn->query($sql);
                    $row = $res->fetch_row();
                    echo "
        <div class='col-md-6'>
            <div class='dashboard-card'>
                <h5>$label</h5>
                <h2>{$row[0]}</h2>
            </div>
        </div>";
                }
                ?>
            </div>


            <div class="row g-4 mb-4">
                <?php
                $res = $conn->query('SELECT COUNT(*) FROM children');
                $row = $res->fetch_row();
                echo "
            <div class='col-12'>
                <div class='dashboard-card'>
                    <h5>Children</h5>
                    <h2>{$row[0]}</h2>
                </div>
            </div>";
                ?>
            </div>

            <div class="row g-4">
                <?php
                $res = $conn->query('SELECT COUNT(*) FROM vaccines');
                $row = $res->fetch_row();
                echo "
            <div class='col-12'>
                <div class='dashboard-card'>
                    <h5>Vaccines</h5>
                    <h2>{$row[0]}</h2>
                </div>
            </div>";
                ?>
            </div>

        </div>
    </div>

</body>

</html>