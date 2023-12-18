<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>VALIDASI AKSES</title>
    <link rel="icon" type="image/png" href="assets/img/logoKali.png">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/themes.css">
    <script src="assets/js/vendor/modernizr-3.3.1.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
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

        .card {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            z-index: 1;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            /* Warna latar belakang kartu dengan opasitas */
            border-radius: 10px;
        }

        .form-horizontal {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: #000;
            color: #fff;
            width: 200px;
            padding: 15px;
            font-size: 18px;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div id="bg-container"></div>
    <div class="card">
        <h1 class="text-dark">
            <strong>Silahkan Pilih Akses</strong>
        </h1>
        <div class="form-horizontal push animation-fadeInQuick">
            <form action="dashboard-admin-cs/login.php" method="post">
                <div class="form-group">
                    <button type="submit" class="btn btn-effect-ripple btn-primary">
                        <i class="fas fa-headset"></i> Customer Service
                    </button>
                </div>
            </form>

            <form action="dashboard-admin-sp/login.php" method="post">
                <div class="form-group">
                    <button type="submit" class="btn btn-effect-ripple btn-primary">
                        <i class="fas fa-cogs"></i> Sparepart
                    </button>
                </div>
            </form>

            <hr style="border-top: 1px solid #000;">
            <p>Jika tidak punya akun, silahkan daftar</p>

            <form action="registrasi.php" method="post">
                <div class="form-group">
                    <button type="submit" class="btn btn-effect-ripple btn-primary">
                        <i class="fas fa-plus"></i> Register
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>