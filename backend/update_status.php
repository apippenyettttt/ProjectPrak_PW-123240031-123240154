<?php
session_start();
include __DIR__ . '/../config/database.php';

//hanya admin yang bisa masuk
if(!isset($_SESSION['id_user']) || $_SESSION['role']!=admin){
    header("Location: login.php");
    exit();
}

$id_pendaftaran = $_POST['id_pendaftaran'];
$status_daftar + $_POST['status_daftar'];
$no_bib = $_POST['no_bib'];

//update status & no BIB
$sql = "UPDATE pendaftaran
        SET status_daftar='status_daftar', no_bib='$no_bib'
        WHERE id_pendaftaran='$id_pendaftaran'";

if($conn->query($sql)){
    echo "<script>alert('Data berhasil diperbarui!'); window.location='../pages/admin.php';</script>";
}else{
    die('Query error: ' . $conn->error);
}
?>