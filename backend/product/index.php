
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
    <?php
        // phai dang nhap 
        if(!isset($_SESSION['trangthaidangnhap'])) {
            echo 'Ban chua dang nhap ';
            echo '<a href="/ex1.com/backend/signup.php">Dang nhap</a>';
            die;
        }
        // dang nhap ko vao data
        if (isset($_SESSION['trangthaidangnhap']) && $_SESSION['trangthaidangnhap'] == false) {
            echo 'ban da dang nhap that bai';
            echo '<a href="/ex1.com/backend/signup.php">Dang nhap</a>';
            die;
        }
        // ban phai co quyen 
        if (isset($_SESSION['kh_quantri']) && $_SESSION['kh_quantri'] == false ) {
            echo 'ban ko co quyen ';
            echo '<a href="/ex1.com/backend/signup.php">Dang nhap</a>';
            die;
        }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-3 lg-4">
                <?php
                    include_once __DIR__ . "/../layout/sidebar.php";
                ?>
            </div>
            <div class="col-md-9 lg-8">
                <h1>Noi dung san pham</h1><br>
                <a href="create.php" class="btn btn-primary mb-2">ADD PRODUCT</a>
                <?php 
                    // tao ket noi sql 
                    include_once __DIR__ . "/connectSQL.php";
                    // cau lenh can thuc thi
                    $sql = "SELECT sp.*,
                            lsp.lsp_ten
                        FROM sampham AS sp
                        JOIN loaisanpham AS lsp ON sp.lsp_id = lsp.lsp_id;";
                    // nho php thuc thi dum 
                    $result = mysqli_query($conn,$sql);
                    // boc tach lay tung du lieu ra khoi du lieu jagged array
                    $data  = [];
                    while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                        $data [] = array (
                            'sp_id' => $row['id'],
                            'sp_ten' => $row['sp_ten'],
                            'sp_gia' => $row['sp_gia'],
                            'sp_giacu' => $row['sp_giacu'],
                            'sp_motangan' => $row['sp_motangan'],
                            'sp_soluong' => $row['sp_soluong'],
                            'lsp_ten' => $row['lsp_ten'],
                        );
                    }
                    
                ?>
                <table id="list" class="table table-striped table-hover ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>SP_TEN</th>
                            <th>GIA</th>
                            <th>MO TA NGAN</th>
                            <th>SO LUONG</th>
                            <th>LOAI SAN PHAM</th>
                            <th>CHINH SUA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $sp): ?>
                            <tr>
                                <td><?= $sp['sp_id'] ?></td>
                                <td><?= $sp['sp_ten'] ?></td>
                                <td>
                                    <?= number_format($sp['sp_gia'],0,'.',',')  ?><br>
                                    <small><del><?= number_format( $sp['sp_giacu'],0,'.',',') ?></del></small>
                                </td>
                                <td><?= $sp['sp_motangan'] ?></td>
                                <td><?= $sp['sp_soluong'] ?></td>
                                <td><?= $sp['lsp_ten'] ?></td>
                                <td>
                                    <a href="update.php?sp_id=<?= $sp['sp_id'] ?>" class="btn btn-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                    Sua
                                    </a>

                                    <a href=# class="btn btn-danger btn-delete" data-sp_id=<?= $sp['sp_id'] ?>>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                        Xoa
                                    </a>
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
            let sp_id = $(this).data('sp_id')
            let verify = confirm('Are You Sure Delete')
            console.log(verify)
            if (verify == true) {
                location.href = "delete.php?sp_id=" + sp_id;
            }

        })
    </script>

</body>
</html>