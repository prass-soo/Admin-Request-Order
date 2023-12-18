<?php
session_name('admin_session');
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: ../dashboard-admin-cs/login.php");
    exit;
}
require '../functions.php';

// Periksa koneksi database
if (!isset($conn) || !$conn) {
    die("Kesalahan koneksi database");
}

// Handle proses tambah request jika form tambah request di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $kodePlat = $_POST['kode_plat'];
        $nama = $_POST['nama'];
        $kodeBarang = $_POST['kode_barang'];
        $namaBarang = $_POST['nama_barang'];
        $telepon = $_POST['telepon'];
        $pesan = $_POST['pesan'];
        $note = $_POST['note'];

        // Jika tombol "Proses" ditekan, set id_status ke 2 (Proses)
        $id_status = 2; // Proses

        if (
            tambah([
                'kode_plat' => $kodePlat,
                'nama' => $nama,
                'kode_barang' => $kodeBarang,
                'nama_barang' => $namaBarang,
                'telepon' => $telepon,
                'pesan' => $pesan,
                'note' => $note,
                'id_status' => $id_status,
            ]) > 0
        ) {
            echo "
            <script>
            alert('Data berhasil ditambahkan!');
            document.location.href = '../dashboard-admin-cs/index.php';
            </script>
        ";
        } else {
            echo "
            <script>
            alert('Data gagal ditambahkan!');
            document.location.href = '../dashboard-admin-cs/index.php';
            </script>
        ";
        }
    }
}
