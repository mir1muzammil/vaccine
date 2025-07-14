<?php
include('../includes/db.php');
$currentPage = 'children';

if (isset($_GET['del'])) {
    $child_id = intval($_GET['del']);
    $conn->query("DELETE FROM children WHERE id = $child_id");
    header("Location: children.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Children</title>
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
    <h2 class="mb-4"><i class="fas fa-child me-2"></i>Manage Children</h2>

    <form class="mb-4">
        <div class="row g-3">
            <div class="col-md-6">
                <select id="parentSelect" class="form-control">
                    <option value="">-- Select Parent --</option>
                    <?php
                    $parents = $conn->query("SELECT id, name FROM parents");
                    while ($p = $parents->fetch_assoc()) {
                        echo "<option value='{$p['id']}'>{$p['name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6">
                <input type="text" id="childName" class="form-control" placeholder="Child Name" readonly>
            </div>
            <div class="col-md-6">
                <input type="number" id="childAge" class="form-control" placeholder="Age" readonly>
            </div>
            <div class="col-md-6">
                <input type="text" id="childContact" class="form-control" placeholder="Contact Number" readonly>
            </div>
        </div>
    </form>

    <?php
    $sql = "SELECT c.*, p.name AS parent_name 
            FROM children c 
            LEFT JOIN parents p ON c.parent_id = p.id 
            ORDER BY c.id ASC";
    $result = $conn->query($sql);

    if (!$result) {
        echo "<div class='alert alert-danger'><i class='fas fa-exclamation-triangle me-2'></i>Query Error: " . $conn->error . "</div>";
    } elseif ($result->num_rows == 0) {
        echo "<div class='alert alert-warning'><i class='fas fa-info-circle me-2'></i>No children found.</div>";
    } else {
        echo "<div class='table-container'>";
        echo "<table>";
        echo "<thead><tr>
                <th>#</th>
                <th>Name</th>
                <th>Age</th>
                <th>Contact</th>
                <th>Parent</th>
                <th>Action</th>
              </tr></thead><tbody>";

        $i = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$i}</td>
                    <td><i class='fas fa-child me-2' style='color: #667eea;'></i>{$row['name']}</td>
                    <td>{$row['age']}</td>
                    <td>{$row['contact']}</td>
                    <td>{$row['parent_name']}</td>
                    <td>
                        <a href='?del={$row['id']}' class='btn btn-danger btn-sm'
                           onclick=\"return confirm('Delete this child?');\">
                           <i class='fas fa-trash me-1'></i>Delete
                        </a>
                    </td>
                  </tr>";
            $i++;
        }

        echo "</tbody></table></div>";
    }
    ?>
</div>

<script>
document.getElementById('parentSelect').addEventListener('change', function () {
    const parentId = this.value;
    const childName = document.getElementById('childName');
    const childAge = document.getElementById('childAge');
    const childContact = document.getElementById('childContact');
    
    if (parentId === '') {
        childName.value = '';
        childAge.value = '';
        childContact.value = '';
        return;
    }

    childName.classList.add('loading');
    childAge.classList.add('loading');
    childContact.classList.add('loading');

    fetch('fetch_child.php?parent_id=' + parentId)
        .then(response => response.json())
        .then(data => {
            if (data && data.name) {
                childName.value = data.name;
                childAge.value = data.age;
                childContact.value = data.contact;
            } else {
                childName.value = 'No child found';
                childAge.value = '';
                childContact.value = '';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            childName.value = 'Error loading data';
            childAge.value = '';
            childContact.value = '';
        })
        .finally(() => {
            childName.classList.remove('loading');
            childAge.classList.remove('loading');
            childContact.classList.remove('loading');
        });
});
</script>

</body>
</html>