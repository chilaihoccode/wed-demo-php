<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <?php
        include_once __DIR__ . "/../layout/style.php";
    ?>
</head>
<style>
    .error {
        border : 1px solid #EB455F;
    }
</style>

<body>

    <?php
        include_once __DIR__ . "/../layout/header.php";
    ?>

    <?php
        include_once __DIR__ . "/connectSQL.php";
        // thuc thi cau lenh 
        // assec loai san pham
        $sqlCategory = "SELECT *
            FROM loaisanpham;";
            // assec nha san xuat
        $sqlProducer = "SELECT *
                        FROM nhasanxuat;";
        // assec kuyen mai
        $sqlSaleup = "SELECT *
                    FROM khuyenmai;";
        // nho php thuc thi
        $resultCategory = mysqli_query($conn,$sqlCategory);
        $resultProducer = mysqli_query($conn,$sqlProducer);
        $resultSaleup = mysqli_query($conn,$sqlSaleup);
        // lay du lieu ra
        $dataCategory = [];
        while ($row = mysqli_fetch_array($resultCategory,MYSQLI_ASSOC)) {
            $dataCategory [] = array(
                'lsp_id' => $row['lsp_id'],
                'lsp_ten' => $row['lsp_ten'],
            );
        };
        // nha san xuat
        $dataProducer = [];
        while($row = mysqli_fetch_array($resultProducer,MYSQLI_ASSOC)) {
            $dataProducer [] = array(
                'nsx_id' => $row['nsx_id'],
                'nsx_ten' => $row['nsx_ten'],
            );  
        };
        // khuyen mai
        $dataSaleup = [];
        while($row = mysqli_fetch_array($resultSaleup,MYSQLI_ASSOC)) {
            $dataSaleup [] = array(
                'km_id' => $row['km_id'],
                'km_ten' => $row['km_ten'],
                'km_gia' => $row['km_gia'],
            );
        }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-3 lg-4" >
                <?php
                    include_once __DIR__ . "/../layout/sidebar.php";
                ?>
            </div>
            <div class="col-md-9 lg-8 ">
            <h1>Them san pham moi</h1>
                <form action="" method="POST" name="formCreate" id="formCreate" >
                    <div class="form-group">
                        <label for="nameproduct">San pham moi</label><br>
                        <input class="form-control nameProduct" type="text" id="nameproduct" name="sp_ten">
                        <small class=" text-danger"></small>
                        <br>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="priceproductnew">Gia san pham</label><br>
                                <input type="text" class="form-control price" id="priceproductnew" name="sp_gia">                   
                                <small class=" text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="priceproductold">Gia cu san pham</label><br>
                                <input type="text" class="form-control oddPrice " id="priceproductold" name="sp_giacu">                  
                                <small class="text-danger"></small>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Mo ta san pham</label>
                        <div id="sp_motangan" name="sp_motangan"  >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="number">so luong</label>
                        <input type="number" name="sp_soluong" id="number" class="form-control">
                    </div>
                    <!-- them loai san pham -->
                    <div class="form-group">
                        <label>Loai San Pham</label>                        
                        <select name="lsp_id" class="form-control">
                            <option value=""></option>
                        <?php foreach($dataCategory as $lsp): ?>
                            <option value="<?= $lsp['lsp_id'] ?>"><?= $lsp['lsp_ten'] ?></option>                       
                        <?php endforeach; ?> 
                        </select>
                    </div>
                    <!-- them nha san xuat -->
                    <div class="form-group">
                        <label>Nha san xuat</label>                        
                        <select name="nsx_id" class="form-control">
                            <option value=""></option>
                        <?php foreach($dataProducer as $nsx): ?>
                            <option value="<?= $nsx['nsx_id'] ?>"><?= $nsx['nsx_ten'] ?></option>                       
                        <?php endforeach; ?> 
                        </select>
                    </div>
                    <!-- them khuyen mai -->
                    <div class="form-group">
                        <label>Khuyen mai</label>  
                        <div class="form-row">
                            <div class="col-md-6">
                            <select name="km_id" class="form-control">
                            <option value="">Event</option>
                                <?php foreach($dataSaleup as $km): ?>
                                    <option value="<?= $km['km_id'] ?>"><?= $km['km_ten'] ?></option>                                           
                                <?php endforeach; ?> 
                            </select>
                            </div>
                            <div class="col-md-6">
                            <select name="km_id" class="form-control">
                            <option value="">Sale up</option>
                            <option value="">Khong ap dung</option>
                                <?php foreach($dataSaleup as $km): ?>
                                    <option value="<?= $km['km_id'] ?>"><?= $km['km_gia'] ?></option>                                           
                                <?php endforeach; ?> 
                            </select>
                            </div>
                        </div>                                            
                    </div>
                    <div class="form-gorup">
                        <a href="index.php" class="btn btn-secondary">Quay Ve</a>
                        <button name="btn" type="submit" class="btn btn-primary">Create New Product</button>
                    </div>
                    
                </form>
                    
                    <?php
                        if(isset($_POST['btn'])) {
                            $sp_ten = $_POST["sp_ten"];
                            $sp_gia = $_POST["sp_gia"];
                            $sp_giacu = $_POST["sp_giacu"];
                            // $sp_motangan = $_POST["sp_motangan"];
                            $sp_soluong = $_POST["sp_soluong"];
                            $lsp_id = $_POST["lsp_id"];
                            $nsx_id = $_POST["nsx_id"];
                            $km_id = (empty($_POST["km_id"]) ? 'NULL' : $_POST["km_id"]) ;  
                            // kiem tra du lieu truoc khi cho len
                            // validate
                            // gia su ng dung ko co loi 
                            $error = [];  
                            // kiem tra qua tung o san pham 
                            if(empty($sp_ten)) {
                                $error['sp_ten'][] = [
                                    'rule' => 'required',
                                    'rule_value' => true,
                                    'value' => $sp_ten,
                                    'msg' => 'Ten san pham ko dc bo trong'
                                ];
                            }
                            // rule minlength 3
                            else if (strlen($sp_ten) < 3) {
                                $error['sp_ten'][] = [
                                    'rule' => 'minlength',
                                    'rule_value' => 3,
                                    'value' => $sp_ten,
                                    'msg' => 'Ten san pham phai co hon 4 ki tu'
                                ];
                            }
                            // rule maxlength
                            else if (strlen($sp_ten) > 10) {
                                $error['sp_ten'][] = [
                                    'rule' => 'maxlength',
                                    'rule_value' => 10,
                                    'value' => $sp_ten,
                                    'msg' => 'Ten san pham phai co it hon 10 ki tu'
                                ];
                            }
                            // kiem tra o gia
                            if(empty($sp_gia)) {
                                $error['sp_gia'][] = [
                                    'rule' => 'required',
                                    'rule_value' => true,
                                    'value' => $sp_gia,
                                    'msg' => 'Gia san pham ko dc bo trong'
                                ];
                            }
                            if(count($error) == 0) {
                                // tao lien ket sql 
                                include_once __DIR__ . "/connectSQL.php";
                                // // cau lenh muon thuc thi
                                $sqlCreate = "INSERT INTO sampham
                                        (sp_ten, sp_gia, sp_giacu, sp_motangan, sp_ngaycapnhat,sp_soluong, lsp_id, nxv_id, km_id)
                                VALUES ('$sp_ten', $sp_gia,$sp_giacu,'$sp_motangan',NOW(), $sp_soluong, $lsp_id, $nsx_id, $km_id);";
                                // nho php thuc thi
                                $result = mysqli_query($conn,$sqlCreate);
                                // tra ve trang chu
                                echo '<script> location.href="index.php" </script>';
                            }
                         
                        }
                    ?>
            </div>
        </div>
    </div>
    <?php if(isset($_POST['btn']) && isset($error) && count($error) > 0):?>
        <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
            <strong>Error!</strong>Ban phai can nhap dung dinh dang
                <?php foreach($error as $fields) : ?>
                    <?php foreach($fields as $f): ?>
                        <ul>
                            <li><?= $f['msg'] ?></li>
                        </ul>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>


    <?php
        include_once __DIR__ . "/../layout/footer.php"
    ?>

    <?php
        include_once __DIR__ . "/../layout/script.php";
    ?>

    <script>
           ClassicEditor
        .create( document.querySelector( '#sp_motangan' ) )
        .catch( error => {
            console.error( error );
        } );        
    </script>
        


</body>
</html>