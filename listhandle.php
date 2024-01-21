<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        // tao lien ket sql
        include_once __DIR__ . "/connectSQL.php";
        // cau lenh can thuc thi
        $sql = "SELECT * 
                FROM hinhthucthanhtoan;
                ";
        // nho php thuc thi
        $result = mysqli_query($conn, $sql);
        // lay du lieu ra tu khoi du lieu
        $data = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data [] = array(
                'httt_id' => $row['httt_id'],
                'httt_ten' => $row['httt_ten'],
            );
        }
        // var_dump($data);
    
    ?>
    <a href="insertSQL.php">insert</a>
    <table border= "1">
        <tr>
            <th>hinh thuc thanh toan id</th>
            <th>hinh thuc thanh toan ten</th>
            <th>chinh sua</th>
        </tr>
        <?php foreach($data as $ht): ?>
            <tr>
                <td><?= $ht['httt_id'] ?></td>
                <td><?= $ht['httt_ten'] ?></td>
                <td>
                    <a href="edit.php?httt_id=<?= $ht['httt_id'] ?>">Sua</a>
                    <a href="delete.php?httt_id=<?= $ht['httt_id'] ?>">Xoa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>