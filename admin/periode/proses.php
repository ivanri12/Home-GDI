<?php require_once "../_config/config.php";
require "../assets/libs/vendor/autoload.php";

if (isset($_POST['tambah'])) {
    $jabatan_majelis = trim(mysqli_real_escape_string($con, $_POST['jabatan_majelis']));
    $jabatan_pendeta = trim(mysqli_real_escape_string($con, $_POST['jabatan_pendeta']));
    $tanggal_menjabat = trim(mysqli_real_escape_string($con, $_POST['tanggal_menjabat']));
    $tanggal_jabatan_berahkir = trim(mysqli_real_escape_string($con, $_POST['tanggal_jabatan_berahkir']));

    // Menambahkan data baru
    $tambah = mysqli_query($con, "INSERT INTO periode (jabatan_majelis, jabatan_pendeta, tanggal_menjabat, tanggal_jabatan_berahkir) VALUES ('$jabatan_majelis','$jabatan_pendeta','$tanggal_menjabat','$tanggal_jabatan_berahkir')") or die(mysqli_error($con));

    if ($tambah) {
        echo "<script>alert('Data Berhasil Ditambahkan');window.location='data.php';</script>";
    } else {
        echo "<script>alert('Data Gagal Ditambahkan');window.location='data.php';</script>";
    }
} else if (isset($_POST['edit'])) {
    $id = $_POST['id_periode'];
    $jabatan_majelis = trim(mysqli_real_escape_string($con, $_POST['jabatan_majelis']));
    $jabatan_pendeta = trim(mysqli_real_escape_string($con, $_POST['jabatan_pendeta']));
    $tanggal_menjabat = trim(mysqli_real_escape_string($con, $_POST['tanggal_menjabat']));
    $tanggal_jabatan_berahkir = trim(mysqli_real_escape_string($con, $_POST['tanggal_jabatan_berahkir']));

    // Mengupdate data
    $update = mysqli_query($con, "UPDATE periode SET jabatan_majelis = '$jabatan_majelis', jabatan_pendeta = '$jabatan_pendeta', tanggal_menjabat = '$tanggal_menjabat', tanggal_jabatan_berahkir = '$tanggal_jabatan_berahkir' WHERE id_periode = '$id'") or die(mysqli_error($con));

    if ($update) {
        echo "<script>alert('Data Berhasil Diubah');window.location='data.php';</script>";
    } else {
        echo "<script>alert('Data Gagal Diubah');window.location='data.php';</script>";
    }
}
