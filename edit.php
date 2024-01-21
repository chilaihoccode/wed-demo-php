<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $httt_id = $_GET['httt_id'];
        // mo lien ket  
        include_once __DIR__ . "/connectSQL.php";
        // cau lenh
        $sql = "SELECT *
                FROM hinhthucthanhtoan
                WHERE httt_id = $httt_id;";
        // php thuc thi
        $result = mysqli_query($conn,$sql);
        // tach
        $olddata = [];
        while ( $row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $olddata = array(
                'httt_id' => $row['httt_id'],
                'httt_ten' => $row['httt_ten'],
            );

        }
    ?>
    <h1>Sua hinh thuc thanh toan </h1>
    <form action="" method= "POST" name="formhandle">
        <label for="">hinh thuc thanh toan</label><br>
        <input type="text" name= "httt_ten" value="<?= $olddata['httt_ten']?>"><br>
        <br>
        <button>
            <a href="listhandle.php">back</a>
            </button>
        <button name="btn">Edit</button>
    </form>

    <?php
        if(isset($_POST['btn'])) {
            $httt_ten = $_POST['httt_ten'];

        // mo lien ket 
            include_once __DIR__ . "/connectSQL.php";
        // cau lenh can thuc thi
            $sqlUpdate = "UPDATE hinhthucthanhtoan
                    SET httt_ten = '$httt_ten'
                    WHERE httt_id = $httt_id;";
        // nho php thuc thi 
            $result = mysqli_query($conn,$sqlUpdate);

        // tro ve trang chu
            // echo '<script> location.href="listhandle.php" </script>';
        }
        var_dump($result);die;
    ?>
</body>
</html>