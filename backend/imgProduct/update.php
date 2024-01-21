<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include_once __DIR__ . "/../layout/style.php";
    ?>
    <title>Document</title>
</head>
<style>
    div{
        
    }
    svg{
        color: #333;
        height: 16px;
        weight: 16px;
    }
    .frame-default {
        width : 300px;
    }
    .frame-default img{
        width : 100% 
    }
</style>
<body>
<?php
        include_once __DIR__ . "/../layout/header.php";
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-3 lg-4">
                <?php
                    include_once __DIR__ . "/../layout/sidebar.php";
                ?>
            </div>
    <!-- lay du lieu ra -->
        <?php 
            // lay bang can lay
            include_once __DIR__ . "/../product/connectSQL.php";
            // cau lenh muon thuc thi
            $sql = "SELECT * 
                    FROM sampham;";
            // nho php thuc thi
            $result = mysqli_query($conn,$sql);
            // boc tach du lieu ra 
            $data = [];
            while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                $data [] = array (
                    'sp_id' => $row['id'],
                    'sp_ten' => $row['sp_ten'],
                    'sp_gia' => $row['sp_gia']
                );                
            }

            $hsp_id = $_GET['hsp_id'];
            // echo 'id la ' . $hsp_id;
            // lay bang ket noi 
            include_once __DIR__ . "/connectSQL.php";
            // cau lenh muon thuc thi
            $sqlDel = "SELECT * 
                    FROM hinhsanpham
                    WHERE hsp_id = $hsp_id;";
            // nho php thuc thi
            $result = mysqli_query($conn,$sqlDel);
            // lay du lieu ra tu khoi du lieu
            $dataOld = [];
            while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                $dataOld = [
                    'hsp_id' => $row['hsp_id'],
                    'hsp_teptin' => $row['hsp_teptin'],
                    'sp_id' => $row['sp_id']
                ];
            var_dump($dataOld); 
    }


        ?>
              <div class="col-md-9 lg-8">
                <h1>Sua noi dung hinh anh</h1><br>
                <form action="" method="POST" name ="formImageProduct" id="formImageProduct"
                    enctype="multipart/form-data">
                    <div class="form-group">
                        <label>San Pham</label>
                        <select name="sp_id" id="sp_id">
                            <?php foreach($data as $sp ) : ?>
                                <?php if( $sp['sp_id'] == $dataOld['sp_id']) : ?>
                                <option value="<?= $sp['sp_id']?> " selected ><?= $sp['sp_ten'] ?></option>
                                <?php else: ?>
                                <option value="<?= $sp['sp_id']?> "><?= $sp['sp_ten'] ?></option>
                                <?php  endif; ?>
                            <?php endforeach; ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Upload :</label>
                        <div class="frame-default">
                            <input type="hidden" name = 'hsp_teptin' value = "<?= $dataOld['hsp_teptin'] ?>">
                                <img src="/ex1.com/assests/uploads/<?= $dataOld['hsp_teptin'] ?>" alt="Anh default" 
                                    id="default-img">
                            </div>
                        <input type="file" name ="hsp_teptin" id="hsp_teptin" accept="image/jpeg, image/png, image/jpg" >
                       
                    </div>
                        <div class="form-group">
                            <a href="indexImage.php" class="btn btn-secondary">BACK</a>
                            <button name="btn" type="submit" class="btn btn-primary">Save Image </button>
                        </div>                   
                </form>
            </div>
            <?php 
        if(isset($_POST['btn'] )) {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $sp_id = $_POST['sp_id'];
            $hsp_teptin = $_POST['hsp_teptin'];

            if(!empty($_FILES['hsp_teptin']['name'])) {
                // noi chua hinh anh sau khi xu ly
                $uploadDir = __DIR__ . "/../../assests/uploads/";
                // phan biet ten file tranh bi de file
                $newNameFile = date('Ymd_his') . $_FILES['hsp_teptin']['name'];
                // them vao thu muc moi tao
                move_uploaded_file($_FILES['hsp_teptin']['tmp_name'], $uploadDir . $newNameFile );
                
                // xoa anh cu tranh rac
                unlink($uploadDir . $hsp_teptin);
                // cap nhat lai ten
                $hsp_teptin = $newNameFile;
            }
            // UPDATE lai ten san pham
            $sqlUpdate = "UPDATE hinhsanpham
                            SET
                                hsp_teptin='$hsp_teptin',
                                sp_id= $sp_id
                            WHERE hsp_id= $hsp_id;";
            // nho php thuc thi
            mysqli_query($conn,$sqlUpdate);
            echo '<script> location.href="indexImage.php" </script>';
            //print_r($_FILES['hsp_teptin']);
        }
    ?>
       </div>
    </div>
    <?php 
        if(isset($_POST['submit'] )) {
            var_dump($_FILES['fileToUpload']);
        }
    ?>
    <?php
        include_once __DIR__ . "/../layout/footer.php";
    ?>

    <?php
        include_once __DIR__ . "/../layout/script.php";
    ?>
    <script>
        $(document).ready(function() {
            const reader = new FileReader();
            const fileInput = document.getElementById('hsp_teptin');
            const img = document.getElementById('default-img');
                reader.onload = e => {
                    img.src = e.target.result;
                }
            fileInput.addEventListener('change', e => {
                const f = e.target.files[0];
                reader.readAsDataURL(f);
            })
        });
    </script>
</body>
</html>