<?php include '../navbar.php'; ?>
<?php 
include 'admin_auth.php'; 
include __DIR__ . '/../db.php'; 
$res = $conn->query('SELECT * FROM patients ORDER BY name'); 
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Patients</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="/clinic/styles.css">
<style>
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
    .search-box {
        max-width: 300px;
    }
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
</style>
<script>
function filterPatients() {
    let input = document.getElementById("patientSearch").value.toLowerCase();
    let rows = document.querySelectorAll("#patientTable tr");
    rows.forEach(row => {
        let name = row.querySelector("td").innerText.toLowerCase();
        row.style.display = name.includes(input) ? "" : "none";
    });
}
</script>
</head>

<body>
<div class="container py-4">

   
   <div class="container py-4">
    <a href="admin_dashboard.php" class="btn btn-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Back to Dashboard
    </a>


    <div class="card p-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
            <h3 class="mb-0"><i class="bi bi-people"></i> Patients</h3>
            <div class="d-flex gap-2">
                <input type="text" id="patientSearch" onkeyup="filterPatients()" class="form-control search-box" placeholder="Search by name">
                <a class="btn btn-success" href="add_patient.php">
                    <i class="bi bi-person-plus"></i> Add Patient
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover mt-2">
                <thead class="table-primary">
                    <tr>
                        <th><i class="bi bi-person"></i> Name</th>
                        <th><i class="bi bi-envelope"></i> Email</th>
                        <th><i class="bi bi-telephone"></i> Contact</th>
                        <th><i class="bi bi-gear"></i> Actions</th>
                    </tr>
                </thead>
                <tbody id="patientTable">
                    <?php while($p = $res->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($p['name']); ?></td>
                        <td><?php echo htmlspecialchars($p['email']); ?></td>
                        <td><?php echo htmlspecialchars($p['contact']); ?></td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="edit_patient.php?id=<?php echo $p['id']; ?>">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <a class="btn btn-sm btn-danger" href="delete_patient.php?id=<?php echo $p['id']; ?>" onclick="return confirm('Delete patient?')">
                                <i class="bi bi-trash"></i> Delete
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
