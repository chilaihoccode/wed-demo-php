<?php
    session_start();
    // xoa nhung du lieu trong database
    unset($_SESSION['trangthaidangnhap']);
    unset($_SESSION['kh_tendangnhap']);
    unset($_SESSION['kh_ten']);
    unset( $_SESSION['kh_quantri']);

    echo '<script> location.href= "dashboard.php" </script>'
?>