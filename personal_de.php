<?php
$link = mysqli_connect(
    'localhost',
    'D1050825',
    '#ohXia4ae',
    'D1050825');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 接收表單提交的資料
    $position_to_delete = $_POST["position_to_delete"];
    
    // 取得原有的職位名稱
    $selectSql = "SELECT 職位名稱 FROM 系主任資料表";
    $selectResult = mysqli_query($link, $selectSql);
    $row = mysqli_fetch_assoc($selectResult);
    $existingPositions = $row['職位名稱'];
    
    // 刪除職位
    if (strpos($existingPositions, $position_to_delete) !== false) {
        // 檢查要刪除的職位是否在職位名稱中
        $newPositions = "";
        $positions = explode("兼", $existingPositions);
        
        foreach ($positions as $position) {
            if ($position != $position_to_delete) {
                // 判斷要刪除的職位在哪個位置（前面或後面）
                if (strpos($position, $position_to_delete) == 0) {
                    // 刪除後面的 "兼" 字
                    $newPositions .= rtrim($position, "兼") . "兼";
                } else {
                    // 刪除前面的 "兼" 字
                    $newPositions .= "兼" . ltrim($position, "兼");
                }
            }
        }
        
        // 移除最後一個 "兼" 字
        $newPositions = rtrim($newPositions, "兼");
        
        // 執行更新資料的 SQL 語句
        $sql = "UPDATE 系主任資料表 SET 職位名稱='$newPositions'";
        
        try {
            $result = mysqli_query($link, $sql);
            $affectedRows = mysqli_affected_rows($link);
            
            if ($affectedRows > 0) {
                $message = "職位 $position_to_delete 刪除成功！";
            } else {
                $message = "未找到符合條件的職位 $position_to_delete";
            }
        } catch (Exception $e) {
            $message = "<p class='error-message'>職位刪除失敗</p>";
            $message .= "<p class='error-message'>" . $e->getMessage() . "</p>";
        }
    } else {
        $message = "<p class='error-message'>職位 $position_to_delete 不存在！</p>";
    }
    
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>刪除職位資料</title>
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
            /* width: 180px; */
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
    <h1>刪除系主任資料</h1>
    <form method="POST" action="">
        <label for="position_to_delete">請輸入要刪除的職位：</label>
        <input type="text" name="position_to_delete" required>

        <input type="submit" value="刪除">
    </form>
    <div id="message"><?php echo $message; ?></div>
    <div class="link">
        <a href="index_b.php">回後台首頁</a> | <a href="personal_se.php">查看系主任資料</a>
    </div>
</body>
</html>