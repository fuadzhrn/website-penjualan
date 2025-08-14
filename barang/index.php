<?php

session_start();

if(!isset($_SESSION["ssLoginPOS"])){
  header("location: ../auth/login.php");
  exit();
}



require "../config/config.php";
require "../config/functions.php";
require "../module/mode-user.php";
require "../module/mode-barang.php";

$title = "Barang - Website Penjualan";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";




?>


 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Barang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $main_url?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Add Barang</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-list fa-sm pr-2"></i> Data Barang</h3>
                    
                    <a href="<?= $main_url?>barang/form-barang" class="mr-2 btn btn-sm btn-primary float-right"><i class="fas fa-plus fa-sm pr-2"></i> Add Barang</a>
                </div>
                <div class="card-body table-responsive p-3">
                        <table class="table table-hover text-nowrap" id="tblData">
                            <thead>
                                <tr>
                                    <th>Gambar</th>
                                    <th>ID Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th style="width: 10%;" class="text-center">Operasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 1;
                                    $barang = getData("SELECT * FROM tbl_barang");
                                    foreach ($barang as $brg){ ?>
                                        <tr>
                                            <td>
                                                <img src="../asset/image/<?= $brg['gambar'] ?>" alt="gambar barang" class="rounded-circle" width="60px">
                                            </td>
                                            <td><?= $brg['id_barang'] ?></td>
                                            <td><?= $brg['nama_barang'] ?></td>
                                            <td class="text-center"><?= number_format($brg['harga_beli'],0,',','.') ?></td>
                                            <td class="text-center"><?= number_format($brg['harga_jual'],0,',','.') ?></td>
                                            <td><?= $brg['nama_barang'] ?></td>
                                            <td>
                                                <a href="?id=<?= $brg['id_barang'] ?>&gbr=<?= $brg['gambar'] ?>&msg=deleted" class="btn btn-danger btn-sm" title="hapus barang" onclick="return confirm('Anda yakin akan menghapus barang ini ?')"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>

                                    <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </section>




<?php
    require "../template/footer.php";
?>