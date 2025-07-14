<?php
include('../includes/db.php');
$currentPage = 'vaccines';

if (isset($_POST['add_vaccine'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $desc = $conn->real_escape_string($_POST['description']);
    $available = intval($_POST['available']);
    $imagePath = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $targetDir = "uploads/vaccine_images/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileName = uniqid() . "_" . basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            $imagePath = $targetFilePath;
        }
    }

    $stmt = $conn->prepare("INSERT INTO vaccines (name, description, available, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $name, $desc, $available, $imagePath);
    $stmt->execute();

    $successMsg = "Vaccine added successfully.";
}
?>

?>
<!DOCTYPE html>
<html>
<head>
    <title>Hospital - Add/View Vaccines</title>
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
            --input-bg: rgba(255, 255, 255, 0.2);
            --input-border: rgba(255, 255, 255, 0.4);
            --input-color: white;
            --placeholder-color: rgba(255, 255, 255, 0.7);
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

        form {
            background: rgba(255, 255, 255, 0.1); 
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 40px;
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
        }

        .form-control {
            background-color: var(--input-bg);
            border: 1px solid var(--input-border);
            color: var(--input-color);
            padding: 12px 18px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .form-control::placeholder {
            color: var(--placeholder-color);
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.25);
            border-color: var(--accent-blue-light);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.4);
            color: var(--input-color);
        }

        .form-control[name="available"] {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
        }

        .form-control option {
            background-color: var(--dashboard-grey-dark); 
            color: white;
        }

        .btn-primary {
            background: linear-gradient(90deg, var(--accent-blue-light), var(--accent-blue-dark));
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(52, 152, 219, 0.6);
            background: linear-gradient(90deg, var(--accent-blue-dark), var(--accent-blue-light));
        }

        .alert-success {
            background-color: rgba(40, 167, 69, 0.8); 
            color: white;
            border-color: rgba(40, 167, 69, 0.9);
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 30px;
            animation: fadeIn 0.5s ease-out;
        }

        .table-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
            animation: fadeInUp 1s ease-out forwards;
            animation-delay: 0.2s;
            opacity: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 15px;
        }

        thead {
            background: linear-gradient(135deg, #2c3e50 0%, #2980b9 100%);
            color: white;
            text-transform: uppercase;
        }

        thead th {
            padding: 16px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        tbody td {
            padding: 16px;
            background-color: rgba(255,255,255,0.95);
            color: #333;
            font-weight: 500;
            border-bottom: 1px solid #ddd;
        }

        tbody tr:nth-child(even) td {
            background-color: #f9f9f9;
        }

        tbody tr:hover td {
            background-color: #eef5ff;
        }

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

        @media (max-width: 768px) {
            .main-content {
                padding: 25px;
                margin: 15px;
                margin-left: 0; 
                width: auto;
            }

            .main-content > h2 {
                font-size: 2.2rem;
                padding: 20px;
                margin-bottom: 30px;
            }

            form {
                padding: 20px;
                margin-bottom: 30px;
            }

            .table-container {
                padding: 15px;
            }

            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                border: 1px solid #ccc;
                margin-bottom: 10px;
                padding: 10px;
                border-radius: 10px;
                background: white;
            }

            td {
                border: none;
                position: relative;
                padding-left: 50%;
                text-align: right;
            }

            td:before {
                content: attr(data-label);
                position: absolute;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                text-align: left;
                font-weight: bold;
                color: #333;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 20px;
                margin: 10px;
            }
            form {
                padding: 15px;
            }
            .btn-primary {
                width: 100%;
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

<?php include('../includes/sidebar1.php'); ?>

<div class="main-content">
    <h2 class="mb-4"><i class="fas fa-syringe me-2"></i>Add / View Vaccines</h2>

    <form method="post" enctype="multipart/form-data" class="mb-4">
        <input type="text" name="name" class="form-control mb-3" placeholder="Vaccine Name" required>
        <textarea name="description" class="form-control mb-3" placeholder="Description"></textarea>
        <select name="available" class="form-control mb-4">
            <option value="1">Available</option>
            <option value="0">Unavailable</option>
        </select>
        <input type="file" name="image" class="form-control mb-3" accept="image/*">
        <button type="submit" name="add_vaccine" class="btn btn-primary">Add Vaccine</button>
    </form>
    <?php if (isset($successMsg)) echo "<div class='alert alert-success'>$successMsg</div>"; ?>

    <?php

    $res = $conn->query("SELECT * FROM vaccines ORDER BY created_at DESC");
    echo "<div class='table-container'>";
    echo "<table>";
    echo "<thead><tr>
                <th><i class='fas fa-syringe me-2'></i>Name</th>
                <th><i class='fas fa-info-circle me-2'></i>Description</th>
                <th><i class='fas fa-check-circle me-2'></i>Status</th>
              </tr></thead><tbody>";

    while ($row = $res->fetch_assoc()) {
        $status = $row['available'] ? 'Available' : 'Unavailable';
        $statusClass = $row['available'] ? 'status-available' : 'status-unavailable';
        
        echo "<tr>
                <td data-label='Name'><i class='fas fa-syringe me-2' style='color: #27ae60;'></i>{$row['name']}</td>
                <td data-label='Description'><i class='fas fa-info-circle me-2' style='color: #3498db;'></i>{$row['description']}</td>
                <td data-label='Status'><span class='status-badge {$statusClass}'>{$status}</span></td>
              </tr>";
    }

    echo "</tbody></table></div>";
    ?>
</div>

</body>
</html>