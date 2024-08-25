<?php
$link = mysqli_connect(
    'localhost',
    'D1050825',
    '#ohXia4ae',
    'D1050825');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // 接收表單提交的資料
        $old_position = $_POST["old_position"];
        $new_position = $_POST["new_position"];
        

        // 檢查職位名稱是否已存在
        $existingPositionQuery = "SELECT 職位名稱 FROM 系主任資料表";
        $existingPositionResult = mysqli_query($link, $existingPositionQuery);
        $existingPositions = mysqli_fetch_all($existingPositionResult, MYSQLI_ASSOC);

        $isExistingPosition = false;

        foreach ($existingPositions as $existingPosition) {
            $positions = explode("兼", $existingPosition['職位名稱']);
            
            // 判斷職位名稱是否已存在
            if (in_array($new_position, $positions)) {
                $isExistingPosition = true;
                break;
            }
        }

        if ($isExistingPosition) {
            $message = "<p class='error-message'>職位 $new_position 已存在！請輸入不同職位</p>";
        } else {

            // 取得原有的職位名稱
            $selectSql = "SELECT 職位名稱 FROM 系主任資料表";
            $selectResult = mysqli_query($link, $selectSql);
            $row = mysqli_fetch_assoc($selectResult);
            $existingPositions = $row['職位名稱'];
            
            // 使用字串替換將舊職位替換為新職位
            $newPositions = str_replace($old_position, $new_position, $existingPositions);
        
            // 執行更新資料的 SQL 語句
            $sql = "UPDATE 系主任資料表 SET 職位名稱='$newPositions'";
        
            try {
                $result = mysqli_query($link, $sql);
                $affectedRows = mysqli_affected_rows($link);
                
                if ($affectedRows > 0) {
                    $message = "職位更新成功！<br><br>";
                    $message .= "更新的欄位：<br>";
                    $message .="（原始值：" . $old_position . "，新值：" . $new_position . "）";
                } else {
                    $message = "<p class='error-message'>未找到符合條件的職位 $old_position</p>";
                }
            } catch (Exception $e) {
                $message = "<p class='error-message'>職位更新失敗</p>";
                $message .= "<p class='error-message'>" . $e->getMessage() . "</p>";
            }
        }
        mysqli_close($link);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>更新職位資料</title>
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
    <h1>更新職位資料</h1>
    <form method="POST" action="">
        <label for="old_position">輸入要更新的職位：</label>
        <input type="text" name="old_position" required>

        <label for="new_position">更新職位：</label>
        <input type="text" name="new_position" required>
        
        <input type="submit" value="確認">
    </form>
    <div id="message"><?php echo $message; ?></div>
    <div class="link">
        <a href="index_b.php">回後台首頁</a> | <a href="personal_se.php">查看職位資料</a>
    </div>
</body>
</html>