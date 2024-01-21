<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <button type="button" name="add" onclick="addNum(this)">+</button>
            <input type="number" id="num" name="num" value="1">
            <button type="button" name="substraction" onclick="subsNum(this)">-</button>
            <button type="submit" name="btn">gui</button>
        </form>
    </div>
    <?php
    if(isset($_POST['btn'])) {
        $num = $_POST['num'];
        echo 'num la : ' . $num;
    }
     
    ?>
    <script>
        const inputElament = document.querySelector('#num');
        console.log(inputElament.value)
        const addNum = (element) => {
            return inputElament.value++
        }
        const subsNum = (element) => {
            return inputElament.value--
        }
    </script>
</body>
</html>