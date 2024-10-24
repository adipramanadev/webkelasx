<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Styling untuk tabel */
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
            color: #333;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td {
            color: #333;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        /* Styling tombol tambah */
        .add-button {
            display: block;
            width: 150px;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            font-family: Arial, sans-serif;
        }

        .add-button:hover {
            background-color: #218838;
        }

        /* Tombol edit dan delete */
        .edit-button, .delete-button {
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        .edit-button {
            background-color: #007bff;
        }

        .edit-button:hover {
            background-color: #0056b3;
        }

        .delete-button {
            background-color: #dc3545;
        }

        .delete-button:hover {
            background-color: #c82333;
        }

        /* Tambahan styling untuk responsive */
        @media (max-width: 600px) {
            table {
                width: 100%;
            }

            th, td {
                font-size: 14px;
            }

            .add-button {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <h2>Daftar Buku Tamu</h2>

    <!-- Tombol tambah -->
    <a href="tambah.php" class="add-button">+ Tambah Tamu</a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Pesan</th>
                <th>Tanggal</th>
                <th>Tools</th> <!-- Kolom untuk tombol Edit dan Delete -->
            </tr>
        </thead>
        <tbody>
            <?php include 'config.php'; 
            $sql = "SELECT * FROM tamu";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $no  = 1; 
                while($row = mysqli_fetch_array($result)) {
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row["nama"]; ?></td>
                <td><?php echo $row["pesan"]; ?></td>
                <td><?php echo $row["tanggal"]; ?></td>
                <td>
                    <!-- Tombol Edit, akan mengarahkan ke halaman edit.php dengan ID tamu -->
                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="edit-button">Edit</a>
                    <!-- Tombol Delete, akan menghapus tamu dengan ID -->
                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="delete-button" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                </td>
            </tr>
        
        <?php }} else { ?>
            <tr>
                <td colspan="5" style="text-align:center;">Data Not Found</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    
</body>
</html>
