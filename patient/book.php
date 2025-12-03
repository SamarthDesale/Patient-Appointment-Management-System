<?php
include '../db.php';
session_start();

// Ensure patient is logged in
if (!isset($_SESSION['patient_id'])) {
    header("Location: login.php");
    exit();
}

$patient_id = $_SESSION['patient_id'];

// Handle booking form submission
if (isset($_POST['book_slot'])) {
    $doctor_id = $_POST['doctor_id'];
    $date = $_POST['appointment_date'];
    $time = $_POST['appointment_time'];

    // Insert new appointment
    $sql = "INSERT INTO appointments (doctor_id, patient_id, appointment_date, appointment_time)
            VALUES ('$doctor_id', '$patient_id', '$date', '$time')";
    if (mysqli_query($conn, $sql)) {
        $successMsg = "Appointment booked successfully!";
    } else {
        $errorMsg = "Error: " . mysqli_error($conn);
    }
}

// Fetch doctors list
$doctors = mysqli_query($conn, "SELECT * FROM doctors");

// Utility function to generate time slots
function generateSlots($start, $end, $interval = '30') {
    $slots = [];
    $startTime = strtotime($start);
    $endTime = strtotime($end);
    while ($startTime < $endTime) {
        $slots[] = date("H:i:s", $startTime);
        $startTime = strtotime("+$interval minutes", $startTime);
    }
    return $slots;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Book Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="text-primary mb-4">
                <i class="bi bi-calendar-plus"></i> Book Appointment
            </h3>

            <?php if (!empty($successMsg)) { ?>
                <div class="alert alert-success"><i class="bi bi-check-circle"></i> <?php echo $successMsg; ?></div>
            <?php } ?>
            <?php if (!empty($errorMsg)) { ?>
                <div class="alert alert-danger"><i class="bi bi-exclamation-triangle"></i> <?php echo $errorMsg; ?></div>
            <?php } ?>

            <!-- Back Button -->
            <div class="mb-3">
                <a href="dashboard.php" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>

            <!-- Doctor & Date Selection Form -->
            <form method="POST" class="border rounded p-3 bg-light mb-4">
                <div class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label">Select Doctor</label>
                        <select name="doctor_id" class="form-select" required>
                            <option value="">-- Select Doctor --</option>
                            <?php while ($doc = mysqli_fetch_assoc($doctors)) { ?>
                                <option value="<?php echo $doc['id']; ?>"
                                    <?php if (!empty($_POST['doctor_id']) && $_POST['doctor_id'] == $doc['id']) echo "selected"; ?>>
                                    <?php echo htmlspecialchars($doc['name']); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Select Date</label>
                        <input type="date" name="appointment_date" value="<?php echo $_POST['appointment_date'] ?? ''; ?>" class="form-control" required onchange="this.form.submit()">
                    </div>
                </div>
            </form>

            <?php
            // Show available slots only if doctor & date selected
            if (isset($_POST['doctor_id']) && isset($_POST['appointment_date'])) {
                $doctor_id = $_POST['doctor_id'];
                $date = $_POST['appointment_date'];
                $dayOfWeek = date('l', strtotime($date)); // Monday, Tuesday, etc.

                // Check if doctor is unavailable (leave/emergency)
                $leaveCheck = mysqli_query($conn, "SELECT * FROM doctor_unavailability 
                                                    WHERE doctor_id='$doctor_id' AND date='$date'");
                if (mysqli_num_rows($leaveCheck) > 0) {
                    echo "<div class='alert alert-danger'><i class='bi bi-x-octagon'></i> Doctor is not available on this date.</div>";
                } else {
                    // Fetch doctor availability for that weekday
                    $avail = mysqli_query($conn, "SELECT * FROM doctor_availability 
                                                  WHERE doctor_id='$doctor_id' AND day_of_week='$dayOfWeek'");
                    if (mysqli_num_rows($avail) == 0) {
                        echo "<div class='alert alert-warning'><i class='bi bi-exclamation-circle'></i> Doctor has no availability on $dayOfWeek.</div>";
                    } else {
                        $row = mysqli_fetch_assoc($avail);
                        $allSlots = generateSlots($row['start_time'], $row['end_time']);

                        // Remove already booked slots
                        $booked = mysqli_query($conn, "SELECT appointment_time FROM appointments 
                                                       WHERE doctor_id='$doctor_id' AND appointment_date='$date'");
                        $bookedSlots = [];
                        while ($b = mysqli_fetch_assoc($booked)) {
                            $bookedSlots[] = $b['appointment_time'];
                        }

                        $freeSlots = array_diff($allSlots, $bookedSlots);

                        if (empty($freeSlots)) {
                            echo "<div class='alert alert-danger'><i class='bi bi-calendar-x'></i> No available slots for this date.</div>";
                        } else {
                            // Back button above time slot form
                            echo "<div class='mb-3'>
                                    <a href='book_appointment.php' class='btn btn-secondary'>
                                        <i class='bi bi-arrow-left'></i> Back
                                    </a>
                                  </div>";

                            echo "<form method='POST' class='border rounded p-3 bg-light'>";
                            echo "<input type='hidden' name='doctor_id' value='$doctor_id'>";
                            echo "<input type='hidden' name='appointment_date' value='$date'>";

                            echo "<div class='row g-3 align-items-end'>";
                            echo "<div class='col-md-6'>";
                            echo "<label class='form-label'>Select Time Slot</label>";
                            echo "<select name='appointment_time' class='form-select' required>";
                            foreach ($freeSlots as $slot) {
                                echo "<option value='$slot'>" . date('h:i A', strtotime($slot)) . "</option>";
                            }
                            echo "</select>";
                            echo "</div>";
                            echo "<div class='col-md-3'>";
                            echo "<button type='submit' name='book_slot' class='btn btn-success w-100'><i class='bi bi-check-circle'></i> Book Appointment</button>";
                            echo "</div>";
                            echo "</div>";

                            echo "</form>";
                        }
                    }
                }
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>
