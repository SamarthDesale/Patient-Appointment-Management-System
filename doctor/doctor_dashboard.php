<?php
session_start();
if (!isset($_SESSION['doctor_id'])) {
    header("Location: login.php");
    exit();
}
$doctor_name = $_SESSION['doctor_name'];
?>

<?php include '../navbar.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Doctor Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Welcome, <?php echo htmlspecialchars($doctor_name); ?></h3>
    <a href="logout.php" class="btn btn-danger mb-3">Logout</a>
    
    <div class="row">
        <div class="col-md-6">
            <a href="manage_appointments.php" class="btn btn-primary w-100 mb-3">View Pending Appointments</a>
        </div>
        <div class="col-md-6">
            <a href="set_availability.php" class="btn btn-success w-100 mb-3">Manage Availability</a>
        </div>
    </div>
</div>
</body>
</html>
