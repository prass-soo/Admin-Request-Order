<?php
session_name('admin_session');
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: ../dashboard-admin-cs/login.php");
    exit;
}
require '../functions.php';

$admin = query("SELECT * FROM customer ORDER BY id ASC");

$dataBerhasil = mysqli_query($conn, "SELECT * FROM customer WHERE id_status = 1");

function getStatusName($id_status)
{
    global $conn;
    $query = "SELECT nama_status FROM status WHERE id_status = $id_status";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['nama_status'];
    } else {
        return 'Status Tidak Diketahui'; // Ubah pesan ini sesuai kebutuhan
    }
}

// Tombol cari ditekan
if (isset($_POST["cari"])) {
    $admin = cari($_POST["keyword"]);
}
function getStatusBadgeClass($statusId)
{
    // Atur kelas sesuai dengan nilai status
    switch ($statusId) {
        case 1: // Sukses
            return 'bg-success text-white'; // Latar hijau dengan teks putih
        case 2: // Menunggu
            return 'bg-dark text-white'; // Latar kuning dengan teks hitam
        case 3: // Berhasil
            return 'bg-primary text-white'; // Latar biru dengan teks putih
        case 4: // Batal
            return 'bg-danger text-white'; // Latar merah dengan teks putih
        default:
            return 'bg-secondary text-white'; // Latar abu-abu dengan teks putih (atau kelas default lainnya)
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://startbootstrap.github.io/startbootstrap-sb-admin-2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/sb-admin-2.min.css">
    <link rel="icon" type="image/png" href="../assets/img/logoKali.png">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body id="page-top">

    <div id="wrapper">

        <?php include '../dashboard-admin-cs/sidebar.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include '../dashboard-admin-cs/topbar.php'; ?>

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h4 mb-4 text-gray-800">Daftar Permintaan Selesai</h1>

                    <div class="container-main">
                        <div class="container-fluid">

                            <!-- Content Row -->
                            <div class="row">

                                <!-- Area Chart -->
                                <div class="col-xl-12 col-lg-12">
                                    <div class="card shadow mb-4">
                                        <!-- Card Header - Dropdown -->
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold" style="color: #000;">DATA REQUEST</h6>
                                        </div>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <!-- Search Form -->
                                            <div class="search-form mt-3 mb-3">
                                                <form action="" method="post">
                                                    <div class="input-group">
                                                        <input type="text" name="keyword" class="form-control" id="keyword" placeholder="Masukkan Pencarian..." autocomplete="off">
                                                        <div class="input-group-append">
                                                            <button type="submit" name="cari" id="tombol-cari" class="btn text-light" style="background-color: #000;">
                                                                <i class="fa fa-search"></i>
                                                                Cari
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- Data Table -->
                                            <div id="contain">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col"><span class="icon"><i class="fa fa-long-arrow-down"></i></span>No.</th>
                                                            <th scope="col"><span class="icon"><i class="fas fa-user"></i></span>Nama Customer</th>
                                                            <th scope="col"><span class="icon"><i class="fas fa-check-circle"></i></span>Status</th>
                                                            <th scope="col"><span class="icon"><i class="fas fa-sticky-note"></i></span>Catatan</th>
                                                            <th scope="col"><span class="icon"><i class="fa fa-file"></i></span>Gambar</th>
                                                            <th scope="col"><span class="icon"><i class="fa fa-wrench"></i></span>Option</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($admin as $row) : ?>
                                                            <tr>
                                                                <div class="images">
                                                                    <td><?= $i; ?></td>
                                                                    <td>
                                                                        <a href="#" class="customer-detail" data-id="<?= $row["id"]; ?>">
                                                                            <?= $row["nama"]; ?>
                                                                        </a>

                                                                    </td>
                                                                    <td>
                                                                        <span class="badge badge-lg <?= getStatusBadgeClass($row["id_status"]); ?>">
                                                                            <?= getStatusName($row["id_status"]); ?>
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                        if ($row["id_status"] == 2 || $row["id_status"] == 3 || $row["id_status"] == 1) {
                                                                            echo '<a href="#" onclick="showNoteModal(this)" style="color: kadetblue;" data-note="' . $row["note"] . '">';
                                                                            echo '<i class="fas fa-sticky-note"></i>';
                                                                            echo "<p class='klik' style='display: inline;'>Klik Note</p>";
                                                                            echo '</a>';
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <a href="#" onclick="showImageModal('<?= $row['gambar']; ?>')" style="color: kadetblue;">
                                                                            <i class="fas fa-images"></i>
                                                                            <p class="klik" style="display: inline;">Klik Gambar</p>
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        <div class="d-flex justify-content-center">
                                                                            <a href="./dashboard-admin-cs/hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin Untuk Di Hapus?');" class="btn btn-danger">
                                                                                <i class="fas fa-trash"></i> Hapus
                                                                            </a>
                                                                        </div>

                                                                    </td>
                                                                </div>
                                                            </tr>
                                                            <?php $i++; ?>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Note -->
        <div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="noteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h5 class="modal-title text-light" id="noteModalLabel">Show Note</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="noteModalContent">
                        <!-- Content here -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Image -->
        <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h5 class="modal-title text-light" id="imageModalLabel">Show Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="" alt="Image" id="imageModalImage" style="max-width: 100%; max-height: 100%;">
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Modal -->
        <div class="modal fade" id="customerDetailModal" tabindex="-1" role="dialog" aria-labelledby="customerDetailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h5 class="modal-title text-light" id="customerDetailModalLabel">Show Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="customerDetailContent">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-2"><span class="icon"><i class="fas fa-id-card"></i></span>Kode Plat: <span id="detail_kodePlat"></span></p>
                                <p class="mb-2"><span class="icon"><i class="fas fa-user"></i></span>Nama Customer: <span id="detail_nama"></span></p>
                                <p class="mb-2"><span class="icon"><i class="fas fa-graduation-cap"></i></span>Kode Barang: <span id="detail_kodeBarang"></span></p>
                                <p class="mb-2"><span class="icon"><i class="fas fa-venus-mars"></i></span>Nama Barang: <span id="detail_namaBarang"></span></p>
                                <p class="mb-2"><span class="icon"><i class="fas fa-birthday-cake"></i></span>Nomor Telepon: <span id="detail_telepon"></span></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2"><span class="icon"><i class="fas fa-phone"></i></span>Tanggal Pemesanan: <span id="detail_pesan"></span></p>
                                <p class="mb-2"><span class="icon"><i class="fas fa-calendar"></i></span>Tanggal Ready: <span id="detail_ready"></span></p>
                                <p class="mb-2"><span class="icon"><i class="fas fa-sticky-note"></i></span>Note: <span id="detail_note"></span></p>
                                <p class="mb-2"><span class="icon"><i class="fas fa-check-circle"></i></span>Status: <span id="detail_status"></span></p>
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
        <script src="../assets/js/endcustom.js"></script>
</body>

</html>