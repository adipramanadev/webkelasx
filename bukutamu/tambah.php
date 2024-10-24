<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tamu</title>
    <style>
        form {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-family: Arial, sans-serif;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

    <h2>Tambah Tamu Baru</h2>

    <form action="simpan_tamu.php" method="post">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required>

        <label for="pesan">Pesan:</label>
        <textarea id="pesan" name="pesan" required></textarea>

        <button type="submit">Simpan</button>
    </form>

</body>
</html>
