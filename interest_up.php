<?php
$link = mysqli_connect(
    'localhost',
    'D1050825',
    '#ohXia4ae',
    'D1050825');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 接收表單提交的資料
    $id = $_POST["id"];
    $newChinese = $_POST["newChinese"];
    $newEnglish = $_POST["newEnglish"];
    
    // 查詢資料庫中是否存在相同的專長
    $checkQuery = "SELECT COUNT(*) as count FROM 專長資料表 WHERE 專長項目_中文 = '$newChinese'";
    $checkResult = mysqli_query($link, $checkQuery);
    $count = mysqli_fetch_assoc($checkResult)['count'];
    
    // 如果存在相同的專長項目，顯示錯誤並中止更新操作
    if ($count > 0) {
        $message = "<p class='error-message'>Error：專長項目 $newChinese 已存在，請輸入不同的專長項目</p>";
    } else {
        // 查詢原始的專長項目
        $selectSql = "SELECT * FROM 專長資料表 WHERE 專長編號=$id";
        $selectResult = mysqli_query($link, $selectSql);
        $row = mysqli_fetch_assoc($selectResult);

        // 保存更新前的字段信息
        $oldFields = array();
        $updatedFields = array();

        if ($row) {
            $oldFields['專長項目_中文'] = $row['專長項目_中文'];
            $oldFields['專長項目_英文'] = $row['專長項目_英文'];
        }

        // 執行更新資料的 SQL 語句
        $updateSql = "UPDATE 專長資料表 SET ";
        $updatedFieldsCount = 0;

        if (!empty($newChinese)) {
            $updateSql .= "專長項目_中文='$newChinese'";
            $updatedFields['專長項目_中文'] = $newChinese;
            $updatedFieldsCount++;
        }
    
        if (!empty($newEnglish)) {
            if ($updatedFieldsCount > 0) {
                $updateSql .= ", ";
            }
            $updateSql .= "專長項目_英文='$newEnglish'";
            $updatedFields['專長項目_英文'] = $newEnglish;
            $updatedFieldsCount++;
        }

        $updateSql .= " WHERE 專長編號=$id";
        
        
        try {
            if ($updatedFieldsCount > 0) {
                $result = mysqli_query($link, $updateSql);
                //影響幾列
                $affectedRows = mysqli_affected_rows($link);
                if ($affectedRows > 0) {
                    $message = "更新第 " . $id . " 個專長資料成功！<br><br>";
                    $message .= "更新的欄位：<br>";
                    foreach ($updatedFields as $field => $value) {
                        $message .= $field . "（原始值：" . $oldFields[$field] . "，新值：" . $value . "）";
                        if ($field !== array_key_last($updatedFields)) {
                            $message .= "，";
                        }
                    }
                } else {
                    $message = "<p class='error-message'>更新第 " . $id . " 個專長資料失敗！</p>";
                }
            } else {
                $message = "<p class='error-message'>未更新任何欄位</p>";
            }
        } catch (Exception $e) {
            $message = "<p class='error-message'>專長號碼更新失敗！</p>";
            $message .= "<p class='error-message'>" . $e->getMessage() . "</p>";
        }
    }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>更新專長資料</title>
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
            width: 200px;
            text-align: right;
            margin-bottom: 10px;
            
        }
        
        input[type="text"] {
            padding: 5px;
            width: 200px;
            margin-bottom: 10px;
            margin-right: 120px;
        }
        
        input[type="submit"] {
            background-color: #5675af;
            color: #FFFFFF;
            border: none;
            padding: 10px 20px;
            text-transform: uppercase;
            margin-top: 10px;
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
    <h1>更新專長資料</h1>
    <form method="POST" action="">
        <label for="id">專長編號：</label>
        <input type="text" name="id" required><br>

        <label for="newChinese">更新專長項目(中文)：</label>
        <input type="text" name="newChinese"><br>


        <label for="newEnglish">更新專長項目(英文)：</label>
        <input type="text" name="newEnglish"><br>

        <input type="submit" value="確認">
    </form>
    <div id="message"><?php echo $message; ?></div>
    <div class="link">
        <a href="index_b.php">回後台首頁</a> | <a href="interest_se.php">查看專長資料</a>
    </div>
</body>
</html>