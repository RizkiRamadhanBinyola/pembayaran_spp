<?php
include 'koneksi.php';
$id = $_GET["id"];

// Periksa apakah ada siswa yang masih terhubung dengan jurusan ini
$check_query = "SELECT COUNT(*) AS total_siswa FROM siswa WHERE id_jurusan='$id'";
$result = mysqli_query($koneksi, $check_query);
$row = mysqli_fetch_assoc($result);

if ($row['total_siswa'] > 0) {
    echo "<script>alert('Tidak dapat menghapus jurusan karena masih memiliki siswa terkait.');window.location='jurusan.php';</script>";
} else {
    // Hapus data jurusan jika tidak ada siswa terkait
    $query = "DELETE FROM jurusan WHERE id_jurusan='$id' ";
    $hasil_query = mysqli_query($koneksi, $query);

    if (!$hasil_query) {
        die("Gagal menghapus data: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
    } else {
        echo "<script>alert('Data berhasil dihapus.');window.location='jurusan.php';</script>";
    }
}
?>
