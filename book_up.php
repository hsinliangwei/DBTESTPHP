<?php
$link = mysqli_connect(
    'localhost',
    'D1050825',
    '#ohXia4ae',
    'D1050825');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 接收表單提交的資料
    $id = $_POST["id"];
    $newBook_name = $_POST["newBook_name"];
    $newPublishing = $_POST["newPublishing"];
    $newTime = $_POST["newTime"];
    $newAuthor_2 = $_POST["newAuthor_2"];
    $newAuthor_3 = $_POST["newAuthor_3"];
    
    // 查詢資料庫中是否存在相同的專書
    $checkQuery = "SELECT COUNT(*) as count FROM 專書資料表 WHERE 專書名稱 = '$newBook_name'";
    $checkResult = mysqli_query($link, $checkQuery);
    $count = mysqli_fetch_assoc($checkResult)['count'];

    // 如果存在相同的專書項目，顯示錯誤並中止更新操作
    if ($count > 0) {
        $message = "<p class='error-message'>Error： 專書名稱 $newBook_name 已存在，請輸入不同的專書資料</p>";
    } else {
        // 查詢原始的專書項目
        $selectSql = "SELECT * FROM 專書資料表 WHERE 專書編號=$id";
        $selectResult = mysqli_query($link, $selectSql);
        $row = mysqli_fetch_assoc($selectResult);

        // 保存更新前的字段信息
        $oldFields = array();
        $updatedFields = array();

        if ($row) {
            $oldFields['專書編號'] = $row['專書編號'];
            $oldFields['專書名稱'] = $row['專書名稱'];
            $oldFields['出版'] = $row['出版'];
            $oldFields['日期'] = $row['日期'];
            $oldFields['作者2'] = $row['作者2'];
            $oldFields['作者3'] = $row['作者3'];
        }

        // 執行更新資料的 SQL 語句
        $updateSql = "UPDATE 專書資料表 SET ";
        $updatedFieldsCount = 0;

        if (!empty($newBook_name)) {
            $updateSql .= "專書名稱='$newBook_name'";
            $updatedFields['專書名稱'] = $newBook_name;
            $updatedFieldsCount++;
        }
    
        if (!empty($newPublishing)) {
            if ($updatedFieldsCount > 0) {
                $updateSql .= ", ";
            }
            $updateSql .= "出版='$newPublishing'";
            $updatedFields['出版'] = $newPublishing;
            $updatedFieldsCount++;
        }

        if (!empty($newTime)) {
            if ($updatedFieldsCount > 0) {
                $updateSql .= ", ";
            }
            $updateSql .= "日期='$newTime'";
            $updatedFields['日期'] = $newTime;
            $updatedFieldsCount++;
        }

        if (!empty($newAuthor_2)) {
            if ($updatedFieldsCount > 0) {
                $updateSql .= ", ";
            }
            $updateSql .= "作者2='$newAuthor_2'";
            $updatedFields['作者2'] = $newAuthor_2;
            $updatedFieldsCount++;
        }

        if (!empty($newAuthor_3)) {
            if ($updatedFieldsCount > 0) {
                $updateSql .= ", ";
            }
            $updateSql .= "作者3='$newAuthor_3'";
            $updatedFields['作者3'] = $newAuthor_3;
            $updatedFieldsCount++;
        }

        $updateSql .= " WHERE 專書編號=$id";
        
        
        try {
            if ($updatedFieldsCount > 0) {
                $result = mysqli_query($link, $updateSql);
                //影響幾列
                $affectedRows = mysqli_affected_rows($link);
                if ($affectedRows > 0) {
                    $message = "更新第 " . $id . " 個專書資料成功！<br><br>";
                    $message .= "更新的欄位：<br>";
                    foreach ($updatedFields as $field => $value) {
                        $message .= $field . "（原始值：" . $oldFields[$field] . "，新值：" . $value . "）";
                        if ($field !== array_key_last($updatedFields)) {
                            $message .= "，";
                        }
                    }
                } else {
                    $message = "<p class='error-message'>更新第 " . $id . " 個專書資料失敗！</p>";
                }
            } else {
                $message = "<p class='error-message'>未更新任何欄位</p>";
            }
        } catch (Exception $e) {
            $message = "<p class='error-message'>專書資料更新失敗！</p>";
            $message .= "<p class='error-message'>" . $e->getMessage() . "</p>";
        }
    }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>更新專書資料</title>
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
        
        input[type="text"], input[type="date"] {
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
            margin-left: 10px;
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
    <h1>更新專書資料</h1>
    <form method="POST" action="">
        <label for="id">專書編號：</label>
        <input type="text" name="id" required><br>

        <label for="newBook_name">更新專書名稱：</label>
        <input type="text" name="newBook_name"><br>


        <label for="newPublishing">更新出版：</label>
        <input type="text" name="newPublishing"><br>

        <label for="newTime">更新日期：</label>
        <input type="date" name="newTime"><br>

        <label for="newAuthor_2">更新作者2：</label>
        <input type="text" name="newAuthor_2"><br>

        <label for="newAuthor_3">更新作者3：</label>
        <input type="text" name="newAuthor_3"><br>

        <input type="submit" value="確認">
    </form>
    <div id="message"><?php echo $message; ?></div>
    <div class="link">
        <a href="index_b.php">回後台首頁</a> | <a href="book_se.php">查看專書資料</a>
    </div>
</body>
</html>