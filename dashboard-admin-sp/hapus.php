<?php
session_name('sparepart_session');
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: ../dashboard-admin-sp/login.php");
    exit;
}
require '../functions.php';
$id = $_GET["id"];
if (hapus($id) > 0) {
    echo "
                <script>
                alert('Data Berhasil Dihapus');
                document.location.href = 'index.php';
                </script>
        ";
} else {
    echo "
                <script>
                alert('data gagal dihapus!');
                document.location.href = 'index.php';
                </script>
            ";
}
