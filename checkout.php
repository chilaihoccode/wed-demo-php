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

    <!-- lay thong tin httt -->
    <?php
        include_once __DIR__ . "/layout-fontend/header.php";
    ?>
    <?php
        if(!isset($_SESSION['trangthaidangnhap']) ) {
            echo '<h2> Ban chua dang nhap</h2> ';
            echo '<a href="/ex1.com/backend/signup.php">Dang nhap</a>';
            die;
        }
    ?>
    <?php
        $cart = [];
        if(isset($_SESSION['cart_product'])) {
            $cart = $_SESSION['cart_product'];
        };
        // var_dump($_SESSION['cart_product']);
    ?>
    <?php 
        // tao ket noi 
        include_once __DIR__ . "/connectSQL.php";
        // cau lenh muon thuc thi
        $sql = "SELECT * 
        FROM hinhthucthanhtoan;";
        // nho php thuc thi
        $result = mysqli_query($conn,$sql);
        // boc tach du lieu
        $data = [];
        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
            $data [] = [
                'httt_id' => $row['httt_id'],
                'httt_ten' => $row['httt_ten'],
            ];
        }
        // var_dump($data);
    ?>
        <div class="container">
        <h1>Gio Hang  </h1>
            <div class="row">   
                <div class="col-md-6">
                    <form action="" method="POST" name="formInfo">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Ho va ten" value="<?= $_SESSION['kh_tendangnhap'] ?>">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?= $_SESSION['kh_email'] ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="kh_diachi" id="address" placeholder="Dia chi" value="<?= $_SESSION['kh_diachi'] ?>">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="kh_sdt" id="number" placeholder="So dien thoai" value="<?= $_SESSION['kh_sdt'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="httt_id">Phuong thuc thanh toan </label><br>
                            <select name="httt_id" id="httt_id">
                                <option value="" selected></option>
                                <?php foreach($data as $httt) : ?>
                                    <option value="<?= $httt['httt_id'] ?>"><?= $httt['httt_ten'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <a href="index.php" class="btn btn-primary">Quay ve trang chu </a>
                        <button type="submit" name="btn" class="btn btn-danger">Thanh Toan </button>
                    </form>
                <!-- update thong tin cua khach hang len data base -->
            <?php    
                if(isset($_POST['btn'])) {
                    include_once __DIR__ . "/connectSQL.php";

                    $kh_tendangnhap = $_SESSION['kh_tendangnhap'];
                
                  
                    // cau lenh muon thuc thi
                    $sqlInfo = "SELECT kh_id, kh_ten, kh_diachi, kh_sdt, kh_email
                                FROM khachkhach
                                WHERE kh_tendangnhap = '$kh_tendangnhap';
                                    ";
                    // nho php thuc thi 
                    $resultInfo = mysqli_query($conn,$sqlInfo);
                    // boc tach du lieu 
                    $dataInfo = [];
                    while ($row = mysqli_fetch_array($resultInfo,MYSQLI_ASSOC)) {
                        $dataInfo = [
                            'kh_id' => $row['kh_id'],
                            'kh_ten' => $row['kh_ten'],
                            'kh_diachi' => $row['kh_diachi'],
                            'kh_sdt' => $row['kh_sdt'],
                            'kh_email' => $row['kh_email'],
                        ];
                    }
                    // var_dump($dataInfo);die;
                    // lay thong tin gio hang 
                    // vi ko biet don hang o ma bao nhieu nen pphai tao khoa ngoai tu dong
                    
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $dh_ngaygiao = date('Y-m-d');
                    $dh_ngaylap = date('Y-m-d');
                    $dh_noigiao = $_POST['kh_diachi'];
                    $dh_trangthaithanhtoan = 0;
                    $httt_id = $_POST['httt_id'];
                    $kh_id = $_SESSION['kh_id'];
                    // thuc thi insert
                    $sqlCart = "INSERT INTO dondadat
                                    (dh_ngaylap, dh_ngaygiao, dh_noigiao, dh_trangthaithanhtoan, httt_id,kh_id )
                    VALUES ('$dh_ngaylap', '$dh_ngaygiao',N'$dh_noigiao', '$dh_trangthaithanhtoan','$httt_id', '$kh_id')";
                    // var_dump($sqlInsert);
                    // thuc thi insert
                    $resultCart = mysqli_query($conn,$sqlCart);      
                    // print_r($resultCart);die;    
                    //vi ko biet san pham o id may nen ta nho php lay giup
                    $dh_id = $conn->insert_id;
                    // var_dump($dh_id); 
                    $cart = $_SESSION['cart_product'];
                    // lay thong tin ra
                    foreach ($cart as $giohang) {
                        $sp_id = $giohang['sp_id'];
                        $sp_dh_soluong = $giohang['sp_soluong'];
                        $sp_dh_dongia = $giohang['sp_gia'];
                        $sp_dh_tonggia = $giohang['sp_soluong'] * $giohang['sp_gia'];
                        // cau lenh muon thuc thi
                        $sqlInsert = "INSERT INTO sanpham_dondathang
                                (sp_id,dh_id, sp_dh_soluong, sp_dh_dongia, sp_dh_tonggia)
                                VALUES ('$sp_id','$dh_id', '$sp_dh_soluong','$sp_dh_dongia','$sp_dh_tonggia')";
                        // var_dump($sqlInsert);
                        $resultInsert = mysqli_query($conn,$sqlInsert);
                        // var_dump($resultInsert);die;
                    }
                }    
            ?>
                           

                
            </div>
            <div class="col-md-6">
            <?php if(empty($_SESSION['cart_product'])): ?>
                <p>Ban chua chon san pham</p>
                <a href="index.php">Click vao day de ve trang chu </a>
                <?php die; ?>
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
            </div>

            <?php endif; ?>
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