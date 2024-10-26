<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $rating = $_POST['rating'];

    // Validasi rating (harus antara 1 hingga 5)
    if ($rating < 1 || $rating > 5) {
        die('Rating tidak valid!');
    }

    // Memasukkan rating ke database
    $stmt = $pdo->prepare("INSERT INTO ratings (product_id, rating) VALUES (:product_id, :rating)");
    $stmt->execute(['product_id' => $product_id, 'rating' => $rating]);

    // Redirect ke halaman utama
    header('Location: index.php');
    exit();
}
?>
