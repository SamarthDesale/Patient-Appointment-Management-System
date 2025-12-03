<?php include '../navbar.php'; ?>
<?php
session_start();
include '../db.php';

if (!isset($_SESSION['doctor_id'])) {
    header("Location: ../login.php");
    exit();
}

$doctor_id = $_SESSION['doctor_id'];

// Fetch pending appointments
$sql = "SELECT a.id, a.appointment_date, a.appointment_time, p.name AS patient_name
        FROM appointments a
        JOIN patients p ON a.patient_id = p.id
        WHERE a.doctor_id='$doctor_id' AND a.status='pending'
        ORDER BY a.appointment_date, a.appointment_time";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pending Appointments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2 class="mb-4">Pending Appointments</h2>
    <a href="dashboard.php" class="btn btn-secondary mb-3">Back</a>

    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>Patient Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['patient_name']); ?></td>
                <td><?php echo $row['appointment_date']; ?></td>
                <td><?php echo date('h:i A', strtotime($row['appointment_time'])); ?></td>
                <td><?php echo ucfirst($row['status']); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
