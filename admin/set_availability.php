<?php
include '../db.php';
session_start();

// Ensure admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$doctor_id = $_GET['doctor_id'] ?? null;
if (!$doctor_id) {
    echo "Invalid doctor ID.";
    exit();
}

// Fetch doctor info
$doctor = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM doctors WHERE id='$doctor_id'"));

// Add weekly availability
if (isset($_POST['add_availability'])) {
    $day = $_POST['day_of_week'];
    $start = $_POST['start_time'];
    $end = $_POST['end_time'];

    $sql = "INSERT INTO doctor_availability (doctor_id, day_of_week, start_time, end_time) 
            VALUES ('$doctor_id', '$day', '$start', '$end')";
    mysqli_query($conn, $sql);
    header("Location: set_availability.php?doctor_id=$doctor_id");
    exit();
}

// Block leave/emergency date
if (isset($_POST['add_unavailability'])) {
    $date = $_POST['date'];
    $reason = $_POST['reason'];

    $sql = "INSERT INTO doctor_unavailability (doctor_id, date, reason) 
            VALUES ('$doctor_id', '$date', '$reason')";
    mysqli_query($conn, $sql);
    header("Location: set_availability.php?doctor_id=$doctor_id");
    exit();
}

// Delete availability
if (isset($_GET['delete_avail'])) {
    $id = $_GET['delete_avail'];
    mysqli_query($conn, "DELETE FROM doctor_availability WHERE id='$id'");
    header("Location: set_availability.php?doctor_id=$doctor_id");
    exit();
}

// Delete unavailability
if (isset($_GET['delete_unavail'])) {
    $id = $_GET['delete_unavail'];
    mysqli_query($conn, "DELETE FROM doctor_unavailability WHERE id='$id'");
    header("Location: set_availability.php?doctor_id=$doctor_id");
    exit();
}

// Fetch current schedules
$availabilities = mysqli_query($conn, "SELECT * FROM doctor_availability WHERE doctor_id='$doctor_id'");
$unavailabilities = mysqli_query($conn, "SELECT * FROM doctor_unavailability WHERE doctor_id='$doctor_id'");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Set Availability - <?php echo htmlspecialchars($doctor['name']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="card-title text-primary">
                <i class="bi bi-calendar-check"></i> Set Availability for Dr. <?php echo htmlspecialchars($doctor['name']); ?>
            </h3>
            <a href="manage_doctors.php" class="btn btn-secondary btn-sm mb-3">
                <i class="bi bi-arrow-left"></i> Back to Manage Doctors
            </a>

            <!-- Weekly Availability Form -->
            <form method="POST" class="mb-4 border rounded p-3 bg-light">
                <h5 class="text-success"><i class="bi bi-clock-history"></i> Add Weekly Availability</h5>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Day of Week</label>
                        <select name="day_of_week" class="form-select" required>
                            <option>Monday</option><option>Tuesday</option><option>Wednesday</option>
                            <option>Thursday</option><option>Friday</option><option>Saturday</option><option>Sunday</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Start Time</label>
                        <input type="time" name="start_time" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">End Time</label>
                        <input type="time" name="end_time" class="form-control" required>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" name="add_availability" class="btn btn-success w-100">
                            <i class="bi bi-plus-circle"></i> Add
                        </button>
                    </div>
                </div>
            </form>

            <!-- Unavailability Form -->
            <form method="POST" class="mb-4 border rounded p-3 bg-light">
                <h5 class="text-danger"><i class="bi bi-exclamation-octagon"></i> Block Date (Leave/Emergency)</h5>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Reason</label>
                        <input type="text" name="reason" class="form-control" placeholder="Optional">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" name="add_unavailability" class="btn btn-warning w-100">
                            <i class="bi bi-ban"></i> Block
                        </button>
                    </div>
                </div>
            </form>

            <!-- Show Current Availability -->
            <h5 class="text-primary"><i class="bi bi-list-check"></i> Current Weekly Availability</h5>
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr><th>Day</th><th>Start</th><th>End</th><th>Action</th></tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($availabilities)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['day_of_week']); ?></td>
                        <td><?php echo htmlspecialchars($row['start_time']); ?></td>
                        <td><?php echo htmlspecialchars($row['end_time']); ?></td>
                        <td>
                            <a href="set_availability.php?doctor_id=<?php echo $doctor_id; ?>&delete_avail=<?php echo $row['id']; ?>" 
                               class="btn btn-sm btn-danger" onclick="return confirm('Delete this availability?');">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

            <!-- Show Blocked Dates -->
            <h5 class="text-danger mt-4"><i class="bi bi-calendar-x"></i> Blocked Dates</h5>
            <table class="table table-striped table-hover">
                <thead class="table-danger">
                    <tr><th>Date</th><th>Reason</th><th>Action</th></tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($unavailabilities)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['date']); ?></td>
                        <td><?php echo htmlspecialchars($row['reason']); ?></td>
                        <td>
                            <a href="set_availability.php?doctor_id=<?php echo $doctor_id; ?>&delete_unavail=<?php echo $row['id']; ?>" 
                               class="btn btn-sm btn-danger" onclick="return confirm('Delete this blocked date?');">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

</body>
</html>
