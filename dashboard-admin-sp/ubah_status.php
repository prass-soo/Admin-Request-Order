<?php
session_name('sparepart_session');
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: ../dashboard-admin-sp/login.php");
    exit;
}
require '../functions.php';

// cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username dan id_akses berdasarkan id
    $result = mysqli_query($conn, "SELECT username, id_akses FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie, username, dan id_akses
    if ($key === hash('sha256', $row['username']) && $row['id_akses'] == 2) {
        $_SESSION['login'] = true;
        $_SESSION['id_akses'] = $row['id_akses'];
        $_SESSION['username'] = $row['username'];
        header("Location: ./index.php"); // Ganti dengan halaman yang sesuai
        exit;
    }
}

if (isset($_GET["id"]) && isset($_GET["status"])) {
    $id = $_GET["id"];
    $status = $_GET["status"];

    $query = "UPDATE customer SET id_status = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $status, $id);

    if ($stmt->execute()) {
        // Jika berhasil, beri tahu user dan arahkan kembali ke index.php dalam 0 detik
        echo '<script>alert("Status berhasil diubah.");</script>';
        echo '<meta http-equiv="refresh" content="0;url=../dashboard-admin-sp/index.php">';
        exit;
    } else {
        // Jika gagal, beri tahu user dan arahkan kembali ke index.php dalam 0 detik
        echo '<script>alert("Gagal mengubah status.");</script>';
        echo '<meta http-equiv="refresh" content="0 ;url=../dashboard-admin-sp/index.php">';
        exit;
    }
} else {
    echo "Parameter id dan status tidak valid.";
    exit;
}
if ($status == 3) {
    // Update tanggal_ready dengan tanggal saat ini
    $tanggal_ready = date("Y-m-d");
    $query = "UPDATE customer SET id_status = $status, ready = '$tanggal_ready' WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        echo "success";
    } else {
        echo "error";
    }
}
