<?php
    $httt_id = $_GET['httt_id'];
    // mo lien ket sql
    include_once __DIR__ . "/connectSQL.php";
    // cau lenh can thuc thi
    $sql = "DELETE FROM hinhthucthanhtoan
            WHERE httt_id = '$httt_id'; ";
    // nho php thuc hien 
    $result = mysqli_query($conn,$sql);
    // tra ve trang chu
    echo '<script> location.href="listhandle.php" </script>;';
?>