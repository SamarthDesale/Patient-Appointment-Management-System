<?php include '../navbar.php'; ?>
<?php
// patient/login.php
session_start();
include __DIR__ . '/../db.php';

$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']); 
    $password = $_POST['password'];

    $stmt = $conn->prepare('SELECT id,name,password FROM patients WHERE email=?'); 
    $stmt->bind_param('s', $email);
    $stmt->execute(); 
    $res = $stmt->get_result();

    if ($res->num_rows === 1) {
        $row = $res->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['patient_id'] = $row['id'];
            $_SESSION['patient_name'] = $row['name'];
            header('Location: dashboard.php'); 
            exit;
        } else {
            $err = 'Invalid credentials.';
        }
    } else {
        $err = 'User not found.';
    }
}
$msg = $_GET['msg'] ?? '';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Patient Login</title>
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
    .link {
        text-align: center;
        display: block;
        margin-top: 20px;
        text-decoration: none;
        color: black;
    }
</style>
    <link rel="stylesheet" href="/clinic/styles.css">
</head>
<body>

<div class="login-card">
    <h3><i class="bi bi-box-arrow-in-right"></i> Patient Login</h3>

    <?php if ($msg === 'registered') echo "<div class='alert alert-success'>Registered successfully. Please login.</div>"; ?>
    <?php if ($err) echo "<div class='alert alert-danger'>$err</div>"; ?>

    <form method="post">
        <div class="mb-3 position-relative">
            <i class="bi bi-envelope-fill input-icon"></i>
            <input name="email" type="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="mb-3 position-relative">
            <i class="bi bi-lock-fill input-icon"></i>
            <input name="password" type="password" class="form-control" placeholder="Password" required>
        </div>
        <button class="btn btn-primary w-100"><i class="bi bi-box-arrow-in-right"></i> Login</button>
        <a class="link" href="register.php">Don't have an account? Register</a>
    </form>
</div>

</body>
</html>
