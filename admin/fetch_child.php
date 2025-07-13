<?php
include('../includes/db.php');

if (isset($_GET['parent_id'])) {
    $parent_id = intval($_GET['parent_id']);
    $res = $conn->query("SELECT name, age, contact FROM children WHERE parent_id = $parent_id LIMIT 1");
    echo json_encode($res->fetch_assoc() ?? []);
}
?>
