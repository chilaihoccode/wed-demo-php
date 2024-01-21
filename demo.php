

    <?php
        // tao ket noi vs bang data
        include_once __DIR__ . "/connectSQL.php";
        $sp_id = $_GET['sp_id'];

        // cau lenh can thuc thi
        $sql = "SELECT *,
            FROM sampham
            WHERE id = $sp_id;";
        // nho php thuc thi dum 
        $result = mysqli_query($conn,$sql);
        // boc tach 
        $data = [];
        while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
            $data = [
                'sp_id' => $row['sp_id'],
            ];
        }
        var_dump($result);
    ?>