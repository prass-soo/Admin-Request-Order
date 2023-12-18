<?php
session_name('sparepart_session');
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: ../dashboard-admin-sp/login.php");
    exit;
}
require '../functions.php';

$SPAdmin = query("SELECT * FROM customer ORDER BY id DESC");

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

<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col"><span class="icon"><i class="fa fa-long-arrow-down"></i></span> No.</th>
            <th scope="col"><span class="icon"><i class="fas fa-user"></i></span> Nama Customer</th>
            <th scope="col"><span class="icon"><i class="fas fa-check-circle"></i></span> Status</th>
            <th scope="col"><span class="icon"><i class="fas fa-sticky-note"></i></span> Catatan</th>
            <th scope="col"><span class="icon"><i class="fa fa-file"></i></span> Gambar</th>
            <th scope="col"><span class="icon"><i class="fa fa-wrench"></i></span> Option</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($SPAdmin as $row) : ?>
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
                        if ($row["id_status"] == 2 || $row["id_status"] == 3) {
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
                        <div class="d-flex justify-content-center mt-3">
                            <a href="../dashboard-admin-sp/ubah.php?id=<?= $row["id"]; ?>" class="btn btn-dark">
                                <i class="fas fa-edit"></i> Ubah
                            </a>
                            <a href="../dashboard-admin-sp/hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin Untuk Di Hapus?');" class="btn btn-dark ml-2">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                            <?php if ($row["id_status"] == 2) : ?>
                                <a href="../dashboard-admin-sp/ubah_status.php?id=<?= $row["id"]; ?>&status=3" class="btn btn-success ml-2">
                                    <i class="fas fa-check-circle"></i> Ready
                                </a>
                            <?php else : ?>
                                <a href="#" class="btn btn-success ml-2 disabled" aria-disabled="true">
                                    <i class="fas fa-check-circle"></i> Ready
                                </a>
                            <?php endif; ?>
                        </div>
                    </td>
                </div>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </tbody>
</table>