<?php
session_name('admin_session');
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: ../dashboard-admin-cs/login.php");
    exit;
}
require '../functions.php';

if (isset($_GET["id"])) {
    $id_pesanan = $_GET["id"];

    // Cek apakah pesanan ada dalam status "Proses"
    $status_proses = 2; // Sesuaikan dengan ID status "Proses" pada database Anda
    $query = "SELECT * FROM customer WHERE id = $id_pesanan AND id_status = $status_proses";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Hapus pesanan dari database
        $delete_query = "DELETE FROM customer WHERE id = $id_pesanan";
        if (mysqli_query($conn, $delete_query)) {
            echo "success"; // Berhasil menghapus pesanan
        } else {
            echo "error"; // Gagal menghapus pesanan
        }
    } else {
        echo "not_found"; // Pesanan tidak ditemukan atau tidak dalam status "Proses"
    }
} else {
    echo "invalid_request"; // Permintaan tidak valid (ID pesanan tidak ada)
}
