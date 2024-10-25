<?php
session_name('sparepart_session');
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: ../dashboard-admin-sp/login.php");
    exit;
}
require '../functions.php';
// ambil data di URL
$id = $_GET["id"];
// query data customer berdasarkan id
$customer = query("SELECT * FROM customer WHERE id = $id")[0];

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST['submit'])) {
    $data = [
        "id" => $_POST["id"],
        "ready" => $_POST["ready"],
        "note" => $_POST["note"]
    ];

    if (ubahnote($data) > 0) {
        echo "
            <script>
            alert('Data berhasil diubah!');
            document.location.href = '../dashboard-admin-sp/index.php';
            </script>
        ";
    } else {
        echo "
            <script>
            alert('Data gagal diubah!');
            document.location.href = '../dashboard-admin-sp/index.php';
            </script>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://startbootstrap.github.io/startbootstrap-sb-admin-2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/sb-admin-2.min.css">
    <link rel="icon" type="image/png" href="../assets/img/logoKali.png">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body id="page-top">

    <div id="wrapper">

        <?php include '../dashboard-admin-sp/sidebar.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include '../dashboard-admin-sp/topbar.php'; ?>

                <div class="container-fluid">

                    <div class="container-main">
                        <div class="container-fluid">

                            <!-- Content Row -->
                            <div class="row">

                                <!-- Area Chart -->
                                <div class="col-xl-12 col-lg-12">
                                    <div class="card shadow mb-4">
                                        <!-- Card Header - Dropdown -->
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold" style="color: #000;">UPDATE REQUEST</h6>
                                        </div>
                                        <!-- Card Body -->
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="id" value="<?= $customer["id"]; ?>">
                                                <div class="row">
                                                    <!-- Form Group - Field Kiri -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="note">Note:</label>
                                                            <textarea class="form-control" name="note" id="note" rows="3"><?= $customer["note"]; ?></textarea>
                                                        </div>
                                                    </div>

                                                    <!-- Form Group - Field Kanan -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="ready">Tanggal Barang Tersedia</label>
                                                            <input type="date" class="form-control" name="ready" id="ready" value="<?= $customer["ready"]; ?>">
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Submit Button -->
                                                <div class="submit-button mt-3">
                                                    <button type="submit" name="submit" class="btn btn-primary">
                                                        <i class="fas fa-save"></i> Simpan Data
                                                    </button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- ... (Script tags) ... -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
        <script src="../assets/vendor/jquery/jquery.min.js"></script>
        <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="../assets/js/sb-admin-2.min.js"></script>
</body>

</html>