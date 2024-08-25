<?php
$link = mysqli_connect(
    'localhost',
    'D1050825',
    '#ohXia4ae',
    'D1050825');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //$id = $_POST["專書編號"];
        $book_name = $_POST["book_name"];
        $publishing = $_POST["publishing"];
        $time = $_POST["time"];
        $author_1 =  "李榮三";
        $author_2 = $_POST["author_2"];
        $author_3 = $_POST["author_3"];
        
        // 獲取資料庫中最後一筆專書編號
        $last_id_query = "SELECT 專書編號 FROM 專書資料表 ORDER BY 專書編號 DESC LIMIT 1";
        $last_id_result = mysqli_query($link, $last_id_query);
        $last_id_row = mysqli_fetch_assoc($last_id_result);
        $last_id = $last_id_row['專書編號'];

        // 新的專書編號為最後一筆編號加1
        $id = $last_id + 1;


        $sql = "INSERT INTO 專書資料表 (專書編號, 專書名稱, 出版, 日期, 作者1, 作者2, 作者3) VALUES ('$id', '$book_name', '$publishing', '$time', '$author_1', '$author_2', '$author_3')";

        try {
            $result = mysqli_query($link, $sql);
            $message = "新增第 " . $id . " 個專書資料成功！<br><br>";
            $message .= "$book_name $publishing $time $author_1 $author_2 $author_3";
        } catch (Exception $e) {
            $message = "<p class='error-message'>新增第 " . $id . " 個專書資料失敗！</p>";
            $message .= "<p class='error-message'>" . $e->getMessage() . "</p>";
        }
        
        mysqli_close($link);
        
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title>新增專書資料</title>
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
        
        input[type="text"], input[type="date"] {
            padding: 5px;
            width: 200px;
            margin-bottom: 10px;
        }

        span {
            display: inline-block;
            width: 213px;
            text-align: left;
            margin-bottom: 10px;
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
        <h1>新增專書資料</h1>
        <form method="POST" action="">
            <label for="book_name">專書名稱：</label>
            <textarea name="book_name" required></textarea><br>
            
            <label for="publishing">出版：</label>
            <input type="text" name="publishing"><br>

            <label for="time">日期：</label>
            <input type="date" name="time" required><br>

            <label for="author_1">作者：</label>
            <span>李榮三</span><br>
            
            <label for="author_2">其他作者：</label>
            <input type="text" name="author_2"><br>

            <label for="author_3">其他作者：</label>
            <input type="text" name="author_3"><br>
            
            <input type="submit" value="提交">
        </form>
        <div id="message"><?php echo $message; ?></div>
        <div class="link">
        <a href="index_b.php">回後台首頁</a> | <a href="book_se.php">查看專書資料</a>
    </div>
    </div>
</body>
</html>