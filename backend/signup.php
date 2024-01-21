
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include_once __DIR__ . "/layout/style.php";
    ?>
    <title>Sign Up</title>
</head>
<style>

</style>
<body>
    <?php
        include_once __DIR__ . "/layout/header.php";
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-3 lg-4">
                <?php
                    include_once __DIR__ . "/layout/sidebar.php";
                ?>
            </div>
            <div class="col-md-9 lg-8">
                <h1>Sign Up</h1>
                    <form action="" method="POST" name= "formSignup" >
                        <?php if(isset($_SESSION['trangthaidangnhap']) && $_SESSION['trangthaidangnhap'] == 'success') : ?>
                            <h1>Ban da dang nhap</h1>
                            <a href="#">Chack vao day de toi trang chu </a>
                        <?php else: ?>
                        <div class="form-group">
                            <input type="text" class="form-control"  name="username" id="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                        <a href="register.php" class="text-alert">Dang ki tai khoan</a>
                        <div class="form-group">
                            <a href="../../ex1.com/index.php" class="btn btn-secondary">Quay lai </a>
                            <button name="btn" type="submit" class="btn btn-primary">Sign up </button>
                        </div>
                        <?php endif; ?>
                    </form>
            </div>
            <?php
                if(isset($_POST['btn'])) {
                    $username = $_POST['username'];
                    $password = md5( $_POST['password']);
                    // ket noi du lieu bang
                    include_once __DIR__ . "/../../ex1.com/connectSQL.php";
                    // cau lenh muon thuc thi
                    $sql = "SELECT * 
                            FROM khachkhach
                            WHERE kh_tendangnhap = '$username'
                                AND kh_matkhau = '$password';";
                    // nho php thuc thi
                    $result = mysqli_query($conn,$sql);
                    // boc tach
                    $data = [];
                    while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                        $data = [
                            'kh_id' => $row['kh_id'],
                            'kh_tendangnhap' => $row['kh_tendangnhap'],
                            'kh_matkhau' => $row['kh_matkhau'],
                            'kh_ten' => $row['kh_ten'],
                            'kh_diachi' => $row['kh_diachi'],
                            'kh_sdt' => $row['kh_sdt'],
                            'kh_email' => $row['kh_email'],
                            'kh_quantri' => $row['kh_quantri']
                        ]; 
                    }
                    // var_dump($data);
                    // xem khach hang co trong database ko
                    if (!empty($data)) {
                        $_SESSION['trangthaidangnhap'] = true ;
                        $_SESSION['kh_id'] = $data['kh_id'];
                        $_SESSION['kh_tendangnhap'] = $username;
                        $_SESSION['kh_ten'] = $data['kh_ten'];
                        $_SESSION['kh_diachi'] = $data['kh_diachi'];
                        $_SESSION['kh_sdt'] = $data['kh_sdt'];
                        $_SESSION['kh_email'] = $data['kh_email'];
                        $_SESSION['kh_quantri'] = $data['kh_quantri'];
                        // echo 'Ban da dang nhap thanh cong';
                        if ($_SESSION['kh_quantri'] == true) {
                            echo '<script> location.href="dashboard.php" </script>;';
                        } else {
                            echo '<script> location.href="/ex1.com/" </script>;';
                        }
                        
                    }else {
                        echo 'Ban da dang nhap that bai.Vui long kiem tra lai';
                    }
              
                }
            ?>
        </div>
    </div>


    <?php
        include_once __DIR__ . "/layout/footer.php";
    ?>

    <?php
        include_once __DIR__ . "/layout/script.php";
    ?>
</body>
</html>