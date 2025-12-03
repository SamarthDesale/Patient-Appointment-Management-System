<?php 
include '../navbar.php'; 

// patient/dashboard.php
session_start();
if (!isset($_SESSION['patient_id'])) {
    header('Location: login.php');
    exit;
}

include __DIR__ . '/../db.php';

$pid = $_SESSION['patient_id'];
$stmt = $conn->prepare(
    'SELECT a.*, d.name AS doctor_name, d.specialization
     FROM appointments a
     JOIN doctors d ON a.doctor_id = d.id
     WHERE a.patient_id = ?
     ORDER BY appointment_date DESC, appointment_time DESC'
);
$stmt->bind_param('i', $pid);
$stmt->execute();
$res = $stmt->get_result();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Patient Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #60b9d4ff;
            font-family: 'Segoe UI', sans-serif;
        }
        .dashboard-header {
            background: linear-gradient(90deg, #004e92, #000428);
            color: white;
            padding: 20px;
            border-radius: 10px;
        }
        .dashboard-header h3 {
            margin: 0;
        }
        .btn-custom {
            background: #00b894;
            color: white;
        }
        .btn-custom:hover {
            background: #019875;
            color: white;
        }
        table {
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }
        th {
            background: #004e92;
            color: white;
        }
    </style>
    <link rel="stylesheet" href="/clinic/styles.css">
</head>
<body>
<div class="container py-4">
    <div class="dashboard-header d-flex justify-content-between align-items-center shadow">
        <h3>Hello, <?php echo htmlspecialchars($_SESSION['patient_name']); ?></h3>
        <a class="btn btn-light btn-sm" href="logout.php">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>

    <div class="mt-4 d-flex justify-content-between align-items-center">
        <a href="/index.php" class="btn btn-outline-secondary">
            <i class="bi bi-house-door"></i> Home
       
        <a class="btn btn-custom" href="book.php">
            <i class="bi bi-calendar-plus"></i> Book Appointment
        </a>
    </div>

    <div class="mt-4">
        <h5 class="mb-3">
            <i class="bi bi-clock-history"></i> Your Appointment History
        </h5>
        <div class="table-responsive shadow">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Doctor</th>
                        <th>Status</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($res->num_rows > 0): ?>
                        <?php while($r = $res->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $r['appointment_date']; ?></td>
                            <td><?php echo substr($r['appointment_time'], 0, 5); ?></td>
                            <td>
                                <?php echo htmlspecialchars($r['doctor_name']); ?> 
                                <small class="text-muted">
                                    (<?php echo htmlspecialchars($r['specialization']); ?>)
                                </small>
                            </td>
                            <td>
                                <?php
                                    $statusClass = match($r['status']) {
                                        'Confirmed' => 'badge bg-success',
                                        'Pending' => 'badge bg-warning text-dark',
                                        'Cancelled' => 'badge bg-danger',
                                        default => 'badge bg-secondary'
                                    };
                                    echo "<span class='$statusClass'>" . htmlspecialchars($r['status']) . "</span>";
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($r['notes']); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                No appointments found.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
