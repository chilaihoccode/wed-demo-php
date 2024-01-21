<?php
    $sp_id = $_GET['sp_id'];

    // mo lien ket sql 
    include_once __DIR__ . "/connectSQL.php";
    // cau lenh muon thuc thi
    $sql = "DELETE FROM sampham
            WHERE id = '$sp_id';";
    // nho php thuc thi 
    $result = mysqli_query($conn,$sql);
    // tra ve trang chu 
    echo '<script> location.href="index.php" </script>;';
?>