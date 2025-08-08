<?php

session_start();

if(!isset($_SESSION["ssLoginPOS"])){
  header("location: ../auth/login.php");
  exit();
}



require "../config/config.php";
require "../config/functions.php";
require "../module/mode-user.php";


$title = "Tambah User - Website Penjualan";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if (isset($_POST['simpan'])) {
    $hasil = insert($_POST);

    if ($hasil > 0) {
        echo "<script>
            alert('User berhasil ditambahkan!');
            window.location.href = 'add-user.php';
        </script>";
    } else {
        echo "<script>alert('Gagal menyimpan user.');</script>";
    }
}
?>


 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $main_url?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= $main_url?>user/data-user.php">Users</a></li>
              <li class="breadcrumb-item active">Add User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
    <div class="container-fluid">
        <div class="card">
            <form action="" method="post" enctype="multipart/form-data">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-plus fa-sm pr-2"></i> Add User</h3>
                <button type="submit" name="simpan" class="btn btn-primary btn-sm float-right">
                <i class="fas fa-bookmark pr-2"></i>Simpan
                            </button>

                <button type="reset" class="btn btn-danger btn-sm float-right mr-1"><i class="fas fa-exclamation pr-2"></i>Reset</button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8 mb-3">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan Username" autofocus autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Fullname</label>
                            <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Masukkan nama lengkap"required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Password"required>
                        </div>
                        <div class="form-group">
                            <label for="password2">Konfirmasi Password</label>
                            <input type="password" name="password2" class="form-control" id="password2" placeholder="Masukkan Kembali Password Anda"required>
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <select name="level" id="level" class="form-control" required>
                                <option value="">-- Level User --</option>
                                <option value="1">-- Administrator --</option>
                                <option value="2">-- Supervisor --</option>
                                <option value="3">-- Operator --</option>
                            </select>
                        </div>
                         <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" cols="" rows="3" class="form-control" placeholder="Masukkan alamat user" required></textarea>
                        </div>


                    </div>
                    <div class="col-lg-4 text-center">
                        <img src="<?= $main_url ?>asset/image/default.png" class="profile-user-img img-circle mb-3"name="image" alt="">
                        <input type="file" class="form-control" name="image">
                        <span class="text-sm">Type File Gambar JGP | PNG | GIF</span><br>
                        <span class="text-sm">Width = Height</span>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>


    </section>


<?php
require "../template/footer.php";
?>