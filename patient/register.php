<?php include '../navbar.php'; ?>
<?php
// patient/register.php
include __DIR__ . '/../db.php';
$err = '';
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $contact = trim($_POST['contact']);
    $address = trim($_POST['address']);
    $gender = trim($_POST['gender']); // ADDED THIS LINE
    $age = trim($_POST['age']);       // ADDED THIS LINE

    // Updated the SQL query to include gender and age
    $stmt = $conn->prepare('INSERT INTO patients (name,email,password,contact,address,gender,age) VALUES (?,?,?,?,?,?,?)');
    
    // Updated bind_param to include the new variables and their types ('ss' for gender and age)
    $stmt->bind_param('ssssssi', $name, $email, $password, $contact, $address, $gender, $age); // UPDATED THIS LINE

    if ($stmt->execute()) {
        header('Location: login.php?msg=registered');
        exit;
    } else {
        $err = 'Error: ' . $stmt->error;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Patient Register</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<style>
    body {
        background: linear-gradient(135deg, #54c5dbff, #90e0ef);
        font-family: 'Segoe UI', sans-serif;
    }
    .register-card {
        max-width: 450px;
        margin: auto;
        margin-top: 60px;
        background: #fff;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0px 5px 20px rgba(0,0,0,0.15);
    }
    .register-card h3 {
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
        margin-top: 20px;
        text-decoration: none;
        color:black;
        size: 20px;
    }
</style>
    <link rel="stylesheet" href="/clinic/styles.css">
</head>
<body>

<div class="register-card">
    <h3><i class="bi bi-person-plus-fill"></i> Patient Registration</h3>
    <?php if($err) echo "<div class='alert alert-danger'>$err</div>"; ?>
    <form method="post">
        <div class="mb-3 position-relative">
            <i class="bi bi-person-fill input-icon"></i>
            <input name="name" class="form-control" placeholder="Full Name" required>
        </div>
        <div class="mb-3 position-relative">
            <i class="bi bi-envelope-fill input-icon"></i>
            <input name="email" type="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="mb-3 position-relative">
            <i class="bi bi-lock-fill input-icon"></i>
            <input name="password" type="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="mb-3 position-relative">
            <i class="bi bi-telephone-fill input-icon"></i>
            <input name="contact" class="form-control" placeholder="Contact">
        </div>
        <div class="mb-3 position-relative">
            <i class="bi bi-house-fill input-icon"></i>
            <textarea name="address" class="form-control" placeholder="Address"></textarea>
        </div>
        
        <div class="mb-3 position-relative">
            <i class="bi bi-calendar-event-fill input-icon"></i>
            <input name="age" type="number" class="form-control" placeholder="Age" required>
        </div>

        <div class="mb-3 position-relative">
            <i class="bi bi-gender-ambiguous input-icon"></i>
            <select name="gender" class="form-control" required style="padding-left: 40px;">
                <option value="" disabled selected>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <button class="btn btn-success w-100"><i class="bi bi-check-circle-fill"></i> Register</button>
        <a class="link" href="login.php" >Already have an account? Login</a>
    </form>
</div>

</body>
</html>