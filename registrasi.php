<?php
require 'functions.php';

if (isset($_POST["register"])) {
    if (register($_POST) > 0) {
        echo "<script>
                    alert('user baru berhasil ditambahkan!');
                </script>";
        header("Location: index.php");
    } else {
        header("Location: registrasi.php");
        echo mysqli_error($conn);
    }
}

?>

<head>
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="icon" type="image/png" href="assets/img/logo1-edited.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/themes.css">
    <link rel="icon" type="image/png" href="assets/img/logoKali.png">
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
            background: url('assets/img/bg2.jpg') no-repeat center center fixed;
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
            <i class="fa fa-plus"></i> <strong> Buat Akun Baru</strong>
        </h1>
        <div class="block animation-fadeInQuickInv">
            <div class="block-title">
                <div class="block-options pull-right">
                    <a href="index.php" class="btn btn-effect-ripple btn-primary" data-toggle="tooltip" data-placement="left" title="Kembali pilih akses"><i class="fa fa-caret-square-o-left"></i></a>
                </div>
                <h2> Daftar</h2>
            </div>
            <form id="form-validation" action="" method="post" class="form-horizontal">
                <div class="form-group">
                    <div class="col-xs-12">
                        <input type="text" id="nik" name="nik" class="form-control" placeholder="NIK Pegawai" autocomplete="off" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username" autocomplete="off" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <select name="role" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="sparepart">Sparepart</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input type="password" id="password2" name="password2" class="form-control" placeholder="Verifikasi Password" required>
                    </div>
                </div>
                <div class="form-group form-actions">
                    <div class="col-xs-6 text-right">
                        <button type="submit" class="btn btn-effect-ripple btn-primary" name="register"><i class="fa fa-plus"></i> Buat Akun</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/pages/formsValidation.js"></script>
    <script>
        $(function() {
            FormsValidation.init();
        });
    </script>
</body>

</html>