<?php
session_name('admin_session');
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: ../dashboard-admin-cs/login.php");
    exit;
}
require '../functions.php';
// Pastikan tombol unggah ditekan
if (isset($_POST["upload"])) {
    $gambar = $_FILES["gambar"]["tmp_name"];
    $gambarData = file_get_contents($gambar);

    // Simpan data gambar ke dalam database
    $sql = "UPDATE customer SET id_gambar = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("bi", $gambarData, $id);

    if ($stmt->execute()) {
        // Gambar berhasil diunggah
        echo "Gambar berhasil diunggah.";
    } else {
        // Kesalahan saat mengunggah gambar
        echo "Terjadi kesalahan saat mengunggah gambar.";
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();
}
