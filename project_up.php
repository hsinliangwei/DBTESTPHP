<?php
$link = mysqli_connect(
    'localhost',
    'D1050825',
    '#ohXia4ae',
    'D1050825');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 接收表單提交的資料
    $id = $_POST["計畫編號"];
    $category = $_POST["category"];
    $project_name = $_POST["project_name"];
    $time = $_POST["time"];
    $capacity = $_POST["capacity"];
    $name =  "李榮三";
    
    // 查詢資料庫中是否存在相同的計畫
    $checkQuery = "SELECT COUNT(*) as count FROM 計畫資料表 WHERE 計畫名稱 = '$project_name' AND 計劃期間 = '$time'";
    $checkResult = mysqli_query($link, $checkQuery);
    $count = mysqli_fetch_assoc($checkResult)['count'];

    // 如果存在相同的計畫項目，顯示錯誤並中止更新操作
    if ($count > 0) {
        $message = "<p class='error-message'>Error： 計畫資料 $project_name $time 已存在，請輸入不同的計畫資料</p>";
    } else {

        // 查詢原始的計劃資料
        $selectSql = "SELECT * FROM 計畫資料表 WHERE 計畫編號=$id";
        $selectResult = mysqli_query($link, $selectSql);
        $row = mysqli_fetch_assoc($selectResult);

        // 保存更新前的字段信息
        $oldFields = array();
        $updatedFields = array();

        if ($row) {
            $oldFields['計畫名稱'] = $row['計畫名稱'];
            $oldFields['計畫種類'] = $row['計畫種類'];
            $oldFields['計劃期間'] = $row['計劃期間'];
            $oldFields['身分'] = $row['身分'];
            $oldFields['姓名'] = $row['姓名'];
        }

        $updateSql = "UPDATE 計畫資料表 SET ";
        $updatedFieldsCount = 0;

        if (!empty($category)) {
            $updateSql .= "計畫種類='$category'";
            $updatedFields['計畫種類'] = $category;
            $updatedFieldsCount++;
        }

        if (!empty($project_name)) {
            if ($updatedFieldsCount > 0) {
                $updateSql .= ", ";
            }
            $updateSql .= "計畫名稱='$project_name'";
            $updatedFields['計畫名稱'] = $project_name;
            $updatedFieldsCount++;
        }

        if (!empty($time)) {
            if ($updatedFieldsCount > 0) {
                $updateSql .= ", ";
            }
            $updateSql .= "計劃期間='$time'";
            $updatedFields['計劃期間'] = $time;
            $updatedFieldsCount++;
        }

        if (!empty($capacity)) {
            if ($updatedFieldsCount > 0) {
                $updateSql .= ", ";
            }
            $updateSql .= "身分='$capacity'";
            $updatedFields['身分'] = $capacity;
            $updatedFieldsCount++;
        }

        $updateSql .= " WHERE 計畫編號=$id";

        try {
            if ($updatedFieldsCount > 0) {
                $result = mysqli_query($link, $updateSql);
                $affectedRows = mysqli_affected_rows($link);
                if ($affectedRows > 0) {
                    $message = "更新第 " . $id . " 個計畫資料成功！<br><br>";
                    $message .= "更新的欄位：<br>";
                    foreach ($updatedFields as $field => $value) {
                        $message .= $field . "（原始值：" . $oldFields[$field] . "，新值：" . $value . "）";
                        if ($field !== array_key_last($updatedFields)) {
                            $message .= "，";
                        }
                    }
                } else {
                    $message = "<p class='error-message'>更新第 " . $id . " 個計畫資料失敗！</p>";
                }
            } else {
                $message = "<p class='error-message'>未更新任何欄位！</p>";
            }
        } catch (Exception $e) {
            $message = "<p class='error-message'>更新第 " . $id . " 個計畫資料失敗！</p>";
            $message .= "<p class='error-message'>" . $e->getMessage() . "</p>";
        }
    }
    mysqli_close($link);
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>更新計畫資料</title>
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
            width: 80px;
            text-align: center;
            margin-bottom: 10px;
        }
        
        input[type="text"] {
            padding: 5px;
            width: 200px;
            margin-bottom: 10px;
        }

        select {
            padding: 5px;
            width: 210px;
            margin-bottom: 10px;
            vertical-align: middle;
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
        }
        
        input[type="submit"]:hover {
            background-color: #435983;
        }
        
        .link {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
            margin-left: 18px;
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
    <div>
        <h1>更新計畫資料</h1>
        <form method="POST" action="">
            <label for="計畫編號">計畫編號：</label>
            <input type="text" name="計畫編號" required><br>

            <label for="project_name">計畫名稱：</label>
            <textarea name="project_name"></textarea><br>
            
            <label for="category">計畫種類：</label>
            <select name="category">
                <option value="">請選擇種類</option>
                <option value="國科會計畫">國科會計畫</option>
                <option value="產學合作計畫">產學合作計畫</option>
            </select><br>
            
            <label for="time">計畫期間：</label>
            <input type="text" name="time"><br>
            
            <label for="capacity">身份：</label>
            <input type="text" name="capacity"><br>
            
            <input type="submit" value="提交">
        </form>
        <div id="message"><?php echo $message; ?></div>
        <div class="link">
            <a href="index_b.php">回後台首頁</a> | <a href="project_se.php">查看計劃資料</a>
        </div>
    </div>
</body>
</html>