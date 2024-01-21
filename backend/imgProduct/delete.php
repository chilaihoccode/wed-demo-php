<!-- lay du lieu o can xoa  -->
<?php 
    $hsp_id = $_GET['hsp_id'];
    // echo 'id la ' . $hsp_id;
    // lay bang ket noi 
    include_once __DIR__ . "/connectSQL.php";
    // cau lenh muon thuc thi
    $sql = "SELECT * 
            FROM hinhsanpham
            WHERE hsp_id = $hsp_id;";
    // nho php thuc thi
    $result = mysqli_query($conn,$sql);
    // lay du lieu ra tu khoi du lieu
    $data = [];
    while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
        $data = [
            'hsp_id' => $row['hsp_id'],
            'hsp_teptin' => $row['hsp_teptin']
        ];
    }
    var_dump($data);
    // xoa tap tin rac
    $uploadDir = __DIR__ . "/../../assests/uploads/";
    unlink($uploadDir . $data['hsp_teptin']);

    //xoa du lieu tren data
    // cau lenh muon thuc thi
    $splImage = "DELETE FROM hinhsanpham
                WHERE hsp_id = $hsp_id;";
    // nho php thuc thi
    mysqli_query($conn,$splImage);
    // dieu huong ve trang chu
    echo '<script> location.href="indexImage.php" </script>;';
?> 