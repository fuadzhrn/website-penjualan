<?php

if (userLogin()['level'] !=1){
    header("location:" .$main_url."error-page.php");
    exit();
}


function insert($data) {
    global $koneksi;

    $username  = strtolower(mysqli_real_escape_string($koneksi, $data['username']));
    $fullname  = mysqli_real_escape_string($koneksi, $data['fullname']);
    $password  = mysqli_real_escape_string($koneksi, $data['password']);
    $password2 = mysqli_real_escape_string($koneksi, $data['password2']);
    $level     = mysqli_real_escape_string($koneksi, $data['level']);
    $address   = mysqli_real_escape_string($koneksi, $data['address']);

    if ($password !== $password2){
        echo "<script>alert('Password tidak cocok!');</script>";
        return false;
    }

    $pass = password_hash($password, PASSWORD_DEFAULT);

    $cekUsername = mysqli_query($koneksi, "SELECT username FROM tbl_user WHERE username = '$username'");
    if (mysqli_num_rows($cekUsername) > 0){
        echo "<script>alert('Username sudah digunakan!');</script>";
        return false;
    }

    $gambar = uploadimg();
    if (!$gambar) {
        $gambar = 'default.png';
    }

    $query = "INSERT INTO tbl_user (username, fullname, password, address, level, foto) 
              VALUES ('$username', '$fullname', '$pass', '$address', '$level', '$gambar')";

    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        echo "<script>alert('Gagal insert: " . mysqli_error($koneksi) . "');</script>";
        return false;
    }

    return mysqli_affected_rows($koneksi);
}

function delete($id, $foto){
    global $koneksi;

    $sqlDel = "DELETE FROM tbl_user WHERE userid = $id";
    mysqli_query($koneksi, $sqlDel);
    if ($foto != 'default.png'){
        unlink('../asset/image' . $foto);
    }
    return mysqli_affected_rows($koneksi);
}


function selectUser1($level){
    $result = null;
    if ($level == 1){
        $result = "selected"; 
    }
    return $result;
}

function selectUser2($level){
    $result = null;
    if ($level == 2){
        $result = "selected"; 
    }
    return $result;
}

function selectUser3($level){
    $result = null;
    if ($level == 3){
        $result = "selected"; 
    }
    return $result;
}

function update($data) {
    global $koneksi;

    $iduser    = mysqli_real_escape_string($koneksi, $data['id']);
    $username  = strtolower(mysqli_real_escape_string($koneksi, $data['username']));
    $fullname  = mysqli_real_escape_string($koneksi, $data['fullname']);
    $level     = mysqli_real_escape_string($koneksi, $data['level']);
    $address   = mysqli_real_escape_string($koneksi, $data['address']);
    $fotoLama  = mysqli_real_escape_string($koneksi, $data['oldImg']);

    $gambar = isset($_FILES['image']['name']) && $_FILES['image']['name'] != ''
        ? mysqli_real_escape_string($koneksi, $_FILES['image']['name'])
        : $fotoLama;

    // cek username sekarang
    $queryUsername = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE userid = '$iduser'");
    $dataUsername  = mysqli_fetch_assoc($queryUsername);
    $curUsername   = $dataUsername['username'];

    // cek username baru
    $newUsername = mysqli_query($koneksi, "SELECT username FROM tbl_user WHERE username = '$username'");

    if ($username !== $curUsername) {
        if (mysqli_num_rows($newUsername)) {
            echo "<script>
                alert('Username sudah digunakan!, update gagal!!');
                document.location.href ='data-user.php';
                </script>";
            return false;
        }
    }

    // kode selanjutnya untuk update data...

  

  

    // cek gambar
    if ($gambar != null){
        $url     ="data-user.php";
        $imgUser = uploadimg($url);
        if($fotoLama != 'default.png'){
            @unlink('../asset/image'. $fotoLama);
        } 
    }else{
        $imgUser = $fotoLama;
    }

    mysqli_query($koneksi, "UPDATE tbl_user SET
                    username    = '$username',
                    fullname    = '$fullname',
                    address    = '$address',
                    level    = '$level',
                    foto    = '$imgUser'
                    WHERE userid = $iduser

                    ");
     return mysqli_affected_rows($koneksi);
}



?>