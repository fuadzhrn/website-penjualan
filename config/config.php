<?php

date_default_timezone_set('Asia/Jakarta');

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'website_penjualan';

$koneksi = mysqli_connect($host, $user, $pass, $dbname);

// if (mysqli_connect_error()){
//     echo "gagal koneksi ke database";
//     exit();


// }else{
//     echo "berhasil koneksi";
// }

$main_url = 'http://localhost/website-penjualan/';



?>