<?php

session_start();
require 'koneksi/koneksi.php';
include 'header.php';

if(empty($_SESSION['USER']))
{
    echo '<script>alert("Harap Login");window.location="index.php"</script>';
    exit; // make sure to stop the script after redirect
}

$id_login = $_SESSION['USER']['id_login'];

// Prepare and execute query to fetch bookings for the logged-in user only
$stmt = $koneksi->prepare("SELECT mobil.merk, booking.* 
                           FROM booking 
                           JOIN mobil ON booking.id_mobil = mobil.id_mobil
                           WHERE booking.id_login = ? 
                           ORDER BY id_booking DESC");
$stmt->execute([$id_login]);
$hasil = $stmt->fetchAll();

?>

<br>
<br>
<div class="container">
<div class="row">
    <div class="col-sm-12">
         <div class="card">
            <div class="card-header">
                Daftar Transaksi
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Kode Booking</th>
                            <th>Merk Mobil</th>
                            <th>Nama </th>
                            <th>Tanggal Sewa </th>
                            <th>Lama Sewa </th>
                            <th>Total Harga</th>
                            <th>Konfirmasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $no=1; foreach($hasil as $isi){?>
                        <tr>
                            <td><?php echo $no;?></td>
                            <td><?= $isi['kode_booking'];?></td>
                            <td><?= $isi['merk'];?></td>
                            <td><?= $isi['nama'];?></td>
                            <td><?= $isi['tanggal'];?></td>
                            <td><?= $isi['lama_sewa'];?> hari</td>
                            <td>Rp. <?= number_format($isi['total_harga']);?></td>
                            <td><?= $isi['konfirmasi_pembayaran'];?></td>
                            <td>
                                <a class="btn btn-primary" href="bayar.php?id=<?= $isi['kode_booking'];?>" 
                                role="button">Detail</a>   
                            </td>
                        </tr>
                        <?php $no++;}?>
                    </tbody>
                </table>
           </div>
         </div> 
    </div>
</div>
</div>

<br>

<br>

<br>


<?php include 'footer.php';?>