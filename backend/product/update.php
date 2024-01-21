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
    body{
        margin-left: 40px;
    }
</style>
<body>
   <!-- select cac lsp nsx  -->
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
 
    <!-- lay ra du lieu cu -->
    <?php
            $sp_id = $_GET["sp_id"];
            // tao lien ket sql 
            include_once __DIR__ . "/connectSQL.php";
            // cau lenh muon thuc thi
            $sql = "SELECT sp.*,
                        lsp.lsp_id,lsp.lsp_ten,
                        nsx.*,
                        km.*
                    FROM sampham AS sp
                        JOIN loaisanpham AS lsp ON sp.lsp_id = lsp.lsp_id
                        JOIN nhasanxuat AS nsx ON sp.nxv_id = nsx.nsx_id
                        JOIN khuyenmai AS km ON sp.km_id = km.km_id
                    WHERE id = $sp_id;";
            // nho php thuc thi
            $result = mysqli_query($conn,$sql);
            // boc tach du lieu theo jagged array
            $data = [];
            while ($rowEdit = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                $data = array(
                    'sp_ten' => $rowEdit['sp_ten'],
                    'sp_gia' => $rowEdit['sp_gia'],
                    'sp_giacu' => $rowEdit ['sp_giacu'],
                    'sp_motangan' =>$rowEdit ['sp_motangan'],
                    'sp_soluong' => $rowEdit ['sp_soluong'],
                    'lsp_id' => $rowEdit ['lsp_id'],
                    'lsp_ten' => $rowEdit ['lsp_ten'],
                    'nsx_id' => $rowEdit ['nsx_id'],
                    'nsx_ten' => $rowEdit ['nsx_ten'],
                    'km_id' => $rowEdit ['km_id'],
                    'km_gia' => $rowEdit ['km_gia'],
                    'km_ten' => $rowEdit ['km_ten']
                );
            }
    ?>

        <h1>Sua san pham</h1>
        <form action="" method="POST" name="formCreate" id="formCreate" >
                    <div class="form-group">
                        <label for="nameproduct">San pham moi</label><br>
                        <input class="form-control nameProduct" type="text" id="nameproduct" name="sp_ten" value="<?= $data['sp_ten'] ?>">
                        <small class=" text-danger"></small>
                        <br>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="priceproductnew">Gia san pham</label><br>
                                <input type="text" class="form-control price" id="priceproductnew" name="sp_gia" value="<?= number_format($data['sp_gia'],0,',','.')  ?>">                   
                                <small class=" text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="priceproductold">Gia cu san pham</label><br>
                                <input type="text" class="form-control oddPrice " id="priceproductold" name="sp_giacu" value="<?= number_format($data['sp_giacu'],0,',','.')?>">                  
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
                        <input type="number" name="sp_soluong" id="number" class="form-control" value = "<?= $data['sp_soluong'] ?>">
                    </div>
                    <!-- them loai san pham -->
                    <div class="form-group">
                        <label>Loai San Pham</label>                        
                        <select name="lsp_id" class="form-control">
                            <!-- <option value=""></option> -->
                        <?php foreach($dataCategory as $lsp): ?>
                            <?php if($lsp['lsp_id'] = $rowEdit['lsp_id']): ?>
                                <option value="<?= $lsp['lsp_id'] ?> selected"><?= $lsp['lsp_ten'] ?></option>  
                            <?php else: ?>
                                <option value="<?= $lsp['lsp_id']  ?>"><?= $lsp['lsp_ten'] ?></option>  
                            <?php endif; ?>                    
                        <?php endforeach; ?> 
                        </select>
                    </div>
                    <!-- them nha san xuat -->
                    <div class="form-group">
                        <label>Nha san xuat</label>                        
                        <select name="nsx_id" class="form-control">                           
                        <?php foreach($dataProducer as $nsx): ?>
                            <?php if($nsx['nsx_id'] = $rowEdit['nsx_id']): ?>
                                <option value="<?= $nsx['nsx_id'] ?> selected"><?= $nsx['nsx_ten'] ?></option> 
                            <?php else: ?>
                                <option value="<?= $nsx['nsx_id'] ?>"><?= $nsx['nsx_ten'] ?></option> 
                            <?php endif; ?>
                                                  
                        <?php endforeach; ?> 
                        </select>
                    </div>
                    <!-- them khuyen mai -->
                    <div class="form-group">
                        <label>Khuyen mai</label>  
                        <div class="form-row">
                            <div class="col-md-6">
                            <select name="km_id" class="form-control">
                             
                                
                                <?php foreach($dataSaleup as $km): ?>
                                    <?php if($km['km_id'] = $data['km_id']): ?>
                                        <option value="<?= $km['km_id'] ?> selected"><?= $km['km_ten'] ?></option>
                                    <?php else: ?>
                                        <option value="<?= $km['km_id'] ?>"><?= $km['km_ten'] ?></option>
                                    <?php endif; ?>
                                                                               
                                <?php endforeach; ?> 
                            </select>
                            </div>
                            <div class="col-md-6">
                            <select name="km_id" class="form-control">
                                <?php if(empty($data['km_id'])): ?>
                                    <option value="" selected>khong ap dung </option>
                                <?php else: ?>
                                    <option value="">khong ap dung </option>
                                <?php endif; ?>
                                <?php foreach($dataSaleup as $km): ?>
                                    <?php if($km['km_id'] = $data['km_id']) : ?>
                                        <option value="<?= $km['km_id'] ?> selected"><?= $km['km_gia'] ?></option> 
                                    <?php else: ?>
                                        <option value="<?= $km['km_id'] ?> "><?= $km['km_gia'] ?></option> 
                                    <?php endif; ?>
                                                                              
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
                            echo 'lsp la: '. $sp_id .$sp_ten;
                                // tao lien ket sql 
                                include_once __DIR__ . "/connectSQL.php";
                                // // cau lenh muon thuc thi
                                $sqlUpdate = "UPDATE sampham
                                        SET sp_ten = '$sp_ten',
                                            -- sp_ngaycapnhat=NOW(),
                                                                
                                        WHERE id = $sp_id";
                                // nho php thuc thi
                                $resultUpdate = mysqli_query($conn,$sqlUpdate);
                                // tra ve trang chu
                                // echo '<script> location.href="index.php" </script>';
                              
                                
                        }
                        var_dump($resultUpdate);die;                      
                ?>
            </div>
        </div>
    </div>
    <?php
        include_once __DIR__ . "/../layout/footer.php"
    ?>

    <?php
        include_once __DIR__ . "/../layout/script.php";
    ?>


</body>
</html>