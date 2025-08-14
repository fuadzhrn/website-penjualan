<?php

function uploadimg($url = null, $name = null) {
    $namafile = $_FILES['image']['name'];
    $ukuran   = $_FILES['image']['size'];
    $tmp      = $_FILES['image']['tmp_name'];

    if ($namafile == "") return false;

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'gif'];
    $ekstensi = strtolower(pathinfo($namafile, PATHINFO_EXTENSION));

    if (!in_array($ekstensi, $ekstensiGambarValid)) {
        if ($url != null ){
             echo '<script>
             alert("File bukan gambar valid. Data gagal di update!!");
             document.location.href = "'. $url .'";
             </script>';
             die();
        return false;
        } else{
        echo '<script>
        alert("File bukan gambar valid.");
        </script>';
        return false;
    }
}

    if ($ukuran > 1000000) {
         if ($url != null ){
             echo '<script>
                    alert("Ukuran gambar terlalu besar. Data gagal di update!!");
                    document.location.href = "'. $url .'";
             </script>';
             die();
        return false;
        } else{
        echo '<script>
        alert("Ukuran gambar terlalu besar.");
        </script>';
        return false;
    }
    }

    if($name != null){
        $namaFileBaru = $name . '-' . $ekstensi;
    }else{
        
    $namaFileBaru = rand(10, 1000) . '-' . $namafile;
    }

    $target = $_SERVER['DOCUMENT_ROOT'] . '/website-penjualan/asset/image/' . $namaFileBaru;

    if (move_uploaded_file($tmp, $target)) {
        return $namaFileBaru;
    } else {
        echo '<script>
        alert("Gagal memindahkan file.");
        </script>';
        return false;
    }
}

function getData($sql){
    global $koneksi;

    $result = mysqli_query($koneksi, $sql);
    $rows   = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}


function userLogin(){
    $userActive = $_SESSION["ssUserPOS"];
    $dataUser   = getData("SELECT * FROM tbl_user WHERE username = '$userActive'")[0];
    return $dataUser;
}




function userMenu(){
    $uri_path   = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    $menu       = $uri_segments[2];
    return $menu;
}

function menuHome(){
    if (userMenu()== 'dashboard.php'){
        $result = 'active';
    }else{
        $result = null;
    }
    return $result;
}

function menuSetting(){
    if (userMenu()== 'user'){
        $result = 'menu-is-opening menu-open';
    }else{
        $result = null;
    }
    return $result;
}

function menuUser(){
    if (userMenu()== 'user'){
        $result = 'active';
    }else{
        $result = null;
    }
    return $result;
}

function menuSupplier(){
    if (userMenu()== 'supplier'){
        $result = 'active';
    }else{
        $result = null;
    }
    return $result;
}

function menuMaster(){
    if (userMenu() == 'supplier' or userMenu() == 'customer' or userMenu() == 'barang'){
        $result = 'menu-is-opening menu-open';
    }else{
        $result = null;
    }
    return $result;
}

function menuCustomer()
{
    if (userMenu() == 'customer'){
        $result = 'active';
    }else{
        $result = null;

    }
    return $result;
}

function menuBarang()
{
    if (userMenu() == 'barang'){
        $result = 'active';
    }else{
        $result = null;

    }
    return $result;
}

?>