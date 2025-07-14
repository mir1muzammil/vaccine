<?php
session_start();
if (!isset($_SESSION['parent_logged_in']) || !$_SESSION['parent_logged_in']) {
    header("Location: ../../index.php");
    exit;
}
$parent_id = $_SESSION['parent_id'];
include('Includes/db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Parent Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

        <style>
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(135deg, #e3f2fd, #bbdefb, #e3f2fd);
  background-size: 300% 300%;
  animation: backgroundShift 12s ease infinite;
  background-attachment: fixed;
  color: #333;
  overflow-x: hidden;
}

@keyframes backgroundShift {
  0%, 100% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
}

/* Headings */
h2, h4, h5 {
  font-weight: 700;
  text-shadow: none;
  color: #0d47a1;
}
.label1{
  font-weight: 500;
  text-shadow: none;
  color: #0d47a1;
}
/* Sections */
.section {
  display: none;
  animation: fadeIn 0.6s ease-in-out;
}

.section.active {
  display: block;
}

/* Cards / Forms / Tables */
form, table {
  background: #fff;
  padding: 25px;
  border-radius: 16px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.1);
  border: 1px solid #ddd;
  color: #333;
}

/* Inputs */
input, select {
  border-radius: 10px !important;
  padding: 12px !important;
  font-size: 15px !important;
  border: 1px solid #ccc !important;
  background-color: #f9f9f9 !important;
  color: #333 !important;
}

input::placeholder {
  color: #999 !important;
}

/* Buttons */
.btn-group .btn {
  font-weight: 500;
  border-radius: 50px;
  padding: 12px 24px;
  transition: all 0.3s ease;
  border: 2px solid #1976d2;
  background: white;
  color: #1976d2;
}

.btn-group .btn:hover {
  background: #1976d2;
  color: white;
}

.btn-success {
  background: #1976d2;
  border: none;
  color: white;
  transition: 0.3s ease;
}

.btn-success:hover {
  background: #1565c0;
}


table {
  text-align: center;
}

.table th {
  background-color: #1976d2;
  color: white;
}

.table td {
  background-color: #f3f7fb;
}


.alert {
  border-radius: 15px;
  font-weight: 500;
  background-color: #e3f2fd;
  color: #0d47a1;
  border: 1px solid #90caf9;
}

/* Animations */
@keyframes fadeIn {
  0% {
    opacity: 0;
    transform: translateY(30px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

@media (max-width: 768px) {
  .btn-group {
    flex-direction: column;
    gap: 10px;
  }

  form, table {
    width: 90% !important;
  }
}
</style>

</head>
<body>

<?php 
    include('Includes/navbar.php')
    ?>


<div class="text-center mt-4">
    <h2 class="text-primary">Welcome, <?= $_SESSION['parent_name'] ?? 'Parent' ?></h2>
</div>


<div class="d-flex justify-content-center mt-4 mb-4">
    <div class="btn-group gap-2">
        <button class="btn btn-outline-primary btn-lg" onclick="showSection('child')">Child</button>
        <button class="btn btn-outline-primary btn-lg" onclick="showSection('appointments')">Appointments</button>
        <button class="btn btn-outline-primary btn-lg" onclick="showSection('history')">History</button>
        <button class="btn btn-outline-primary btn-lg" onclick="showSection('booking')">Booking</button>
    </div>
</div>


<div class="container py-3">
  
    <div id="child" class="section active">
        <h4 class="text-center mb-3">Add Child</h4>
        <?php
        if (isset($_POST['add_child'])) {
            $name = $conn->real_escape_string($_POST['name']);
            $age = intval($_POST['age']);
            $contact = $conn->real_escape_string($_POST['contact']);
            $query = "INSERT INTO children (name, age, contact, parent_id) VALUES ('$name', $age, '$contact', $parent_id)";
            echo $conn->query($query)
                ? "<div class='alert alert-success'>Child added.</div>"
                : "<div class='alert alert-danger'>Error: {$conn->error}</div>";
        }
        ?>
        <form method="post" class="mb-4 w-50 mx-auto">
            <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
            <input type="number" name="age" class="form-control mb-2" placeholder="Age" required>
            <input type="text" name="contact" class="form-control mb-2" placeholder="Contact" required>
            <button type="submit" name="add_child" class="btn btn-primary w-100">Add</button>
        </form>

        <h5 class="text-center">Children List</h5>
        <table class="table table-bordered w-75 mx-auto">
            <thead><tr><th>#</th><th>Name</th><th>Age</th><th>Contact</th></tr></thead>
            <tbody>
                <?php
                $res = $conn->query("SELECT * FROM children WHERE parent_id=$parent_id");
                $i = 1;
                while ($row = $res->fetch_assoc()) {
                    echo "<tr><td>{$i}</td><td>{$row['name']}</td><td>{$row['age']}</td><td>{$row['contact']}</td></tr>";
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>


    <div id="appointments" class="section">
        <h4 class="text-center mb-3">Upcoming Appointments</h4>
        <table class="table table-bordered w-75 mx-auto">
            <thead><tr><th>Vaccine</th><th>Date</th><th>Hospital</th><th>Status</th></tr></thead>
            <tbody>
                <?php
                $sql = "SELECT b.*, v.name AS vaccine, h.name AS hospital FROM bookings b
                        LEFT JOIN vaccines v ON b.vaccine_id = v.id
                        LEFT JOIN hospitals h ON b.hospital_id = h.id
                        WHERE b.child_id IN (SELECT id FROM children WHERE parent_id=$parent_id)
                        AND b.status='Pending'";
                $res = $conn->query($sql);
                while ($row = $res->fetch_assoc()) {
                    echo "<tr><td>{$row['vaccine']}</td><td>{$row['booking_date']}</td><td>{$row['hospital']}</td><td>{$row['status']}</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>


    <div id="history" class="section">
        <h4 class="text-center mb-3">Vaccination History</h4>
        <table class="table table-bordered w-75 mx-auto">
            <thead><tr><th>Vaccine</th><th>Date</th><th>Hospital</th></tr></thead>
            <tbody>
                <?php
                $sql = "SELECT b.*, v.name AS vaccine, h.name AS hospital FROM bookings b
                        LEFT JOIN vaccines v ON b.vaccine_id = v.id
                        LEFT JOIN hospitals h ON b.hospital_id = h.id
                        WHERE b.child_id IN (SELECT id FROM children WHERE parent_id=$parent_id)
                        AND b.status='Completed'";
                $res = $conn->query($sql);
                while ($row = $res->fetch_assoc()) {
                    echo "<tr><td>{$row['vaccine']}</td><td>{$row['booking_date']}</td><td>{$row['hospital']}</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div id="booking" class="section">
        <h4 class="text-center mb-3">Book Vaccination</h4>
        <?php
        if (isset($_POST['book'])) {
            $child = intval($_POST['child_id']);
            $vaccine = intval($_POST['vaccine_id']);
            $hospital = intval($_POST['hospital_id']);
            $date = $_POST['date'];
            $q = "INSERT INTO bookings (child_id, vaccine_id, hospital_id, booking_date, status) 
                  VALUES ($child, $vaccine, $hospital, '$date', 'Pending')";
            echo $conn->query($q)
                ? "<div class='alert alert-success text-center'>Appointment booked.</div>"
                : "<div class='alert alert-danger text-center'>Error: {$conn->error}</div>";
        }
        ?>
        <form method="post" class="w-50 mx-auto">
          <label for="child_id" class="label1">Select your Child</label>
            <select name="child_id" class="form-control mb-2" required>
                <option value="">Select Child</option>
                <?php
                $c = $conn->query("SELECT * FROM children WHERE parent_id=$parent_id");
                while ($row = $c->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                ?>
            </select>
            <label for="vaccine_id" class="label1">Select your vaccine</label>
            <select name="vaccine_id" class="form-control mb-2" required>
                <option value="">Select Vaccine</option>
                <?php
                $v = $conn->query("SELECT * FROM vaccines WHERE available=1");
                while ($row = $v->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                ?>
            </select>
            <label for="hospita;_id" class="label1">Select any given hospital</label>
            <select name="hospital_id" class="form-control mb-2" required>
                <option value="">Select Hospital</option>
                <?php
                $h = $conn->query("SELECT * FROM hospitals");
                while ($row = $h->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                ?>
            </select>
            <label for="date" class="label1">Select any date for appointment</label>
            <input type="date" name="date" class="form-control mb-2" required>
            <button type="submit" name="book" class="btn btn-success w-100">Book</button>
        </form>
    </div>
</div>

<?php include('Includes/footer.php'); ?>
<script src="assets/Java/parentp.js"></script>
 