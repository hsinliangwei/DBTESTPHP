<!--test-->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
    <?php
        try{
            $link = mysqli_connect(
                'localhost',
                'D1050825',
                '#ohXia4ae',
                'D1050825');
            echo "MySQL資料庫連接成功!<br>";
            mysqli_close($link);
        } catch (Exception $e) {
            echo "MySQL資料庫連接錯誤!<br>";
            echo $e->getMessage() . "<br>";
        }
        ?>
    </body>
</html>