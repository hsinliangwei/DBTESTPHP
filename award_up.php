<?php
$link = mysqli_connect(
    'localhost',
    'D1050825',
    '#ohXia4ae',
    'D1050825');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 接收表單提交的資料
    $id = $_POST["id"];
    $newYear = $_POST["newYear"];
    $newAwards = $_POST["newAwards"];
    $newTime = $_POST["newTime"];
    $newDepartment = $_POST["newDepartment"];
    $newTitle = $_POST["newTitle"];
    $newStudent1 = $_POST["newStudent1"];
    $newStudent2 = $_POST["newStudent2"];
    $newStudent3 = $_POST["newStudent3"];
    
    // // 查詢資料庫中是否存在相同的指導獲獎紀錄
    // $checkQuery = "SELECT COUNT(*) as count FROM 指導獲獎紀錄資料表 WHERE 指導獲獎紀錄名稱 = '$newYear'";
    // $checkResult = mysqli_query($link, $checkQuery);
    // $count = mysqli_fetch_assoc($checkResult)['count'];

    // // 如果存在相同的指導獲獎紀錄項目，顯示錯誤並中止更新操作
    // if ($count > 0) {
    //     $message = "<p class='error-message'>Error： 指導獲獎紀錄名稱 $newYear 已存在，請輸入不同的指導獲獎紀錄資料</p>";
    // } else {
        // 查詢原始的指導獲獎紀錄項目
        $selectSql = "SELECT * FROM 指導獲獎紀錄資料表 WHERE 指導獲獎紀錄編號=$id";
        $selectResult = mysqli_query($link, $selectSql);
        $row = mysqli_fetch_assoc($selectResult);

        // 保存更新前的字段信息
        $oldFields = array();
        $updatedFields = array();

        if ($row) {
            $oldFields['指導獲獎紀錄編號'] = $row['指導獲獎紀錄編號'];
            $oldFields['年度'] = $row['年度'];
            $oldFields['獎項'] = $row['獎項'];
            $oldFields['日期'] = $row['日期'];
            $oldFields['頒發單位'] = $row['頒發單位'];
            $oldFields['獲獎作品名稱'] = $row['獲獎作品名稱'];
            $oldFields['學生1'] = $row['學生1'];
            $oldFields['學生2'] = $row['學生2'];
            $oldFields['學生3'] = $row['學生3'];
        }

        // 執行更新資料的 SQL 語句
        $updateSql = "UPDATE 指導獲獎紀錄資料表 SET ";
        $updatedFieldsCount = 0;

        if (!empty($newYear)) {
            $updateSql .= "年度='$newYear'";
            $updatedFields['年度'] = $newYear;
            $updatedFieldsCount++;
        }
    
        if (!empty($newAwards)) {
            if ($updatedFieldsCount > 0) {
                $updateSql .= ", ";
            }
            $updateSql .= "獎項='$newAwards'";
            $updatedFields['獎項'] = $newAwards;
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
        
        if (!empty($newDepartment)) {
            if ($updatedFieldsCount > 0) {
                $updateSql .= ", ";
            }
            $updateSql .= "頒發單位='$newDepartment'";
            $updatedFields['頒發單位'] = $newDepartment;
            $updatedFieldsCount++;
        }

        if (!empty($newTitle)) {
            if ($updatedFieldsCount > 0) {
                $updateSql .= ", ";
            }
            $updateSql .= "獲獎作品名稱='$newTitle'";
            $updatedFields['獲獎作品名稱'] = $newTitle;
            $updatedFieldsCount++;
        }

        if (!empty($newStudent1)) {
            if ($updatedFieldsCount > 0) {
                $updateSql .= ", ";
            }
            $updateSql .= "學生1='$newStudent1'";
            $updatedFields['學生1'] = $newStudent1;
            $updatedFieldsCount++;
        }

        if (!empty($newStudent2)) {
            if ($updatedFieldsCount > 0) {
                $updateSql .= ", ";
            }
            $updateSql .= "學生2='$newStudent2'";
            $updatedFields['學生2'] = $newStudent2;
            $updatedFieldsCount++;
        }

        if (!empty($newStudent3)) {
            if ($updatedFieldsCount > 0) {
                $updateSql .= ", ";
            }
            $updateSql .= "學生3='$newStudent3'";
            $updatedFields['學生3'] = $newStudent3;
            $updatedFieldsCount++;
        }

        $updateSql .= " WHERE 指導獲獎紀錄編號=$id";
        
        
        try {
            if ($updatedFieldsCount > 0) {
                $result = mysqli_query($link, $updateSql);
                //影響幾列
                $affectedRows = mysqli_affected_rows($link);
                if ($affectedRows > 0) {
                    $message = "更新第 " . $id . " 個指導獲獎紀錄資料成功！<br><br>";
                    $message .= "更新的欄位：<br>";
                    foreach ($updatedFields as $field => $value) {
                        $message .= $field . "（原始值：" . $oldFields[$field] . "，新值：" . $value . "）";
                        if ($field !== array_key_last($updatedFields)) {
                            $message .= "，";
                        }
                    }
                } else {
                    $message = "<p class='error-message'>更新第 " . $id . " 個指導獲獎紀錄資料失敗！</p>";
                }
            } else {
                $message = "<p class='error-message'>未更新任何欄位</p>";
            }
        } catch (Exception $e) {
            $message = "<p class='error-message'>指導獲獎紀錄資料更新失敗！</p>";
            $message .= "<p class='error-message'>" . $e->getMessage() . "</p>";
        }
    // }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>更新指導獲獎紀錄資料</title>
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
            margin-left: 65px;
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
    <h1>更新指導獲獎紀錄資料</h1>
    <form method="POST" action="">
        <label for="id">指導獲獎紀錄編號：</label>
        <input type="text" name="id" required><br>

        <label for="newYear">更新年度：</label>
        <input type="text" name="newYear"><br>


        <label for="newAwards">更新獎項：</label>
        <input type="text" name="newAwards"><br>

        <label for="newTime">更新日期：</label>
        <input type="date" name="newTime"><br>

        <label for="newDepartment">更新頒發單位：</label>
        <input type="text" name="newDepartment"><br>

        <label for="newTitle">更新獲獎作品名稱：</label>
        <input type="text" name="newTitle"><br>

        <label for="newStudent1">更新學生1：</label>
        <input type="text" name="newStudent1"><br>

        <label for="newStudent2">更新學生2：</label>
        <input type="text" name="newStudent2"><br>

        <label for="newStudent3">更新學生3：</label>
        <input type="text" name="newStudent3"><br>

        <input type="submit" value="確認">
    </form>
    <div id="message"><?php echo $message; ?></div>
    <div class="link">
        <a href="index_b.php">回後台首頁</a> | <a href="award_se.php">查看指導獲獎紀錄資料</a>
    </div>
</body>
</html>