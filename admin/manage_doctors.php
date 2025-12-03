<?php include '../navbar.php'; ?>
<?php include 'admin_auth.php'; include __DIR__ . '/../db.php';
$doctors = $conn->query('SELECT * FROM doctors ORDER BY name');
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Manage Doctors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/clinic/styles.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .page-container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            margin-top: 30px;
        }
        h3 {
            font-weight: 600;
            color: #0d47a1;
        }
        .table thead th {
            background-color: #0d47a1;
            color: white;
            font-weight: 600;
        }
        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .btn-primary {
            background-color: #1565c0;
            border-color: #1565c0;
        }
        .btn-primary:hover {
            background-color: #0d47a1;
            border-color: #0d47a1;
        }
        .btn-danger {
            background-color: #d32f2f;
            border-color: #d32f2f;
        }
        .btn-danger:hover {
            background-color: #b71c1c;
            border-color: #b71c1c;
        }
        .btn-success {
            background-color: #388e3c;
            border-color: #388e3c;
        }
        .btn-success:hover {
            background-color: #2e7d32;
            border-color: #2e7d32;
        }
        .btn-warning {
            background-color: #fbc02d;
            border-color: #fbc02d;
            color: black;
        }
        .btn-warning:hover {
            background-color: #f9a825;
            border-color: #f9a825;
            color: black;
        }
    </style>
</head>
<body>

<div class="container page-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Manage Doctors</h3>
        <a class="btn btn-success" href="add_doctor.php"><i class="bi bi-person-plus-fill"></i> Add Doctor</a>
    </div>
    <div class="container py-4">
        <a href="admin_dashboard.php" class="btn btn-secondary mb-3">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Specialization</th>
                        <th>Contact</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($d = $doctors->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($d['name']); ?></td>
                        <td><?php echo htmlspecialchars($d['specialization']); ?></td>
                        <td><?php echo htmlspecialchars($d['contact']); ?></td>
                        <td>
                            <a class="btn btn-sm btn-primary me-2" href="edit_doctor.php?id=<?php echo $d['id']; ?>">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <a class="btn btn-sm btn-danger me-2" href="delete_doctor.php?id=<?php echo $d['id']; ?>" onclick="return confirm('Are you sure you want to delete this doctor?');">
                                <i class="bi bi-trash"></i> Delete
                            </a>
                            <a class="btn btn-sm btn-warning" href="set_availability.php?doctor_id=<?php echo $d['id']; ?>">
                                <i class="bi bi-calendar-check"></i> Set Availability
                            </a>
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
