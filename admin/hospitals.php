<?php
include('../includes/db.php');
$currentPage = 'hospitals';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Hospitals</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            display: flex;
            min-height: 100vh;
            font-family: 'Segoe UI', 'Roboto', sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            background-attachment: fixed;
            overflow-x: hidden;
        }

        .main-content {
            margin-left: 220px;
            padding: 40px;
            width: calc(100% - 220px);
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.3);
            animation: fadeIn 1s ease;
            position: relative;
            margin: 30px;
        }

        /* Gradient Header Like Admin Dashboard */
        .main-content h2 {
            font-size: clamp(2.2rem, 4vw, 3rem);
            font-weight: 900;
            text-align: center;
            margin-bottom: 40px;
            padding: 25px;
            color: white;
            border-radius: 20px;
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 25%, #3498db 50%, #2980b9 75%, #1e3c72 100%);
            background-size: 200% 200%;
            animation: headerGradient 8s ease infinite;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
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
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
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

        /* Add Hospital Form */
        form {
            background: rgba(255,255,255,0.2);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            margin-bottom: 40px;
            border: 1px solid rgba(255,255,255,0.2);
        }

        form input {
            margin-bottom: 15px;
            padding: 14px;
            border-radius: 12px;
            border: none;
            width: 100%;
            background-color: rgba(255,255,255,0.8);
            font-weight: 500;
        }

        form input::placeholder {
            color: #666;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3498db, #2980b9);
            border: none;
            color: white;
            font-weight: 700;
            padding: 12px 25px;
            border-radius: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2980b9, #1e3c72);
            transform: scale(1.03);
        }

        /* Table Styling */
        .table-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
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

        .btn-danger {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.9rem;
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
            border: none;
            transition: 0.3s ease;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #c0392b, #96281b);
            transform: scale(1.03);
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<?php include('../includes/sidebar.php'); ?>

<div class="main-content">
    <h2>Manage Hospitals</h2>

    <form method="post" class="mb-4">
        <input type="text" name="hospital_name" class="form-control mb-3" placeholder="Hospital Name" required>
        <input type="text" name="location" class="form-control mb-3" placeholder="Location" required>
        <button type="submit" name="add_hospital" class="btn btn-primary">Add Hospital</button>
    </form>

    <?php
    if (isset($_POST['add_hospital'])) {
        $name = $conn->real_escape_string($_POST['hospital_name']);
        $location = $conn->real_escape_string($_POST['location']);
        $conn->query("INSERT INTO hospitals (name, location) VALUES ('$name', '$location')");
    }

    if (isset($_GET['del'])) {
        $id = intval($_GET['del']);
        $conn->query("DELETE FROM hospitals WHERE id = $id");
    }

    $res = $conn->query("SELECT * FROM hospitals");
    echo "<div class='table-container'>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>";
    while ($row = $res->fetch_assoc()) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['location']}</td>
                <td>
                    <a href='?del={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                </td>
              </tr>";
    }
    echo "</tbody></table></div>";
    ?>
</div>

</body>
</html>
