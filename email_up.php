<?php
$link = mysqli_connect(
    'localhost',
    'D1050825',
    '#ohXia4ae',
    'D1050825');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 接收表單提交的資料
    $id = $_POST["id"];
    $newEmail = $_POST["newEmail"];

    // 查詢資料庫中是否存在相同的信箱
    $checkQuery = "SELECT COUNT(*) as count FROM 信箱資料表 WHERE 信箱 = '$newEmail'";
    $checkResult = mysqli_query($link, $checkQuery);
    $count = mysqli_fetch_assoc($checkResult)['count'];

    // 如果存在相同的信箱，顯示錯誤並中止更新操作
    if ($count > 0) {
        $message = "<p class='error-message'>Error：信箱 $newEmail 已存在，請輸入不同的信箱</p>";
    } else {
        // 查詢原始的信箱
        $selectSql = "SELECT 信箱 FROM 信箱資料表 WHERE 信箱編號=$id";
        $selectResult = mysqli_query($link, $selectSql);
        $row = mysqli_fetch_assoc($selectResult);
        $oldEmail = $row['信箱'];

        // 執行更新資料的 SQL 語句
        $sql = "UPDATE 信箱資料表 SET 信箱='$newEmail' WHERE 信箱編號=$id";
        $result = mysqli_query($link, $sql);
        
        if ($result) {
            //影響幾列
            $affectedRows = mysqli_affected_rows($link);
            if ($affectedRows > 0) {
                $message = "第" . $id . "個信箱更新成功！<br><br>";
                $message .= "原始的信箱：$oldEmail<br>";
                $message .= "更新後的信箱：$newEmail";
            } else {
                $message = "<p class='error-message'>未找到符合條件的信箱編號$id</p>";
            }
        } else {
            $message = "<p class='error-message'>分機號碼更新失敗：" . mysqli_error($link) . "</p>";
        }
    }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>更新信箱資料</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F5F5F5;
        }
        
        h1 {
            background-color: #bac7e0;
            padding: 20px;
            text-align: center;
        }
        
        form {
            text-align: center;
            margin-top: 20px;
        }
        
        label {
            display: inline-block;
            width: 150px;
            text-align: right;
        }
        
        input[type="text"] {
            padding: 5px;
            width: 200px;
        }
        
        input[type="submit"] {
            background-color: #5675af;
            color: #FFFFFF;
            border: none;
            padding: 10px 20px;
            text-transform: uppercase;
            cursor: pointer;
        }
        
        input[type="submit"]:hover {
            background-color: #435983;
        }
        
        .link {
            text-align: center;
            margin-top: 20px;
        }
        
        .link a {
            color: #5675af;
            text-decoration: none;
        }
        
        .link a:hover {
            color: #263b61;
            text-decoration: underline;
        }

        #message {
            display: <?php echo empty($message) ? 'none' : 'block'; ?>;
            margin-top: 20px;
            text-align: center;
            padding: 10px;
            background-color: #f2f2f2;
            color: #333;
        }

        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <h1>更新信箱資料</h1>
    <form method="POST" action="">
        <label for="id">信箱編號：</label>
        <input type="text" name="id" required>
        <label for="newEmail">更新信箱：</label>
        <input type="text" name="newEmail" required>
        <input type="submit" value="確認">
    </form>
    <div id="message"><?php echo $message; ?></div>
    <div class="link">
        <a href="index_b.php">回後台首頁</a> | <a href="email_se.php">查看信箱資料</a>
    </div>
</body>
</html>