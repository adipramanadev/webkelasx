<?php
include 'config.php'; // Memasukkan koneksi ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama']; // Mengambil data nama dari form
    $pesan = $_POST['pesan']; // Mengambil data pesan dari form
    $tanggal = date("Y-m-d"); // Menyimpan tanggal saat ini

    // Query untuk memasukkan data ke tabel tamu
    $sql = "INSERT INTO tamu (nama, pesan, tanggal) VALUES ('$nama', '$pesan', '$tanggal')";

    if (mysqli_query($conn, $sql)) {
        // Redirect ke halaman utama jika berhasil menyimpan data
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Menutup koneksi
    mysqli_close($conn);
}
?>
