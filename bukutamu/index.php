<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <th>no</th>
            <th>Nama</th>
            <th>Pesan</th>
            <th>Tanggal</th>
            <th>tools</th>
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
            </tr>
        </tbody>
        <?php }} ?>
    </table>
</body>
</html>