<?php
$link = mysqli_connect(
    'localhost',
    'D1050825',
    '#ohXia4ae',
    'D1050825');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //$id = $_POST["學歷編號"];
        $school = $_POST["school"];
        $department = $_POST["department"];
        $degree = $_POST["degree"];
        $name =  "李榮三";
        
         // 獲取資料庫中最後一筆學歷編號
        $last_id_query = "SELECT 學歷編號 FROM 學歷資料表 ORDER BY 學歷編號 DESC LIMIT 1";
        $last_id_result = mysqli_query($link, $last_id_query);
        $last_id_row = mysqli_fetch_assoc($last_id_result);
        $last_id = $last_id_row['學歷編號'];

        // 新的學歷編號為最後一筆編號加1
        $id = $last_id + 1;


        $sql = "INSERT INTO 學歷資料表 (學歷編號, 學校名稱, 科系名稱, 學位, 姓名) VALUES ('$id', '$school', '$department', '$degree', '$name')";
        
        
        try {
            $result = mysqli_query($link, $sql);
            $message = "新增第 " . $id . " 個學歷資料" . $school . " " . $department . " " . $degree . "成功！";
        } catch (Exception $e) {
            $message = "<p class='error-message'>新增第 " . $id . " 個學歷資料" . $school . " " . $department . " " . $degree . "失敗！</p>";
            $message .= "<p class='error-message'>" . $e->getMessage() . "</p>";
        }
        
        mysqli_close($link);
        
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title>新增學歷資料</title>
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
            margin-right: 120px;
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
        <h1>新增學歷資料</h1>
        <form method="POST" action="">
            <label for="school">學校名稱： </label>
            <input type="text" name="school" required><br>

            <label for="department">科系名稱： </label>
            <input type="text" name="department" required><br>

            <label for="degree">學位： </label>
            <input type="text" name="degree" required><br>

            <input type="submit" value="確認">
        </form>
        <div id="message"><?php echo $message; ?></div>
        <div class="link">
        <a href="index_b.php">回後台首頁</a> | <a href="edu_se.php">查看學歷資料</a>
    </div>
    </div>
</body>
</html>