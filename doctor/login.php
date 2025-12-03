<?php
include '../db.php';
session_start();

// Redirect if already logged in
if (isset($_SESSION['doctor_id'])) {
    header("Location: doctor_dashboard.php");
    exit();
}

$error = '';

if (isset($_POST['login'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $error = "Please enter both email and password.";
    } else {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = $_POST['password'];

        // Check if email column exists
        $checkColumn = mysqli_query($conn, "SHOW COLUMNS FROM doctors LIKE 'email'");
        if (mysqli_num_rows($checkColumn) == 0) {
            $error = "Doctor login is not configured properly. Please contact admin.";
        } else {
            $query = "SELECT * FROM doctors WHERE email='$email' AND password='$password'";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) === 1) {
                $doctor = mysqli_fetch_assoc($result);
                $_SESSION['doctor_id'] = $doctor['id'];
                $_SESSION['doctor_name'] = $doctor['name'];
                header("Location: doctor_dashboard.php");
                exit();
            } else {
                $error = "Invalid email or password.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #54c5dbff, #90e0ef);
            font-family: 'Segoe UI', sans-serif;
        }
        .login-card {
            max-width: 400px;
            margin: auto;
            margin-top: 80px;
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0px 5px 20px rgba(0,0,0,0.15);
        }
        .login-card h4 {
            color: #0077b6;
            font-weight: 700;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-control {
            padding-left: 40px;
        }
        .input-icon {
            position: absolute;
            top: 10px;
            left: 12px;
            color: #0077b6;
        }
        .btn-success {
            background: #0077b6;
            border: none;
        }
        .btn-success:hover {
            background: #023e8a;
        }
        .link {
            text-align: center;
            display: block;
            margin-top: 15px;
            text-decoration: none;
            color:black;
        }
    </style>
</head>
<body>

<body>

<?php include '../navbar.php'; // go up one level from doctor/ ?>

<div class="login-card">
    <h4><i class="bi bi-person-circle"></i> Doctor Login</h4>
    <?php if($error) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="POST">
        <div class="mb-3 position-relative">
            <i class="bi bi-envelope-fill input-icon"></i>
            <input name="email" type="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="mb-3 position-relative">
            <i class="bi bi-lock-fill input-icon"></i>
            <input name="password" type="password" class="form-control" placeholder="Password" required>
        </div>
        <button type="submit" name="login" class="btn btn-success w-100"><i class="bi bi-box-arrow-in-right"></i> Login</button>
        <a class="link" href="../index.php">Back to Home</a>
    </form>
</div>

