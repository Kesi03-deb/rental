<?php
session_start();

// Cek apakah user adalah admin
if (empty($_SESSION['USER']) || $_SESSION['USER']['level'] !== 'admin') {
    echo '<script>alert("Login Khusus Admin !");window.location="../index.php";</script>';
    exit;
}

$id_login = $_SESSION['USER']['id_login'];
$row = $koneksi->prepare("SELECT * FROM login WHERE id_login = ?");
$row->execute([$id_login]);
$hasil_login = $row->fetch();
?>

<!doctype html>
<html lang="en">
<head>
    <title><?php echo $title_web; ?> | Rental Mobil</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="<?php echo $url; ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $url; ?>assets/css/font-awesome.css">
</head>
<body>

<div class="jumbotron pt-4 pb-4">
    <div class="row">
            <div class="col-sm-8 d-flex align-items-center">
                <img src="<?php echo $url; ?>assets/logo/logo.png" alt="Logo" style="height:40px; margin-right:10px;">
                <h2><b style="text-transform:uppercase; margin:0;"><?= $info_web->nama_rental; ?></b></h2>
            </div>
    </div>
</div>

<div style="margin-top:-2pc"></div>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #333;">
    <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#collapsibleNavId" 
            aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars"></i>
    </button>

    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if($title_web == 'Dashboard') echo 'active'; ?>">
                <a class="nav-link" href="<?php echo $url; ?>admin/">Home</a>
            </li>
            <li class="nav-item <?php if($title_web == 'User') echo 'active'; ?>">
                <a class="nav-link" href="<?php echo $url; ?>admin/user/index.php">User / Pelanggan</a>
            </li>
            <li class="nav-item <?php if(in_array($title_web, ['Daftar Mobil', 'Tambah Mobil', 'Edit Mobil'])) echo 'active'; ?>">
                <a class="nav-link" href="<?php echo $url; ?>admin/mobil/mobil.php">Daftar Mobil</a>
            </li>
            <li class="nav-item <?php if(in_array($title_web, ['Daftar Booking', 'Konfirmasi'])) echo 'active'; ?>">
                <a class="nav-link" href="<?php echo $url; ?>admin/booking/booking.php">Daftar Booking</a>
            </li>
            <li class="nav-item <?php if($title_web == 'Peminjaman') echo 'active'; ?>">
                <a class="nav-link" href="<?php echo $url; ?>admin/peminjaman/peminjaman.php">Peminjaman / Pengembalian</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa fa-user"></i> Hallo, <?php echo $hasil_login['nama_pengguna']; ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="return confirm('Apakah anda ingin logout ?');" 
                   href="<?php echo $url; ?>admin/logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>
