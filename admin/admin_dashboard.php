<?php include '../navbar.php'; ?>
<?php include 'admin_auth.php'; include __DIR__ . '/../db.php'; ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<style>
    body {
        background: #f8f9fa; /* A light gray background for a clean look */
        font-family: 'Segoe UI', sans-serif;
    }
    .navbar {
        background: #0d47a1; /* Deep blue navbar */
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.2);
    }
    .dashboard-container {
        max-width: 1000px;
        margin: auto;
        margin-top: 40px;
    }
    .card-option {
        border: 2px solid #000; /* Black border */
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        text-align: center;
        padding: 30px;
        text-decoration: none;
        font-weight: 600;
        color: #000; /* Black text */
        background-color: #b9f9afff; /* White background for the card */
        display: block;
        height: 100%;
    }
    .card-option i {
        font-size: 3rem;
        margin-bottom: 15px;
        display: block;
    }
    .card-option:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        text-decoration: none;
        background-color: #f1f1f1; /* Slight gray on hover */
    }
</style>
    <link rel="stylesheet" href="/clinic/styles.css">
</head>
<body>
<nav class="navbar navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Clinic Admin</a>
        <div class="text-white">
            Hello <?php echo htmlspecialchars($_SESSION['admin_user']); ?>
            <a class="btn btn-sm btn-outline-light ms-2" href="admin_logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </div>
    </div>
</nav>

<div class="container dashboard-container">
 <!-- <a href="index.php" class="text-decoration-none text-secondary mb-3 d-inline-block">
    <i class="bi bi-arrow-left"></i> Back to Home
</a> -->
    <h2 class="mb-5 text-dark"><i class="bi bi-speedometer2"></i> Admin Dashboard</h2>
    <div class="row g-4">
        <div class="col-md-4">
            <a class="card-option" href="manage_doctors.php">
                <i class="bi bi-person-badge"></i>
                <div>Manage Doctors</div>
            </a>
        </div>
        <div class="col-md-4">
            <a class="card-option" href="manage_patients.php">
                <i class="bi bi-people"></i>
                <div>Manage Patients</div>
            </a>
        </div>
        <div class="col-md-4">
            <a class="card-option" href="manage_appointments.php">
                <i class="bi bi-calendar-check"></i>
                <div>Manage Appointments</div>
            </a>
        </div>
    </div>
</div>
</body>
</html>