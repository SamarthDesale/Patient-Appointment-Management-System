<?php include '../navbar.php'; ?>
<?php
session_start();
include __DIR__ . '/../db.php'; // adjust path if needed

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Fetch admin
    $stmt = $conn->prepare("SELECT id, password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // If admin exists
    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // CASE 1: No password yet — first-time login
        if (empty($row['password'])) {
            if (!empty($password)) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $update = $conn->prepare("UPDATE admins SET password = ? WHERE id = ?");
                $update->bind_param("si", $hashedPassword, $row['id']);
                $update->execute();
                $success = "Password set successfully! Please log in.";
            } else {
                $error = "Please enter a password to set for your account.";
            }
        }
        // CASE 2: Password exists — normal login
        else {
            if (password_verify($password, $row['password'])) {
                $_SESSION['admin_id'] = $row['id'];
                $_SESSION['admin_user'] = $username;
                header("Location: admin_dashboard.php");
                exit;
            } else {
                $error = "Invalid password.";
            }
        }
    } else {
        $error = "Admin username not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: linear-gradient(135deg, #63c6d9ff, #90e0ef);
            font-family: 'Segoe UI', sans-serif;
        }
        .login-card {
            max-width: 400px;
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0px 5px 20px rgba(0,0,0,0.15);
            margin: auto;
            margin-top: 80px;
        }
        .login-card h3 {
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
        .btn-primary {
            background: #0077b6;
            border: none;
        }
        .btn-primary:hover {
            background: #023e8a;
        }
        .msg {
            text-align: center;
            font-size: 0.9rem;
        }
    </style>
    <link rel="stylesheet" href="/clinic/styles.css">
</head>
<body>

<div class="login-card">
    <h3><i class="bi bi-shield-lock-fill"></i> Admin Login</h3>

    <?php if ($error) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <?php if ($success) echo "<div class='alert alert-success'>$success</div>"; ?>

    <form method="POST">
        <div class="mb-3 position-relative">
            <i class="bi bi-person-fill input-icon"></i>
            <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="mb-3 position-relative">
            <i class="bi bi-lock-fill input-icon"></i>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100"><i class="bi bi-box-arrow-in-right"></i> Login </button>
    </form>
</div>

</body>
</html>
