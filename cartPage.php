<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include_once __DIR__ . "/layout-fontend/style.php";
    ?>
    <title>Trang chu</title>
</head>
<style>
    img.img-product {
        width : 40% ;
    }
    .text-num{
        text-align : right ;
    }
</style>
<body>
    <?php
        include_once __DIR__ . "/layout-fontend/header.php";
    ?>

    <?php
        $cart = [];
        if(isset($_SESSION['cart_product'])) {
            $cart = $_SESSION['cart_product'];
        };
        // var_dump($_SESSION['cart_product']);
    ?>
    <div class="container">
    <h1>Gio Hang  </h1>
        <div class="row">   
            <?php if(empty($_SESSION['cart_product'])): ?>
                <p>Ban chua chon san pham</p>
                <a href="index.php">Click vao day de ve trang chu </a>
            <?php else: ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>hinh san pham </th>
                            <th>Ten san pham</th>
                            <th>Gia san pham </th>
                            <th>So luong</th>
                            <th>Thanh tien </th>
                        </tr>                       
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        <?php $sum = 0 ?>
                        <?php foreach($cart as $sp) : ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td>
                                <img src="<?= $sp['hsp_teptin'] ?>" alt="" class="img-product">
                            </td>
                            <td><?= $sp['sp_ten'] ?></td>
                            <td class="text-num"><?= number_format($sp['sp_gia'],0,'.',',') ?></td>
                            <td class="text-num"><?= $sp['sp_soluong'] ?></td>
                            <td class="text-num"><?= number_format($sp['sp_soluong'] * $sp['sp_gia'] ,0, ".", ".")  ?> </td>
                        </tr>
                        <?php $i++ ?>
                        <?php $sum += $sp['sp_soluong'] * $sp['sp_gia'] ?>
                        <?php endforeach; ?>                       
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-num text-danger">Tong : <?= number_format($sum,0, '.', ',')  ?></td>
                        </tr>
                    </tfoot>
                </table>
            <?php endif; ?>
            <a href="checkout.php" class="btn btn-primary">Thanh Toan</a>
        </div>
    </div>


    <?php
        include_once __DIR__ . "/layout-fontend/footer.php";
    ?>

    <?php
        include_once __DIR__ . "/layout-fontend/script.php";
    ?>


</body>
</html>