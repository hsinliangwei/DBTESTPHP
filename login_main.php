<!DOCTYPE html>
<html lang="en">

    <head>
        <title>登入畫面</title>
        <meta charset="utf-8">
        <style>
            html,
            body {
                height: 100%;
                margin: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: antiquewhite;
            }

            .container {
                width: 300px;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 4px;
                text-align: center;
                background-color: #ccc;
            }

            .container input {
                width: 90%;
                padding: 10px;
                margin-bottom: 20px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            .container button {
                width: 100%;
                padding: 10px;
                background-color: #5675af;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            .container .homepage-button {
                margin-top: 20px;
                text-align: center;
                border: 1px solid #ccc;
                background-color: transparent;
                padding: 10px;
                border-radius: 4px;
                cursor: pointer;
            }
            .error-message {
        color: red;
        margin-top: 10px;
    }

        </style>
    </head>

    <body>
    <?php
$link = mysqli_connect('localhost', 'D1050825', '#ohXia4ae', 'D1050825');

if (!$link) {
    echo "MySQL資料庫連接錯誤!<br>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputStudentId = $_POST["inputStudentId"];
    $inputPassword = $_POST["inputPassword"];

    $sql = "SELECT * FROM 帳號資料表 WHERE 帳號='$inputStudentId' AND 密碼='$inputPassword'";
    $result = mysqli_query($link, $sql);
    $rowCount = mysqli_num_rows($result);

    if ($rowCount > 0) {
        echo "帳號密碼驗證成功，將重導向至資料頁面<br>";
        echo "<script>window.location.href = 'index_b.php';</script>";// 呼叫 JavaScript 函式進行重導向
        exit(); // 結束程式碼執行，避免輸出其他內容
    } else {
        $errorMessage = "帳號密碼驗證失敗";
    }
}

mysqli_close($link);
?>

<div class="container">
    <h2>登入畫面</h2>
    <form method="POST" action="">
        <input type="text" name="inputStudentId" placeholder="學號"><br>
        <input type="password" name="inputPassword" placeholder="密碼"><br>
        <button type="submit">登入</button>
        <br>
        <hr> <!-- 分隔線 -->
    <a href="test.php" class="homepage-button">返回主頁</a>

    <p class="error-message"><?php echo $errorMessage; ?></p>
    </form>
</div>




<script>
    function goToDataPage() {
        window.location.href = "index_b.php";
    }
</script>
    </body>

</html>
