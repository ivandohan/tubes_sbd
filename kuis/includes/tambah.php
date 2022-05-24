<?php
    include 'koneksi.php';

    $username = $_POST['username'];

    $kepribadian = $_POST['sifat'];

    $result['pesan'] = "OKe";


    if($kepribadian == ""){
        $result['pesan'] = "Belum ada isi";
    }
    else {
        $cek = $koneksi->query("UPDATE users SET kepribadian = '$kepribadian' WHERE username = '$username' ");

        if($cek){
            $result['pesan'] = "Berhasil diAdd";
        } else {
            $result['pesan'] = "Gagal diAdd";
        }
    }

    echo json_encode($result);
?>