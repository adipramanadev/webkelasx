<?php
include 'db.php';

// Mendapatkan semua produk dan rating rata-ratanya
$query = $pdo->query("SELECT p.id, p.name, COALESCE(AVG(r.rating), 0) as avg_rating
                      FROM products p
                      LEFT JOIN ratings r ON p.id = r.product_id
                      GROUP BY p.id");
$products = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Rating System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Product Rating System</h1>
    
    <ul class="product-list">
        <?php foreach ($products as $product): ?>
            <li>
                <h2><?= htmlspecialchars($product['name']); ?></h2>
                <p>Rating rata-rata: <?= number_format($product['avg_rating'], 1); ?> / 5</p>
                
                <form action="rate.php" method="POST">
                    <label for="rating">Berikan Rating:</label>
                    <select name="rating" id="rating" required>
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <option value="<?= $i; ?>"><?= $i; ?></option>
                        <?php endfor; ?>
                    </select>
                    <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                    <button type="submit">Kirim Rating</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

</body>
</html>
