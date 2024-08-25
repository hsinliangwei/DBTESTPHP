<?php
$link = mysqli_connect(
    'localhost',
    'D1050825',
    '#ohXia4ae',
    'D1050825');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //$id = $_POST["論文編號"];
        $article_name = $_POST["article_name"];
        $category = $_POST["category"];
        $organizer = $_POST["organizer"];
        $time = $_POST["time"];
        $pages = $_POST["pages"];
        $volume = $_POST["volume"];
        $place = $_POST["place"];
        $name =  "李榮三";
        
        // 獲取資料庫中最後一筆論文編號
        $last_id_query = "SELECT 論文編號 FROM 論文資料表 ORDER BY 論文編號 DESC LIMIT 1";
        $last_id_result = mysqli_query($link, $last_id_query);
        $last_id_row = mysqli_fetch_assoc($last_id_result);
        $last_id = $last_id_row['論文編號'];

        // 新的論文編號為最後一筆編號加1
        $id = $last_id + 1;


        $sql = "INSERT INTO 論文資料表 (論文編號, 論文名稱, 論文種類, 主辦方, 日期, 頁數, 卷號, 地點, 作者) VALUES ('$id', '$article_name', '$category', '$organizer', '$time', '$pages', '$volume', '$place', '$name')";
        
        try {
            $result = mysqli_query($link, $sql);
            $message = "新增第 " . $id . " 個論文資料成功！<br><br>";
            $message .= "$article_name $category $organizer $time $pages $volume $place";
        } catch (Exception $e) {
            $message = "新增第 " . $id . " 個論文資料失敗！";
            $message .= "<p class='error-message'>" . $e->getMessage() . "</p>";
        }
        
        mysqli_close($link);
        
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title>新增論文資料</title>
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
            margin-top: 10px;
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
        <h1>新增論文資料</h1>
        <form method="POST" action="">
            <label for="article_name">論文名稱：</label>
            <textarea name="article_name" required></textarea><br>
            
            <label for="category">論文種類：</label>
            <select name="category" required>
                <option value="">請選擇種類</option>
                <option value="會議論文">會議論文</option>
                <option value="發表期刊論文">發表期刊論文</option>
            </select><br>
            
            <label for="organizer">主辦方：</label>
            <input type="text" name="organizer"><br>
            
            <label for="time">日期：</label>
            <input type="text" name="time"><br>
            
            <label for="pages">頁數：</label>
            <input type="text" name="pages"><br>

            <label for="volume">卷號：</label>
            <input type="text" name="volume"><br>

            <label for="place">地點：</label>
            <input type="text" name="place"><br>
            
            <input type="submit" value="提交">
        </form>
        <div id="message"><?php echo $message; ?></div>
        <div class="link">
        <a href="index_b.php">回後台首頁</a> | <a href="article_se.php">查看論文資料</a>
    </div>
    </div>
</body>
</html>