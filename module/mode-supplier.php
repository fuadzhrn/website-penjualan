<?php

if (userLogin()['level'] == 3){
    header("location:" . $main_url . "error-page.php");
    exit();
}

function insert_supplier($data){
    global $koneksi;

    $nama = mysqli_real_escape_string($koneksi, $data ['nama']);
    $telpon = mysqli_real_escape_string($koneksi, $data ['telpon']);
    $alamat = mysqli_real_escape_string($koneksi, $data ['alamat']);
    $ketr = mysqli_real_escape_string($koneksi, $data ['ketr']);

    $sqlSupplier    = "INSERT INTO tbl_supplier VALUES (null,'$nama','$telpon','$ketr','$alamat')";
    
    mysqli_query($koneksi, $sqlSupplier);

    return mysqli_affected_rows($koneksi);
}


function delete_supplier($id) {
    global $koneksi;

    $id = (int)$id;
    $sqlDelete = "DELETE FROM tbl_supplier WHERE id_supplier = $id";

    if (!mysqli_query($koneksi, $sqlDelete)) {
        echo "Gagal menghapus: " . mysqli_error($koneksi);
        return 0;
    }

    return mysqli_affected_rows($koneksi);
}


?>
