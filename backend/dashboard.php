<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include_once __DIR__ . "/layout/style.php";
    ?>
    <title>DASHBOARD</title>
</head>
<style>
    div{
        border : 1px solid red ;
    }
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
                <h1>Noi dung khach hang</h1><br>
                <br><br><br><br><br><br>

                <div id="editor"></div>
            </div>
        </div>
    </div>


    <?php
        include_once __DIR__ . "/layout/footer.php";
    ?>

    <?php
        include_once __DIR__ . "/layout/script.php";
    ?>

        <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .catch( error => {
                    console.error( error );
                } );
        </script>
</body>
</html>