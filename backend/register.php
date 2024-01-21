
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include_once __DIR__ . "/layout/style.php";
    ?>
    <title>Register </title>
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
                <h1>Register</h1>
                    <form action="" method="POST" name= "formRegister" >
                        <div class="form-group">
                            <input type="text" class="form-control"  name="username" id="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm_password">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="kh_diachi" id="kh_diachi" placeholder="Dia chi">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="number" id="number" placeholder="Number">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="">Gioi tinh</label><br>
                            <label for="kh_gioitinh">Nam</label>
                            <input type="radio" name="kh_gioitinh" id="kh_gioitinh" value="1">
                            <label for="kh_gioitinh">Nu</label>
                            <input type="radio" name="kh_gioitinh" id="kh_gioitinh" value="2">
                        </div>
                            <a href="../../ex1.com/index.php" class="btn btn-secondary">Quay lai </a>
                            <button name="btn" type="submit" class="btn btn-primary">Dang ki</button>
                        </div>
                    </form>
            </div>
            <?php
                if(isset($_POST['btn'])) {
                    $username = $_POST['username'];
                    $password = md5( $_POST['password']);
                    $number = $_POST['number'];
                    $email = $_POST['email'];
                    $kh_diachi = $_POST['kh_diachi'];
                    $kh_gioitinh = $_POST['kh_gioitinh'];
                    $kh_quantri = 0;
                    // tao ket noi 
                    include_once __DIR__ . "/product/connectSQL.php";
                    // cau lenh muon thuc thi
                    $sql = "INSERT INTO khachkhach
                    ( kh_tendangnhap, kh_matkhau, kh_gioitinh, kh_diachi, kh_sdt, kh_email,
                    kh_quantri)
                    VALUES ( '$username', '$password', '$kh_gioitinh', '$kh_diachi', '$kh_diachi', '$email', '$kh_quantri')";
                    // nho php thuc thi
                    $result = mysqli_query($conn,$sql);
                    // var_dump($result);die;
                    echo '<script> location.href="signup.php" </script>;';
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