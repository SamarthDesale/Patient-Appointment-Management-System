
<?php include '../navbar.php'; ?>
<?php 
include 'doctor_auth.php';

include __DIR__ . '/../db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $id = intval($_POST['id']);
    $action = $_POST['action'];

    if ($action === 'delete') {
        $d = $conn->prepare('DELETE FROM appointments WHERE id=?');
        $d->bind_param('i', $id);
        $d->execute();
    } else {
        $s = $conn->prepare('UPDATE appointments SET status=? WHERE id=?');
        $s->bind_param('si', $action, $id);
        $s->execute();
    }
    header('Location: manage_appointments.php');
    exit;
}

$q = $conn->query('
    SELECT a.*, p.name AS patient_name, d.name AS doctor_name 
    FROM appointments a 
    JOIN patients p ON a.patient_id = p.id 
    JOIN doctors d ON a.doctor_id = d.id 
    ORDER BY appointment_date DESC, appointment_time DESC
');
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Appointments</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
    body {
        background: #f4f8fb;
    }
    .card {
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    table {
        border-radius: 10px;
        overflow: hidden;
    }
    thead {
        background: linear-gradient(90deg, #0d6efd, #0a58ca);
        color: white;
    }
    .badge-status {
        font-size: 0.85rem;
        padding: 6px 10px;
        border-radius: 20px;
    }
</style>
</head>
<body>

<div class="container py-4">
    <a href="doctor_dashboard.php" class="btn btn-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Back to Dashboard
    </a>

    <div class="card p-3">
        <h3 class="mb-3 text-primary">
            <i class="bi bi-calendar-event"></i> Manage Appointments
        </h3>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Patient</th>
                        <th>Doctor</th>
                        <th>Status</th>
                        <th>Notes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $q->fetch_assoc()): ?>
                        <tr>
                            <td><?= $r['appointment_date']; ?></td>
                            <td><?= substr($r['appointment_time'], 0, 5); ?></td>
                            <td><?= htmlspecialchars($r['patient_name']); ?></td>
                            <td><?= htmlspecialchars($r['doctor_name']); ?></td>
                            <td>
                                <?php 
                                    $statusClass = [
                                        "Pending"   => "bg-warning text-dark",
                                        "Confirmed" => "bg-success",
                                        "Completed" => "bg-primary",
                                        "Cancelled" => "bg-danger"
                                    ];
                                ?>
                                <span class="badge badge-status <?= $statusClass[$r['status']] ?? 'bg-secondary'; ?>">
                                    <?= $r['status']; ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($r['notes']); ?></td>
                            <td>
                                <form method="post" style="display:inline">
                                    <input type="hidden" name="id" value="<?= $r['id']; ?>">
                                    <button class="btn btn-sm btn-success" name="action" value="Confirmed" title="Confirm">
                                        <i class="bi bi-check-circle"></i>
                                    </button>
                                    <button class="btn btn-sm btn-primary" name="action" value="Completed" title="Complete">
                                        <i class="bi bi-check2-square"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning" name="action" value="Cancelled" title="Cancel">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                </form>
                                <form method="post" style="display:inline" onsubmit="return confirm('Delete appointment?');">
                                    <input type="hidden" name="id" value="<?= $r['id']; ?>">
                                    <button class="btn btn-sm btn-danger" name="action" value="delete" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
