<?php
$link = mysqli_connect(
    'localhost',
    'D1050825',
    '#ohXia4ae',
    'D1050825');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 接收表單提交的資料
    $id = $_POST["id"];
    $newCourse_id = $_POST["newCourse_id"];
    $newCategory = $_POST["newCategory"];
    $newCredit = $_POST["newCredit"];
    $newTime = $_POST["newTime"];
    $newDescription = $_POST["newDescription"];
    
    // 查詢資料庫中是否存在相同的教學大綱
    $checkQuery = "SELECT COUNT(*) as count FROM 教學大綱資料表 WHERE 課程編號 = '$newCourse_id'";
    $checkResult = mysqli_query($link, $checkQuery);
    $count = mysqli_fetch_assoc($checkResult)['count'];

    // 如果存在相同的教學大綱項目，顯示錯誤並中止更新操作
    if ($count > 0) {
        $message = "<p class='error-message'>Error： $newCourse_id 課程教學大綱已存在，請輸入不同的課程編號</p>";
    } else {
        // 查詢原始的教學大綱項目
        $selectSql = "SELECT * FROM 教學大綱資料表 WHERE 教學大綱編號=$id";
        $selectResult = mysqli_query($link, $selectSql);
        $row = mysqli_fetch_assoc($selectResult);

        // 保存更新前的字段信息
        $oldFields = array();
        $updatedFields = array();

        if ($row) {
            $oldFields['課程編號'] = $row['課程編號'];
            $oldFields['必選修'] = $row['必選修'];
            $oldFields['學分數'] = $row['學分數'];
            $oldFields['上課時間'] = $row['上課時間'];
            $oldFields['課程描述'] = $row['課程描述'];
        }

        // 執行更新資料的 SQL 語句
        $updateSql = "UPDATE 教學大綱資料表 SET ";
        $updatedFieldsCount = 0;

        if (!empty($newCourse_id)) {
            $updateSql .= "課程編號='$newCourse_id'";
            $updatedFields['課程編號'] = $newCourse_id;
            $updatedFieldsCount++;
        }
    
        if (!empty($newCategory)) {
            if ($updatedFieldsCount > 0) {
                $updateSql .= ", ";
            }
            $updateSql .= "必選修='$newCategory'";
            $updatedFields['必選修'] = $newCategory;
            $updatedFieldsCount++;
        }

        if (!empty($newCredit)) {
            if ($updatedFieldsCount > 0) {
                $updateSql .= ", ";
            }
            $updateSql .= "學分數='$newCredit'";
            $updatedFields['學分數'] = $newCredit;
            $updatedFieldsCount++;
        }

        if (!empty($newTime)) {
            if ($updatedFieldsCount > 0) {
                $updateSql .= ", ";
            }
            $updateSql .= "上課時間='$newTime'";
            $updatedFields['上課時間'] = $newTime;
            $updatedFieldsCount++;
        }

        if (!empty($newDescription)) {
            if ($updatedFieldsCount > 0) {
                $updateSql .= ", ";
            }
            $updateSql .= "課程描述='$newDescription'";
            $updatedFields['課程描述'] = $newDescription;
            $updatedFieldsCount++;
        }

        $updateSql .= " WHERE 教學大綱編號=$id";
        
        
        try {
            if ($updatedFieldsCount > 0) {
                $result = mysqli_query($link, $updateSql);
                //影響幾列
                $affectedRows = mysqli_affected_rows($link);
                if ($affectedRows > 0) {
                    $message = "更新第 " . $id . " 個教學大綱資料成功！<br><br>";
                    $message .= "更新的欄位：<br>";
                    foreach ($updatedFields as $field => $value) {
                        $message .= $field . "（原始值：" . $oldFields[$field] . "，新值：" . $value . "）";
                        if ($field !== array_key_last($updatedFields)) {
                            $message .= "，";
                        }
                    }
                } else {
                    $message = "<p class='error-message'>更新第 " . $id . " 個教學大綱資料失敗！</p>";
                }
            } else {
                $message = "<p class='error-message'>未更新任何欄位</p>";
            }
        } catch (Exception $e) {
            $message = "<p class='error-message'>教學大綱號碼更新失敗！</p>";
            $message .= "<p class='error-message'>" . $e->getMessage() . "</p>";
        }
    }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>更新教學大綱資料</title>
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
            margin-bottom: 10px;
        }
        
        input[type="text"] {
            padding: 5px;
            width: 200px;
            margin-bottom: 10px;
            margin-right: 100px;
        }

        select {
            padding: 5px;
            width: 210px;
            margin-bottom: 10px;
            vertical-align: middle;
            margin-right: 100px;
        }

        select option {
            padding: 5px;
        }
        
        textarea {
            display: inline-block;
            padding: 5px;
            width: 200px;
            height: 50px;
            /* resize: vertical; */
            margin-bottom: 10px;
            vertical-align: middle;
        }
        
        input[type="submit"] {
            background-color: #5675af;
            color: #FFFFFF;
            border: none;
            padding: 10px 20px;
            text-transform: uppercase;
            cursor: pointer;
            margin-top: 15px;
        }
        
        input[type="submit"]:hover {
            background-color: #435983;
        }
        
        .link {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
            margin-left: 50px;
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
    <h1>更新教學大綱資料</h1>
    <form method="POST" action="">
        <label for="id">教學大綱編號：</label>
        <input type="text" name="id" required><br>

        <label for="newCourse_id">更新課程編號：</label>
        <input type="text" name="newCourse_id"><br>


        <label for="newCategory">更新必選修類別：</label>
        <select name="newCategory">
                <option value="">請選擇種類</option>
                <option value="必修">必修</option>
                <option value="選修">選修</option>
        </select><br>

        <label for="newCredit">更新學分數：</label>
        <input type="text" name="newCredit"><br>

        <label for="newTime">更新上課時間：</label>
        <input type="text" name="newTime"><br>

        <label for="newDescription">更新課程描述：</label>
        <input type="text" name="newDescription"><br>

        <input type="submit" value="確認">
    </form>
    <div id="message"><?php echo $message; ?></div>
    <div class="link">
        <a href="index_b.php">回後台首頁</a> | <a href="outline_se.php">查看教學大綱資料</a>
    </div>
</body>
</html>