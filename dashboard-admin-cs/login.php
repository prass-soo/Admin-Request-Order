<?php
session_name('admin_session');
session_start();
require '../functions.php';

// cek cookie
if (isset($_COOKIE['id']) && $_COOKIE['key']) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username dan id_akses berdasarkan id
    $result = mysqli_query($conn, "SELECT username, id_akses FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie, username, dan id_akses
    if ($key === hash('sha256', $row['username']) && $row['id_akses'] == 1) {
        $_SESSION['login'] = true;
        header("Location: index.php"); // Ganti dengan halaman yang sesuai
        exit;
    }
}

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    // cek username
    if (mysqli_num_rows($result) === 1) {
        // cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"]) && $row['id_akses'] == 1) {
            // set session
            $_SESSION["login"] = true;

            // cek remember me
            if (isset($_POST["remember"])) {
                // buat cookie
                setcookie('id', $row['id'], time() + 604800);
                setcookie('key', hash('sha256', $row['username']), time() + 604800);
            }

            header("Location: index.php"); // Ganti dengan halaman yang sesuai
            exit;
        }
    }
    $error = true;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&family=Source+Han+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/plugins.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/themes.css">
    <link rel="icon" type="image/png" href="../assets/img/logoKali.png">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Noto Sans JP', sans-serif;
            overflow: hidden;
        }

        #bg-container {
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: url('../assets/img/bg2.jpg') no-repeat center center fixed;
            background-size: cover;
            filter: blur(5px);
            /* Efek blur pada latar belakang */
        }

        label {
            margin-left: 20px;
        }

        button {
            width: 100%;
            margin-left: 120px;
        }
    </style>
</head>

<body>
    <div id="bg-container"></div>
    <div id="login-container">
        <h1 class="h2 text-light text-center push-top-bottom animation-slideDown">
            <i class="fa fa-lock"></i> <br> <br> <strong>REQUEST ORDER <br> PART MONITORING</strong><br> <strong>(ROPM)</strong>
        </h1>
        <?php if (isset($error)) : ?>
            <p>Username atau Password Salah!!</p>
        <?php endif; ?>

        <div class="block animation-fadeInQuickInv">
            <div class="block-title">
                <div class="block-options pull-right">
                    <a href="../registrasi.php" class="btn btn-effect-ripple btn-primary" data-toggle="tooltip" data-placement="left" title="Buat akun baru"><i class="fa fa-plus"></i></a>
                </div>
                <h2>Silahkan Login</h2>
            </div>

            <form action="" method="post" class="form-horizontal">
                <div class="form-group">
                    <div class="col-xs-12">
                        <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan Username ..." autofocus autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan Password ..." autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input type="checkbox" id="remember" name="remember" class="form-check-input">
                        <label for="remember" class="form-check-label">Remember Me</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4 text-right">
                        <button type="submit" name="login" class="btn btn-sm btn-primary"><i class="fa fa-lock"></i> Login</button>
                    </div>
                    <div class="col-sm-4"></div>
                </div>
            </form>

        </div>
    </div>
    <script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="../assets/js/vendor/bootstrap.min.js"></script>
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/app.js"></script>
</body>

</html>