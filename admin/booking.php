<?php
include('../includes/db.php');
$currentPage = 'booking';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Bookings</title>
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

        .btn-success {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            color: white;
            font-weight: 600;
            border: none;
        }

        .btn-danger {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
            font-weight: 600;
            border: none;
        }

        .btn-sm {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.875rem;
            transition: 0.3s ease;
        }

        .btn-sm:hover {
            transform: scale(1.05);
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
    <h2 class="mb-4"><i class="fas fa-calendar-check me-2"></i>Manage Bookings</h2>

    <?php
    if (isset($_GET['action']) && isset($_GET['id'])) {
        $action = $_GET['action'];
        $id = intval($_GET['id']);
        if (in_array($action, ['Approved', 'Rejected'])) {
            $conn->query("UPDATE bookings SET status = '$action' WHERE id = $id");
            echo "<div class='alert alert-success'>
                    <i class='fas fa-check-circle me-2'></i>
                    Booking status updated to <strong>{$action}</strong> successfully!
                  </div>";
        }
    }

    $sql = "SELECT b.id, c.name AS child_name, h.name AS hospital_name,
                   v.name AS vaccine_name, b.booking_date, b.status
            FROM bookings b
            JOIN children c ON b.child_id = c.id
            JOIN hospitals h ON b.hospital_id = h.id
            JOIN vaccines v ON b.vaccine_id = v.id
            ORDER BY b.booking_date DESC";

    $res = $conn->query($sql);

    if (!$res) {
        echo "<div class='alert alert-danger'><i class='fas fa-exclamation-triangle me-2'></i>Query Error: " . $conn->error . "</div>";
    } elseif ($res->num_rows == 0) {
        echo "<div class='alert alert-warning'><i class='fas fa-info-circle me-2'></i>No bookings found.</div>";
    } else {
        echo "<div class='table-container'>";
        echo "<table>";
        echo "<thead><tr>
                <th>Child</th>
                <th>Hospital</th>
                <th>Vaccine</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
              </tr></thead><tbody>";

        while ($row = $res->fetch_assoc()) {
            $id = $row['id'];
            $status = $row['status'];
            echo "<tr>
                    <td>{$row['child_name']}</td>
                    <td>{$row['hospital_name']}</td>
                    <td>{$row['vaccine_name']}</td>
                    <td>{$row['booking_date']}</td>
                    <td>{$status}</td>
                    <td>
                        <a href='?action=Approved&id=$id' class='btn btn-success btn-sm' 
                           onclick=\"return confirm('Approve this booking?');\">
                           <i class='fas fa-check me-1'></i>Approve
                        </a>
                        <a href='?action=Rejected&id=$id' class='btn btn-danger btn-sm'
                           onclick=\"return confirm('Reject this booking?');\">
                           <i class='fas fa-times me-1'></i>Reject
                        </a>
                    </td>
                  </tr>";
        }

        echo "</tbody></table></div>";
    }
    ?>
</div>

</body>
</html>