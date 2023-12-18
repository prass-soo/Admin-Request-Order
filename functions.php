<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "admin");


function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_array($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $conn;
    $kodePlat = htmlspecialchars($data["kode_plat"]);
    $nama = htmlspecialchars($data["nama"]);
    $kodeBarang = htmlspecialchars($data["kode_barang"]);
    $namaBarang = htmlspecialchars($data["nama_barang"]);
    $telepon = htmlspecialchars($data["telepon"]);
    $pesan = htmlspecialchars($data["pesan"]);
    $note = htmlspecialchars($data["note"]);

    $id_status = htmlspecialchars($data["id_status"]);

    $gambar = upload();
    if (!$gambar) {
        return false;
    }


    $query = "INSERT INTO customer 
                    VALUES
                    ('', '$kodePlat','$nama','$kodeBarang','$namaBarang','$telepon','$pesan','','$note', '$gambar','$id_status')
                    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if (!$error === 4) {
        echo "<script>
        alert('Pilih Gambar Terlebih dahulu');
        </script>";

        return false;
    }

    //cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', ''];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
        alert('Yang anda upload bukan gambar!');
        </script>";
        return false; // Menghentikan eksekusi jika bukan gambar
    }

    // cek jika ukurannya terlalu besar
    if ($ukuranFile > 30000000) {
        echo "<script>
        alert('ukuran gambar terlalu besar!');
        </script>";
        return false; // Menghentikan eksekusi jika gambar terlalu besar
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../img/' . $namaFileBaru);
    return $namaFileBaru;
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM customer where id = $id");

    return mysqli_affected_rows($conn);
}

function ubah($data)
{
    global $conn;

    $id = $data["id"];
    $kodePlat = htmlspecialchars($data["kode_plat"]);
    $nama = htmlspecialchars($data["nama"]);
    $kodeBarang = htmlspecialchars($data["kode_barang"]);
    $namaBarang = htmlspecialchars($data["nama_barang"]);
    $telepon = htmlspecialchars($data["telepon"]);
    $pesan = htmlspecialchars($data["pesan"]);
    $note = htmlspecialchars($data["note"]);


    $query = "UPDATE customer SET
                    kode_plat = '$kodePlat',
                    nama = '$nama',
                    kode_barang = '$kodeBarang',
                    nama_barang = '$namaBarang',
                    telepon = '$telepon',
                    pesan = '$pesan',
                    note = '$note'
                  WHERE id = $id  
                    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $query = "SELECT * FROM customer WHERE
                kode_plat LIKE '%$keyword%' OR
                nama LIKE '%$keyword%' OR
                kode_barang LIKE '%$keyword%' OR
                nama_barang LIKE '%$keyword%' OR
                telepon LIKE '%$keyword%' OR
                pesan LIKE '%$keyword%' OR
                ready LIKE '%$keyword%' OR
                note LIKE '%$keyword%' OR
                id_status LIKE '%$keyword%'
                ";

    return query($query);
}

function register($data)
{
    global $conn;
    $username = strtolower(stripslashes($data["username"]));
    $nik = htmlspecialchars($data["nik"]);
    $role = htmlspecialchars($data["role"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // Cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('Username yang dipilih sudah terdaftar');    
        </script>";

        return false;
    }

    // Cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
                alert('Konfirmasi password tidak sesuai!');
            </script>";

        return false;
    }

    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Tambahkan user baru ke database dengan hak akses 1 (contoh: 1 adalah hak akses tertentu)
    $id_akses = ($role === 'admin') ? 1 : 2;
    // Sesuaikan dengan hak akses yang ada di database Anda
    mysqli_query($conn, "INSERT INTO users (nik, username, password, id_akses) VALUES ('$nik', '$username', '$password', '$id_akses')");
    return mysqli_affected_rows($conn);
}

function ubahnote($data)
{
    global $conn;

    $id = $data["id"];
    $ready = htmlspecialchars($data["ready"]);
    $note = htmlspecialchars($data["note"]);


    $query = "UPDATE customer SET
                    ready = '$ready',
                    note = '$note'
                  WHERE id = $id  
                    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function getCustomerById($id)
{
    global $conn;
    $query = "SELECT * FROM customer WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }

    return null;
}
