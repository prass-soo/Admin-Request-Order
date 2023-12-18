<?php
session_name('admin_session');
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: ../dashboard-admin-cs/login.php");
    exit;
}

require '../functions.php';

if (isset($_GET["id"]) && isset($_GET["status"])) {
    $id = $_GET["id"];
    $status = $_GET["status"];

    $query = "UPDATE customer SET id_status = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $status, $id);

    if ($stmt->execute()) {
        // Jika berhasil, beri tahu user dan arahkan kembali ke index.php dalam 0 detik
        echo '<script>alert("Status berhasil diubah.");</script>';
        echo '<meta http-equiv="refresh" content="0;url=../dashboard-admin-cs/index.php">';
        exit;
    } else {
        // Jika gagal, beri tahu user dan arahkan kembali ke index.php dalam 0 detik
        echo '<script>alert("Gagal mengubah status.");</script>';
        echo '<meta http-equiv="refresh" content="0 ;url=../dashboard-admin-cs/index.php">';
        exit;
    }
} else {
    echo "Parameter id dan status tidak valid.";
    exit;
}
