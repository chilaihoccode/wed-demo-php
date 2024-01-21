<?php
session_start();
        // thu thap thong tin 
        $sp_id = $_POST['sp_id'];
        $sp_ten = $_POST['sp_ten'];
        $sp_gia = $_POST['sp_gia'];
        $sp_soluong = $_POST['sp_soluong'];
        $hsp_teptin = $_POST['hsp_teptin'];
    
        // them 1 mang vao sesion
        $cart = [];
        if(isset($_SESSION['cart_product'])) {
            $cart = $_SESSION['cart_product'];
        }
        // tao key cho 
        $cart[$sp_id] =[
            'sp_id' => $sp_id,
            'sp_ten' => $sp_ten,
            'sp_gia' => $sp_gia,
            'sp_soluong' => $sp_soluong,
            'hsp_teptin' => $hsp_teptin,
        ];
        // tao session
        $_SESSION['cart_product'] = $cart;
        // print_r($_SESSION['cart_product']);

        // chuyen huong toi trang gio hang
        echo '<script> location.href="cartPage.php" </script>;';
?>