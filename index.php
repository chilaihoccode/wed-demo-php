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
    div{
        /* border : 1px solid red ; */
    }
    ul#list-product {
        display : flex;
        flex-wrap : wrap;
        list-style: none;
        padding : 0;
    }
    ul#list-product li a{
        text-decoration: none;
        color : grey;
    }
    .form-group {
        display : flex ;
    }
    .form-group .rate {
        display : flex ;
        position : absolute;
        bottom : 2%;
    }
    .form-group .rate a.icon-stars svg {
        width : 20px;
        height : 20px ;
        color : #f59e0b;
    }
    .form-group a#icon-heart {
        background-color: transparent;
        outline: none;
        border: none;
        position: absolute;
        left: 80%;
        bottom: 1%;
    }
    svg.icon {
        width : 28px;
        height : 24px ;
        color : #e31616;
    }

</style>
<body>
    <?php
        include_once __DIR__ . "/layout-fontend/header.php";
    ?>

    <?php
        // tao ket noi vs bang data
        include_once __DIR__ . "/connectSQL.php";
        // cau lenh can thuc thi
        $sql = "SELECT sp.id, sp.sp_ten,sp.sp_gia, sp.sp_giacu, sp.sp_motangan, 
                        MAX(hsp.hsp_teptin) AS hsp_teptin 
                FROM sampham AS sp
                    LEFT JOIN hinhsanpham AS hsp ON hsp.sp_id = sp.id
                GROUP BY sp.id, sp.sp_ten,sp.sp_gia, sp.sp_giacu, sp.sp_motangan;";
        // nho php thuc thi gium 
        $result = mysqli_query($conn,$sql);
        // var_dump($result);die;
        // phan tach du lieu
        $data = [];
        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
            $data [] =[
                'sp_id' => $row['id'],
                'sp_ten' => $row['sp_ten'],
                'sp_gia' => $row['sp_gia'],
                'sp_giacu' => $row['sp_giacu'],
                'sp_motangan' => $row['sp_motangan'],
                'hsp_teptin' => $row['hsp_teptin'],
            ];
        }
        // var_dump($data);

    ?>
    <div class="container">
    <h1>Trang Chu </h1>
        <div class="row">   
            <ul id="list-product">
                <?php foreach($data as $sp) : ?>
                    
                    <div class="col-md-3 ">
                        <li><a href="detailsPage.php?sp_id=<?= $sp['sp_id']?>">
                            <div class="card mb-4">
                                <?php if(!empty($sp['hsp_teptin'])) : ?>
                                    <img src="/ex1.com/assests/uploads/<?= $sp['hsp_teptin'] ?>" class="card-img-top" alt="<?= $sp['sp_ten'] ?>">
                                <?php else: ?>
                                    <img src="/ex1.com/assests/img/defalutimage.jpg" class="card-img-top" alt="...">
                                <?php endif; ?>
                                <div class="card-body">
                                    <b> <h5 class="card-title"><?= $sp['sp_ten'] ?></h5> </b>                      
                                    <b> <span class="text-danger"><?= number_format($sp['sp_gia'],0,'.','.')  ?></span></b>
                                    <?php if(($sp['sp_giacu'] != $sp['sp_gia']) && !empty($sp['sp_giacu'])): ?>
                                        <del><span class ="text-muted"><?= number_format($sp['sp_giacu'],0,'.','.')  ?></span></del>
                                
                                    <?php endif; ?>
                                
                                    <p class="card-text"><?= $sp['sp_motangan'] ?></p>
                                    <div class="form-group">
                                        <div class="rate">
                                            <a href="" class="icon-stars">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                                </svg>
                                            </a>
                                            <a href="" class="icon-stars">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                                </svg>
                                            </a>
                                            <a href="" class="icon-stars">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                                </svg>
                                            </a>
                                            <a href="" class="icon-stars">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                                </svg>
                                            </a>
                                            <a href="" class="icon-stars">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                                </svg>
                                            </a>
                                            <a href="" class="icon-stars">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                                </svg>
                                            </a>
                                        </div>
                                        <a href="" id="icon-heart">
                                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                            </svg>
                                        </a>
                                    </div>
                                 
                                </div>
                            </div>
                        </li >    
                    </div>
                <?php endforeach; ?>
                
            </ul>                    
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