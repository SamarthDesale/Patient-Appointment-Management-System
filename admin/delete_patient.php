<?php 
include 'admin_auth.php'; 
include __DIR__ . '/../db.php'; $id=intval($_GET['id']??0);
if($id){ $stmt=$conn->prepare('DELETE FROM patients WHERE id=?'); 
$stmt->bind_param('i',$id); $stmt->execute(); 
} 
header('Location: manage_patients.php'); exit; ?>