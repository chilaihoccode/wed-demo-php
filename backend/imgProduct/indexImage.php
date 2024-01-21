<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include_once __DIR__ . "/../layout/style.php";
    ?>
    <title>product</title>
</head>
<style>
    div{
        
    }
    svg{
        color: #333;
        height: 16px;
        weight: 16px;
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
            $sql = "SELECT hsp.*,sp.sp_ten
                    FROM hinhsanpham AS hsp
                        JOIN sampham AS sp ON hsp.sp_id = sp.id;";
            // nho php thuc thi
            $result = mysqli_query($conn,$sql);
            // boc tach du lieu ra 
            $data = [];
            while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                $data [] = array (
                    'hsp_id' => $row['hsp_id'],
                    'hsp_teptin' => $row['hsp_teptin'],
                    'sp_ten' => $row['sp_ten']
                );                
            }

        ?>
            <div class="col-md-9 lg-8">
                <h1>Noi dung danh sach hinh anh</h1><br>
                <a href="createImg.php" class="btn btn-primary mb-2">ADD IMAGE PRODUCT</a>
                <table class="table table-striped table-hover ">
                    <thead>
                        <tr>
                            <th>ID Hinh san pham </th>
                            <th>Hinh san pham tap tin</th>
                            <th>San pham ten </th>
                            <th>Hanh dong </th>
                        </tr>                   
                    </thead>
                    <tbody>
                        <?php foreach($data as $hsp): ?>
                            <tr>
                                <td><?= $hsp['hsp_id'] ?></td>
                                <td>
                                    <img src="/ex1.com/assests/uploads/<?= $hsp['hsp_teptin'] ?>" alt="Image"
                                    style="max-width : 200px">
                                </td>
                                <td><?= $hsp['sp_ten'] ?></td>
                                <td>
                                    <a href=# class="btn btn-danger btn-delete" data-hsp_id=<?= $hsp['hsp_id'] ?>>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>    
                                    Xoa</a>
                                    <a href="update.php?hsp_id=<?= $hsp['hsp_id'] ?>" class="btn btn-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>    
                                    Sua</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>


    <?php
        include_once __DIR__ . "/../layout/footer.php";
    ?>

    <?php
        include_once __DIR__ . "/../layout/script.php";
    ?>
    <script>
        $('.btn-delete').click(function() {
            let hsp_id = $(this).data('hsp_id');
            let verify = confirm('Are You Sure Delete')
            console.log(verify)
            if (verify == true) {
                location.href = "delete.php?hsp_id=" + hsp_id;
            }

        })
    </script>
</body>
</html>