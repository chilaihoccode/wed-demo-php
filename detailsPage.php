<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include_once __DIR__ . "/layout-fontend/style.php";
    ?>
    <title>Trang chi tiet</title>
</head>
<style>
    .container .item {
        border-radius : 6px;
        border : 1px solid tomato;
    }
    .image-primary {
        width: 100%;
    }
    .image-second {
        width : 21%;
        border-radius: 6px;
        height: 21%;
    }
    .signal {
        position: relative;
        top: 22%;
    }
    .signal h4 {
        text-align: center;
    }
    .title {
        font-size : 2em;
    }
    .old-price {
        font-size : 1em;
    }
    button.btn-buy {
        outline: none;
        border: transparent;
        background: transparent;
        width: 100%;
    }
    button.buy {
        width: 100% ;
    }
    button {
        border : 1px solid #dc3545;
        border-radius : 6px;
        background: #dc3545;
        width: 100%;
        padding: 3px;
    }
    svg.add {
        width : 16px;
        height : 16px;
        color : white;
    }
</style>
<body>
<?php
        include_once __DIR__ . "/layout-fontend/header.php";
    ?>
<?php
        // tao lien ket sql
        include_once __DIR__ . "/connectSQL.php";
        $sp_id = $_GET['sp_id'];
        // cau lenh can thuc thi
        $sql = "SELECT * 
                FROM sampham
                WHERE id = $sp_id;
                ";
        // nho php thuc thi
        $result = mysqli_query($conn, $sql);
        // lay du lieu ra tu khoi du lieu
        $data = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data  = array(
                'sp_id' => $row['id'],
                'sp_ten' => $row['sp_ten'],
                'sp_gia' => $row['sp_gia'],
                'sp_giacu' => $row['sp_giacu'],
                'sp_motangan' => $row['sp_motangan'],
            );
        };
        // lay du lieu anh
        
        // cau lenh can thuc thi
        $sqlImage = "SELECT *
                FROM hinhsanpham 
                WHERE sp_id = $sp_id;       
                ";
        // nho php thuc thi
        $resultImage = mysqli_query($conn, $sqlImage);
        // lay du lieu ra tu khoi du lieu
        $dataImage = [];
        while ($row = mysqli_fetch_array($resultImage, MYSQLI_ASSOC)) {
            $dataImage [] = array(
                'hsp_id' => $row['hsp_id'],
                'hsp_teptin' => $row['hsp_teptin'],
                'sp_id' => $row['sp_id'],
            );
        }
        // var_dump($data);   
        // var_dump($dataImage);
    
    ?>
    <div class="container">
    <h1>Trang Chu </h1>
        <div class="row">   
            <div class="col-md-8">
                <?php if (empty($dataImage)) : ?>
                    <img class="image-primary" src="/ex1.com/assests/img/defalutimage.jpg" alt="">
                <?php else : ?>
                    <?php foreach($dataImage as $index => $hsp ) : ?>
                        <?php if($index == 0): ?>
                            <div class="container item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img class="image-primary mt-5 mb-5" src="/ex1.com/assests/uploads/<?= $hsp['hsp_teptin'] ?>" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="signal">
                                            <h4>Tinh nang noi bat</h4>
                                            <p><?= $data['sp_motangan'] ?></p>
                                        </div>                                     
                                    </div>
                                </div>
                            </div>
                           
                        <?php else : ?>
                            <img class="image-second mt-4 ml-2 " src="/ex1.com/assests/uploads/<?= $hsp['hsp_teptin'] ?>" alt="">
                        <?php endif; ?>
                    <?php endforeach; ?>                   
                <?php endif ?>
            </div>
            <div class="col-md-4">
            
                <div class="card" >
                    <div class="card-body">
                    <form action="cart.php" method="post" name="formCart">
                        <!-- lay thong tin qua trang mua hang -->
                            <input type="hidden" name='sp_id' value="<?= $data['sp_id'] ?>">
                            <input type="hidden" name ='sp_ten' value = "<?= $data['sp_ten'] ?>">
                            <input type="hidden" name='sp_gia' value="<?= $data['sp_gia'] ?>">
                            <input type="hidden" name="sp_soluong" id="sp_soluong" >
                            <?php foreach($dataImage as $index => $hsp) : ?>
                                <?php if(empty($hsp)) : ?>
                                    <input type="hidden" name="hsp_teptin" 
                                        value="/ex1.com/assests/img/defalutimage.jpg">
                                <?php else: ?>
                                    <?php if($index == 0) : ?>
                                        <input type="hidden" name="hsp_teptin" 
                                            value="/ex1.com/assests/uploads/<?= $hsp['hsp_teptin'] ?>">
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
  
                        <h5 class="card-title title"><?= $data['sp_ten'] ?></h5>
                        <b><span class="text-danger title"> <?= number_format($data['sp_gia'],0,'.',',')  ?> </span></b>
                        <?php if(($data['sp_giacu'] != $data['sp_gia']) && isset($data['sp_giacu'])): ?>
                            <del><span class="text-muted old-price" > <?= number_format($data['sp_giacu'],0,'.',',')  ?> </span></del>
                        <?php endif; ?>
                        <input type="number" name="sp_soluong" id="sp_soluong" value="1">
                        <p class="card-text"><?= $data['sp_motangan'] ?></p>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 sm-12">
                                    <button class="btn btn-danger buy">Mua ngay</button>
                                </div>
                                <div class="col-md-4 sm-12">
                                    <div class="cart">
                                        <button >
                                            <svg class="item-cart" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                            </svg>
                                           
                                        </button>
                                    </div>                              
                                </div>
                            </div>
                        </div>
                    </form>    
                    </div>
                    </div>
                </div>
            
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