<?php
include 'config.php'; // Memasukkan koneksi database

// Cek apakah ada id yang diteruskan
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Query untuk mengambil data tamu berdasarkan id
    $sql = "SELECT * FROM tamu WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result); // Mengambil data tamu yang ditemukan
}

// Cek apakah form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $pesan = $_POST['pesan'];

    // Query untuk memperbarui data tamu
    $sql = "UPDATE tamu SET nama = '$nama', pesan = '$pesan' WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tamu</title>
    <style>
        /* Styling untuk form */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"], textarea {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
        }

        textarea {
            height: 100px;
        }

        button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Tamu</h2>

    <form method="post">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>

        <label for="pesan">Pesan:</label>
        <textarea id="pesan" name="pesan" required><?php echo $row['pesan']; ?></textarea>

        <button type="submit">Simpan Perubahan</button>
    </form>

    <!-- Tombol untuk kembali ke halaman utama -->
    <a href="index.php" class="back-link">Kembali ke Daftar Tamu</a>
</div>

</body>
</html>
