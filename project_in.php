<?php
$link = mysqli_connect(
    'localhost',
    'D1050825',
    '#ohXia4ae',
    'D1050825');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //$id = $_POST["計畫編號"];
        $category = $_POST["category"];
        $project_name = $_POST["project_name"];
        $time = $_POST["time"];
        $capacity = $_POST["capacity"];
        $name =  "李榮三";
        
        // 獲取資料庫中最後一筆計畫編號
        $last_id_query = "SELECT 計畫編號 FROM 計畫資料表 ORDER BY 計畫編號 DESC LIMIT 1";
        $last_id_result = mysqli_query($link, $last_id_query);
        $last_id_row = mysqli_fetch_assoc($last_id_result);
        $last_id = $last_id_row['計畫編號'];

        // 新的計畫編號為最後一筆編號加1
        $id = $last_id + 1;


        $sql = "INSERT INTO 計畫資料表 (計畫編號, 計畫種類, 計畫名稱, 計劃期間, 身分, 姓名) VALUES ('$id', '$category', '$project_name', '$time', '$capacity', '$name')";

        try {
            $result = mysqli_query($link, $sql);
            $message = "新增第 " . $id . " 個計畫資料成功！";
        } catch (Exception $e) {
            $message = "新增第 " . $id . " 個計畫資料失敗！";
            $message .= "<p class='error-message'>" . $e->getMessage() . "</p>";
        }
        
        mysqli_close($link);
        
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title>新增計畫資料</title>
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
            text-align: right;
            margin-bottom: 10px;
        }
        
        input[type="text"] {
            padding: 5px;
            width: 200px;
            margin-bottom: 10px;
            margin-right: 60px;
        }

        select {
            padding: 5px;
            width: 210px;
            margin-bottom: 10px;
            vertical-align: middle;
            margin-right: 60px;
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
            margin-right: 60px;
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
        <h1>新增計畫資料</h1>
        <form method="POST" action="">
            <label for="project_name">計畫名稱：</label>
            <textarea name="project_name" required></textarea><br>
            
            <label for="category">計畫種類：</label>
            <select name="category" required>
                <option value="">請選擇種類</option>
                <option value="國科會計畫">國科會計畫</option>
                <option value="產學合作計畫">產學合作計畫</option>
            </select><br>
            
            <label for="time">計劃期間：</label>
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