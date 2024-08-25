<?php
$link = mysqli_connect(
    'localhost',
    'D1050825',
    '#ohXia4ae',
    'D1050825');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 接收表單提交的資料
    $id = $_POST["id"];
    $newArticle_name = $_POST["newArticle_name"];
    $newCategory = $_POST["newCategory"];
    $newOrganizer = $_POST["newOrganizer"];
    $newTime = $_POST["newTime"];
    $newPages = $_POST["newPages"];
    $newVolume = $_POST["newVolume"];
    $newPlace = $_POST["newPlace"];
    
    // 查詢資料庫中是否存在相同的論文
    $checkQuery = "SELECT COUNT(*) as count FROM 論文資料表 WHERE 論文名稱 = '$newArticle_name'";
    $checkResult = mysqli_query($link, $checkQuery);
    $count = mysqli_fetch_assoc($checkResult)['count'];

    // 如果存在相同的論文項目，顯示錯誤並中止更新操作
    if ($count > 0) {
        $message = "<p class='error-message'>Error： 論文名稱 $newArticle_name 已存在，請輸入不同的論文資料</p>";
    } else {
        // 查詢原始的論文項目
        $selectSql = "SELECT * FROM 論文資料表 WHERE 論文編號=$id";
        $selectResult = mysqli_query($link, $selectSql);
        $row = mysqli_fetch_assoc($selectResult);

        // 保存更新前的字段信息
        $oldFields = array();
        $updatedFields = array();

        if ($row) {
            $oldFields['論文編號'] = $row['論文編號'];
            $oldFields['論文名稱'] = $row['論文名稱'];
            $oldFields['論文種類'] = $row['論文種類'];
            $oldFields['主辦方'] = $row['主辦方'];
            $oldFields['日期'] = $row['日期'];
            $oldFields['頁數'] = $row['頁數'];
            $oldFields['卷號'] = $row['卷號'];
            $oldFields['地點'] = $row['地點'];
        }

        // 執行更新資料的 SQL 語句
        $updateSql = "UPDATE 論文資料表 SET ";
        $updatedFieldsCount = 0;

        if (!empty($newArticle_name)) {
            $updateSql .= "論文名稱='$newArticle_name'";
            $updatedFields['論文名稱'] = $newArticle_name;
            $updatedFieldsCount++;
        }
    
        if (!empty($newCategory)) {
            if ($updatedFieldsCount > 0) {
                $updateSql .= ", ";
            }
            $updateSql .= "論文種類='$newCategory'";
            $updatedFields['論文種類'] = $newCategory;
            $updatedFieldsCount++;
        }

        if (!empty($newOrganizer)) {
            if ($updatedFieldsCount > 0) {
                $updateSql .= ", ";
            }
            $updateSql .= "主辦方='$newOrganizer'";
            $updatedFields['主辦方'] = $newOrganizer;
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

        if (!empty($newPages)) {
            if ($updatedFieldsCount > 0) {
                $updateSql .= ", ";
            }
            $updateSql .= "頁數='$newPages'";
            $updatedFields['頁數'] = $newPages;
            $updatedFieldsCount++;
        }

        if (!empty($newVolume)) {
            if ($updatedFieldsCount > 0) {
                $updateSql .= ", ";
            }
            $updateSql .= "卷號='$newVolume'";
            $updatedFields['卷號'] = $newVolume;
            $updatedFieldsCount++;
        }

        if (!empty($newPlace)) {
            if ($updatedFieldsCount > 0) {
                $updateSql .= ", ";
            }
            $updateSql .= "地點='$newPlace'";
            $updatedFields['地點'] = $newPlace;
            $updatedFieldsCount++;
        }

        $updateSql .= " WHERE 論文編號=$id";
        
        
        try {
            if ($updatedFieldsCount > 0) {
                $result = mysqli_query($link, $updateSql);
                //影響幾列
                $affectedRows = mysqli_affected_rows($link);
                if ($affectedRows > 0) {
                    $message = "更新第 " . $id . " 個論文資料成功！<br><br>";
                    $message .= "更新的欄位：<br>";
                    foreach ($updatedFields as $field => $value) {
                        $message .= $field . "（原始值：" . $oldFields[$field] . "，新值：" . $value . "）";
                        if ($field !== array_key_last($updatedFields)) {
                            $message .= "，";
                        }
                    }
                } else {
                    $message = "<p class='error-message'>更新第 " . $id . " 個論文資料失敗！</p>";
                }
            } else {
                $message = "<p class='error-message'>未更新任何欄位</p>";
            }
        } catch (Exception $e) {
            $message = "<p class='error-message'>論文資料更新失敗！</p>";
            $message .= "<p class='error-message'>" . $e->getMessage() . "</p>";
        }
    }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>更新論文資料</title>
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
    <h1>更新論文資料</h1>
    <form method="POST" action="">
        <label for="id">論文編號：</label>
        <input type="text" name="id" required><br>

        <label for="newArticle_name">更新論文名稱：</label>
        <input type="text" name="newArticle_name"><br>


        <label for="newCategory">更新論文種類：</label>
        <select name="newCategory">
                <option value="">請選擇種類</option>
                <option value="會議論文">會議論文</option>
                <option value="發表期刊論文">發表期刊論文</option>
        </select><br>

        <label for="newOrganizer">更新主辦方：</label>
        <input type="text" name="newOrganizer"><br>

        <label for="newTime">更新日期：</label>
        <input type="text" name="newTime"><br>

        <label for="newPages">更新頁數：</label>
        <input type="text" name="newPages"><br>

        <label for="newVolume">更新卷號：</label>
        <input type="text" name="newVolume"><br>

        <label for="newPlace">更新地點：</label>
        <input type="text" name="newPlace"><br>

        <input type="submit" value="確認">
    </form>
    <div id="message"><?php echo $message; ?></div>
    <div class="link">
        <a href="index_b.php">回後台首頁</a> | <a href="article_se.php">查看論文資料</a>
    </div>
</body>
</html>