<?php 
include '../navbar.php'; 
include 'admin_auth.php'; 
include __DIR__ . '/../db.php'; 

$msg = ''; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $name = $_POST['name']; 
    $email = $_POST['email']; 
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $contact = $_POST['contact']; 
    $address = $_POST['address']; 

    $stmt = $conn->prepare('INSERT INTO patients (name,email,password,contact,address) VALUES (?,?,?,?,?)'); 
    $stmt->bind_param('sssss', $name, $email, $password, $contact, $address); 

    if ($stmt->execute()) { 
        header('Location: manage_patients.php'); 
    } else { 
        $msg = 'Error: ' . $stmt->error; 
    } 
} 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Patient</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<style>
    body {
        background: #f0f3f6ff;
    }
    .card {
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .form-control:focus {
        box-shadow: 0 0 5px rgba(0,123,255,0.5);
        border-color: #80bdff;
    }
    .btn-success {
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }
    .btn-success:hover {
        background-color: #218838;
    }
 .back-btn {
    display: inline-block;
    text-decoration: none;
    font-size: 0.9rem;
    color: #000206ff;
    padding: 6px 12px;
    border-radius: 6px;
    background: rgba(13, 109, 253, 0.55);
    transition: all 0.3s ease;
}

.back-btn:hover {
    background: rgba(13, 109, 253, 0.41);
    color: #084298;
    text-decoration: none;
    transform: translateX(-2px);
}

</style>
</head>
<body>

<div class="container py-4">
    <a href="manage_patients.php" class="back-btn">&laquo; Back to Patients</a>

    <div class="row justify-content-center mt-3">
        <div class="col-md-6">
            <div class="card p-4">
                <h3 class="text-center mb-3">Add New Patient</h3>
                <?php if($msg) echo "<div class='alert alert-danger'>$msg</div>"; ?>

                <form method="post">
                    <div class="mb-3 input-group">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        <input name="name" class="form-control" placeholder="Full Name" required>
                    </div>
                    <div class="mb-3 input-group">
                        <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="mb-3 input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="mb-3 input-group">
                        <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                        <input name="contact" class="form-control" placeholder="Contact Number">
                    </div>
                    <div class="mb-3 input-group">
                        <span class="input-group-text"><i class="bi bi-geo-alt-fill"></i></span>
                        <textarea name="address" class="form-control" placeholder="Address"></textarea>
                    </div>
                    <button class="btn btn-success w-100 py-2">
                        <i class="bi bi-plus-circle"></i> Add Patient
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
