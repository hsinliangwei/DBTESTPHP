<?php
$link = mysqli_connect(
    'localhost',
    'D1050825',
    '#ohXia4ae',
    'D1050825');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //$id = $_POST["指導獲獎紀錄編號"];
        $year = $_POST["year"];
        $awards = $_POST["awards"];
        $time = $_POST["time"];
        $department = $_POST["department"];
        $title = $_POST["title"];
        $student_1 = $_POST["student_1"];
        $student_2 = $_POST["student_2"];
        $student_3 = $_POST["student_3"];
        $teacher =  "李榮三";
                
        // 獲取資料庫中最後一筆指導獲獎紀錄編號
        $last_id_query = "SELECT 指導獲獎紀錄編號 FROM 指導獲獎紀錄資料表 ORDER BY 指導獲獎紀錄編號 DESC LIMIT 1";
        $last_id_result = mysqli_query($link, $last_id_query);
        $last_id_row = mysqli_fetch_assoc($last_id_result);
        $last_id = $last_id_row['指導獲獎紀錄編號'];

        // 新的指導獲獎紀錄編號為最後一筆編號加1
        $id = $last_id + 1;


        $sql = "INSERT INTO 指導獲獎紀錄資料表 (指導獲獎紀錄編號, 年度, 獎項, 日期, 頒發單位, 獲獎作品名稱, 學生1, 學生2, 學生3, 指導老師) VALUES ('$id', '$year', '$awards', '$time', '$department', '$title', '$student_1', '$student_2', '$student_3', '$teacher')";

        try {
            $result = mysqli_query($link, $sql);
            $message = "新增第 " . $id . " 個指導獲獎紀錄資料成功！";
        } catch (Exception $e) {
            $message = "新增第 " . $id . " 個指導獲獎紀錄資料失敗！";
            $message .= "<p class='error-message'>" . $e->getMessage() . "</p>";
        }
        
        mysqli_close($link);
        
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title>新增指導獲獎紀錄資料</title>
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
        
        input[type="text"], input[type="date"] {
            padding: 5px;
            width: 200px;
            margin-bottom: 10px;
            margin-right: 60px;
        }
        
        /* textarea {
            display: inline-block;
            padding: 5px;
            width: 200px;
            height: 50px;
            resize: vertical; 
            margin-bottom: 10px;
            vertical-align: middle;
        } */
        
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
            margin-left: 70px;
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
        <h1>新增指導獲獎紀錄資料</h1>
        <form method="POST" action="">
            <label for="year">年度：</label>
            <input type="text" name="year" required><br>

            <label for="awards">獎項：</label>
            <input type="text" name="awards" required><br>

            <label for="time">日期：</label>
            <input type="date" name="time" required><br>
            
            <label for="department">頒發單位：</label>
            <input type="text" name="department" required><br>

            <label for="title">獲獎作品：</label>
            <input type="text" name="title"><br>

            <label for="student_1">學生：</label>
            <input type="text" name="student_1"><br>

            <label for="student_2">學生：</label>
            <input type="text" name="student_2"><br>

            <label for="student_3">學生：</label>
            <input type="text" name="student_3"><br>
            
            <input type="submit" value="提交">
        </form>
        <div id="message"><?php echo $message; ?></div>
        <div class="link">
        <a href="index_b.php">回後台首頁</a> | <a href="award_se.php">查看指導獲獎紀錄資料</a>
    </div>
    </div>
</body>
</html>