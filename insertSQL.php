<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Them hinh thuc thanh toan </h1>
    <form action="" method="POST" name="formhandle">
        <label for="namehandle">hinh thuc thanh toan </label><br>
        <input type="text" name="httt_ten" id="namehandle"> <br>
        <br>
        <button name="btn">Save</button>
    </form>

    <?php
        if(isset($_POST['btn'])) {
            $httt_ten = $_POST["httt_ten"];
            
            // ket noi vs sql
            include_once __DIR__ . "/connectSQL.php";
            // cau lenh thuc thi
            $sql = "INSERT INTO hinhthucthanhtoan(httt_ten)
                    VALUES ('$httt_ten');";
            // nhoi php thuc thi
            $result = mysqli_query($conn,$sql);

            // tra ve trang chu
            echo '<script> location.href="listhandle.php" </script>;';

        }
    ?>
</body>
</html>