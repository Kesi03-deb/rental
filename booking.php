<?php

    session_start();
    require 'koneksi/koneksi.php';
    include 'header.php';
    if(empty($_SESSION['USER']))
    {
        echo '<script>alert("Harap login !");window.location="index.php"</script>';
    }
    $id = $_GET['id'];
    $isi = $koneksi->query("SELECT * FROM mobil WHERE id_mobil = '$id'")->fetch();
?>
<br>
<br>
<div class="container">
<div class="row">
    <div class="col-sm-4">
        <div class="card">
            <img src="assets/image/<?php echo $isi['gambar'];?>" class="card-img-top" style="height:200px;">
            <div class="card-body" style="background:
            <h5 class="card-title"><?php echo $isi['merk'];?></h5>
            </div>
            <ul class="list-group list-group-flush">

                <?php if($isi['status'] == 'Tersedia'){?>

                    <li class="list-group-item bg-primary text-white">
                        <i class="fa fa-check"></i> Tersedia
                    </li>

                <?php }else{?>

                    <li class="list-group-item bg-danger text-white">
                        <i class="fa fa-close"></i> Tidak Tersedia
                    </li>

                <?php }?>
            <li class="list-group-item bg-dark text-white">
                <i class="fa fa-money"></i> Rp. <?php echo number_format($isi['harga']);?> / Hari
            </li>
            </ul>
        </div>
    </div>
    <div class="col-sm-8">
         <div class="card">
           <div class="card-body">
               <form method="post" action="koneksi/proses.php?id=booking">
					<div class="form-group">
				  		<label for="">KTP</label>
						<input type="text" name="ktp" required class="form-control" placeholder="KTP / NIK Anda" maxlength="16" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
					</div>
                    <div class="form-group">
                      <label for="">Nama</label>
                      <input type="text" name="nama" required class="form-control" placeholder="Nama Anda" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                    </div> 
                    <div class="form-group">
                      <label for="">Alamat</label>
                      <input type="text" name="alamat" id="" required class="form-control" placeholder="Alamat">
                    </div> 
                    <div class="form-group">
                      <label for="">Telepon</label>
                      <input type="text" name="no_tlp" required class="form-control" placeholder="Nomor Telepon Anda" inputmode="numeric" pattern="[0-9]+" maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div> 
                    <div class="form-group">
                      <label for="">Tanggal Sewa</label>
                      <input type="date" name="tanggal" id="" required class="form-control" placeholder="Nama Anda">
                    </div> 
                    <div class="form-group">
					  <label for="">Hari</label>
					  <input type="number" name="lama_sewa" min="1" required class="form-control" placeholder="Hari">
					</div> 
                    <input type="hidden" value="<?php echo $_SESSION['USER']['id_login'];?>" name="id_login">
                    <input type="hidden" value="<?php echo $isi['id_mobil'];?>" name="id_mobil">
                    <input type="hidden" value="<?php echo $isi['harga'];?>" name="total_harga">
                    <hr/>
                    <?php if($isi['status'] == 'Tersedia'){?>
                        <button type="submit" class="btn btn-primary float-right">Sewa Sekarang</button>
                    <?php }else{?>
                        <button type="submit" class="btn btn-danger float-right" disabled>Tidak Tersedia</button>
                    <?php }?>
               </form>
           </div>
         </div> 
    </div>
</div>
</div>

<br>

<br>

<br>


<?php include 'footer.php';?>