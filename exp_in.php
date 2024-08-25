<?php
$link = mysqli_connect(
    'localhost',
    'D1050825',
    '#ohXia4ae',
    'D1050825');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //$id = $_POST["經歷編號"];
        $department = $_POST["department"];
        $position = $_POST["position"];
        $name =  "李榮三";
        
         // 獲取資料庫中最後一筆經歷編號
        $last_id_query = "SELECT 經歷編號 FROM 經歷資料表 ORDER BY 經歷編號 DESC LIMIT 1";
        $last_id_result = mysqli_query($link, $last_id_query);
        $last_id_row = mysqli_fetch_assoc($last_id_result);
        $last_id = $last_id_row['經歷編號'];

        // 新的經歷編號為最後一筆編號加1
        $id = $last_id + 1;


        $sql = "INSERT INTO 經歷資料表 (經歷編號, 單位名稱, 職稱, 姓名) VALUES ('$id', '$department', '$position', '$name')";
        
        
        try {
            $result = mysqli_query($link, $sql);
            $message = "新增第 " . $id . " 個經歷資料" . $department . " " . $position . "成功！";
        } catch (Exception $e) {
            $message = "新增第 " . $id . " 個經歷資料" . $department . " " . $position . "失敗！";
            $message .= "<p class='error-message'>" . $e->getMessage() . "</p>";
        }
        
        mysqli_close($link);
        
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title>新增經歷資料</title>
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
        }

        input[type="text"] {
            padding: 5px;
            width: 200px;
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
        <h1>新增經歷資料</h1>
        <form method="POST" action="">
            <label for="department">單位名稱：</label>
            <input type="text" name="department" required>

            <label for="position">職稱：</label>
            <input type="text" name="position" required>
            
            <input type="submit" value="確認">
        </form>
        <div id="message"><?php echo $message; ?></div>
        <div class="link">
        <a href="index_b.php">回後台首頁</a> | <a href="exp_se.php">查看經歷資料</a>
    </div>
    </div>
</body>
</html>