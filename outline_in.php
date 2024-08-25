<?php
$link = mysqli_connect(
    'localhost',
    'D1050825',
    '#ohXia4ae',
    'D1050825');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //$id = $_POST["教學大綱編號"];
        $course_id = $_POST["course_id"];
        $category = $_POST["category"];
        $credit = $_POST["credit"];
        $time = $_POST["time"];
        $description = $_POST["description"];
        
        // 獲取資料庫中最後一筆教學大綱編號
        $last_id_query = "SELECT 教學大綱編號 FROM 教學大綱資料表 ORDER BY 教學大綱編號 DESC LIMIT 1";
        $last_id_result = mysqli_query($link, $last_id_query);
        $last_id_row = mysqli_fetch_assoc($last_id_result);
        $last_id = $last_id_row['教學大綱編號'];

        // 新的教學大綱編號為最後一筆編號加1
        $id = $last_id + 1;


        $sql = "INSERT INTO 教學大綱資料表 (教學大綱編號, 課程編號, 必選修, 學分數, 上課時間, 課程描述) VALUES ('$id', '$course_id', '$category', '$credit', '$time', '$description')";
        
        try {
            $result = mysqli_query($link, $sql);
            $message = "新增課程編號 " . $course_id . "的教學大綱成功！";
        } catch (Exception $e) {
            $message = "<p class='error-message'>新增課程編號 " . $course_id . "的教學大綱失敗！</p>";
            $message .= "<p class='error-message'>" . $e->getMessage() . "</p>";
        }
        
        mysqli_close($link);
        
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title>新增教學大綱資料</title>
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
            margin-right: 80px;
        }

        select {
            padding: 5px;
            width: 210px;
            margin-bottom: 10px;
            vertical-align: middle;
            margin-right: 80px;
        }

        select option {
            padding: 5px;
        }
        
        textarea {
            display: inline-block;
            padding: 5px;
            width: 200px;
            height: 100px;
            /* resize: vertical; */
            margin-bottom: 10px;
            vertical-align: middle;
            margin-right: 80px;
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
            margin-left: 35px;
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
        <h1>新增教學大綱資料</h1>
        <form method="POST" action="">
            <label for="course_id">課程編號：</label>
            <input type="text" name="course_id" required><br>
            
            <label for="category">必選修：</label>
            <select name="category" required>
                <option value="">請選擇種類</option>
                <option value="必修">必修</option>
                <option value="選修">選修</option>
            </select><br>
            
            <label for="credit">學分數：</label>
            <input type="text" name="credit" required><br>
            
            <label for="time">上課時間：</label>
            <input type="text" name="time"><br>
            
            <label for="description">課程描述：</label>
            <textarea name="description"></textarea><br>
            
            <input type="submit" value="提交">
        </form>
        <div id="message"><?php echo $message; ?></div>
        <div class="link">
        <a href="index_b.php">回後台首頁</a> | <a href="outline_se.php">查看教學大綱資料</a>
    </div>
    </div>
</body>
</html>