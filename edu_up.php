<?php
$link = mysqli_connect(
    'localhost',
    'D1050825',
    '#ohXia4ae',
    'D1050825');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 接收表單提交的資料
    $id = $_POST["id"];
    $newSchool = $_POST["newSchool"];
    $newDepartment = $_POST["newDepartment"];
    $newDegree = $_POST["newDegree"];
    
    // 查詢資料庫中是否存在相同的學歷
    $checkQuery = "SELECT COUNT(*) as count FROM 學歷資料表 WHERE 學校名稱 = '$newSchool' AND 科系名稱 = '$newDepartment' AND 學位 = '$newDegree'";
    $checkResult = mysqli_query($link, $checkQuery);
    $count = mysqli_fetch_assoc($checkResult)['count'];

    // 如果存在相同的學歷項目，顯示錯誤並中止更新操作
    if ($count > 0) {
        $message = "<p class='error-message'>Error：此學歷 $newSchool $newDepartment $newDegree 已存在，請輸入不同的學歷</p>";
    } else {
        // 查詢原始的學歷項目
        $selectSql = "SELECT * FROM 學歷資料表 WHERE 學歷編號=$id";
        $selectResult = mysqli_query($link, $selectSql);
        $row = mysqli_fetch_assoc($selectResult);

        // 保存更新前的字段信息
        $oldFields = array();
        $updatedFields = array();

        if ($row) {
            $oldFields['學校名稱'] = $row['學校名稱'];
            $oldFields['科系名稱'] = $row['科系名稱'];
            $oldFields['學位'] = $row['學位'];
        }

        // 執行更新資料的 SQL 語句
        $updateSql = "UPDATE 學歷資料表 SET ";
        $updatedFieldsCount = 0;

        if (!empty($newSchool)) {
            $updateSql .= "學校名稱='$newSchool'";
            $updatedFields['學校名稱'] = $newSchool;
            $updatedFieldsCount++;
        }
    
        if (!empty($newDepartment)) {
            if ($updatedFieldsCount > 0) {
                $updateSql .= ", ";
            }
            $updateSql .= "科系名稱='$newDepartment'";
            $updatedFields['科系名稱'] = $newDepartment;
            $updatedFieldsCount++;
        }

        if (!empty($newDegree)) {
            if ($updatedFieldsCount > 0) {
                $updateSql .= ", ";
            }
            $updateSql .= "學位='$newDegree'";
            $updatedFields['學位'] = $newDegree;
            $updatedFieldsCount++;
        }

        $updateSql .= " WHERE 學歷編號=$id";
        
        
        try {
            if ($updatedFieldsCount > 0) {
                $result = mysqli_query($link, $updateSql);
                //影響幾列
                $affectedRows = mysqli_affected_rows($link);
                if ($affectedRows > 0) {
                    $message = "更新第 " . $id . " 個學歷資料成功！<br><br>";
                    $message .= "更新的欄位：<br>";
                    foreach ($updatedFields as $field => $value) {
                        $message .= $field . "（原始值：" . $oldFields[$field] . "，新值：" . $value . "）";
                        if ($field !== array_key_last($updatedFields)) {
                            $message .= "，";
                        }
                    }
                } else {
                    $message = "<p class='error-message'>更新第 " . $id . " 個學歷資料失敗！</p>";
                }
            } else {
                $message = "<p class='error-message'>未更新任何欄位</p>";
            }
        } catch (Exception $e) {
            $message = "<p class='error-message'>學歷號碼更新失敗！</p>";
            $message .= "<p class='error-message'>" . $e->getMessage() . "</p>";
        }
    }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>更新學歷號碼</title>
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
    <h1>更新學歷資料</h1>
    <form method="POST" action="">
        <label for="id">學歷編號：</label>
        <input type="text" name="id" required><br>

        <label for="newSchool">更新學校名稱：</label>
        <input type="text" name="newSchool"><br>


        <label for="newDepartment">更新科系名稱：</label>
        <input type="text" name="newDepartment"><br>

        <label for="newDegree">更新學位：</label>
        <input type="text" name="newDegree"><br>

        <input type="submit" value="確認">
    </form>
    <div id="message"><?php echo $message; ?></div>
    <div class="link">
        <a href="index_b.php">回後台首頁</a> | <a href="edu_se.php">查看學歷資料</a>
    </div>
</body>
</html>