<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="mainContainer">
        
        <?php require $router -> content ?>

    </div>
    <style>
        <?php 
        require dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR . 'style' . DIRECTORY_SEPARATOR . 'global.php';
        require dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR . 'style' . DIRECTORY_SEPARATOR . 'homeStyle.php';
        require dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR . 'style' . DIRECTORY_SEPARATOR . 'loginStyle.php';
        ?>
    </style>
</body>
</html>