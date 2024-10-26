<?php
include 'config.php'; // Memasukkan koneksi database

// Cek apakah ada id yang diteruskan di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data tamu berdasarkan id
    $sql = "DELETE FROM tamu WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Data berhasil dihapus!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
