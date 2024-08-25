<?php
$link = mysqli_connect(
    'localhost',
    'D1050825',
    '#ohXia4ae',
    'D1050825');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 接收表單提交的資料
    $id = $_POST["id"];
    $newCourse_ID = $_POST["newCourse_ID"];
    $newCourse = $_POST["newCourse"];
    
    // 查詢資料庫中是否存在相同的課程
    $checkQuery = "SELECT COUNT(*) as count FROM 課程資料表 WHERE 課程編號 = '$newCourse_ID' AND 課程名稱 = '$newCourse'";
    $checkResult = mysqli_query($link, $checkQuery);
    $count = mysqli_fetch_assoc($checkResult)['count'];

    // 如果存在相同的課程項目，顯示錯誤並中止更新操作
    if ($count > 0) {
        $message = "<p class='error-message'>Error：課程項目 $newCourse_ID $newCourse 已存在，請輸入不同的課程項目</p>";
    } else {
        // 查詢原始的課程項目
        $selectSql = "SELECT * FROM 課程資料表 WHERE 課程數目=$id";
        $selectResult = mysqli_query($link, $selectSql);
        $row = mysqli_fetch_assoc($selectResult);

        // 保存更新前的字段信息
        $oldFields = array();
        $updatedFields = array();

        if ($row) {
            $oldFields['課程編號'] = $row['課程編號'];
            $oldFields['課程名稱'] = $row['課程名稱'];
        }

        // 執行更新資料的 SQL 語句
        $updateSql = "UPDATE 課程資料表 SET ";
        $updatedFieldsCount = 0;

        if (!empty($newCourse_ID)) {
            $updateSql .= "課程編號='$newCourse_ID'";
            $updatedFields['課程編號'] = $newCourse_ID;
            $updatedFieldsCount++;
        }
    
        if (!empty($newCourse)) {
            if ($updatedFieldsCount > 0) {
                $updateSql .= ", ";
            }
            $updateSql .= "課程名稱='$newCourse'";
            $updatedFields['課程名稱'] = $newCourse;
            $updatedFieldsCount++;
        }

        $updateSql .= " WHERE 課程數目=$id";
        
        
        try {
            if ($updatedFieldsCount > 0) {
                $result = mysqli_query($link, $updateSql);
                //影響幾列
                $affectedRows = mysqli_affected_rows($link);
                if ($affectedRows > 0) {
                    $message = "更新第 " . $id . " 個課程資料成功！<br><br>";
                    $message .= "更新的欄位：<br>";
                    foreach ($updatedFields as $field => $value) {
                        $message .= $field . "（原始值：" . $oldFields[$field] . "，新值：" . $value . "）";
                        if ($field !== array_key_last($updatedFields)) {
                            $message .= "，";
                        }
                    }
                } else {
                    $message = "<p class='error-message'>更新第 " . $id . " 個課程資料失敗！</p>";
                }
            } else {
                $message = "<p class='error-message'>未更新任何欄位</p>";
            }
        } catch (Exception $e) {
            $message = "<p class='error-message'>課程號碼更新失敗！</p>";
            $message .= "<p class='error-message'>" . $e->getMessage() . "</p>";
        }
    }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>更新課程資料</title>
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
    <h1>更新課程資料</h1>
    <form method="POST" action="">
        <label for="id">課程序：</label>
        <input type="text" name="id" required><br>

        <label for="newCourse_ID">更新課程編號：</label>
        <input type="text" name="newCourse_ID"><br>


        <label for="newCourse">更新課程名稱：</label>
        <input type="text" name="newCourse"><br>

        <input type="submit" value="確認">
    </form>
    <div id="message"><?php echo $message; ?></div>
    <div class="link">
        <a href="index_b.php">回後台首頁</a> | <a href="course_se.php">查看課程資料</a>
    </div>
</body>
</html>