<?php
$link = mysqli_connect(
    'localhost',
    'D1050825',
    '#ohXia4ae',
    'D1050825');


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // 接收表單提交的數據
        $input_id = $_POST["input_id"];
    
        // 構建查詢條件
        $conditions = array();
    
        if (!empty($input_id)) {
            $conditions[] = "計畫編號 = '$input_id'";
        }
    
        $condition = implode(" OR ", $conditions);
    
        // 查詢要刪除的數據
        $selectQuery = "SELECT * FROM 計畫資料表 WHERE $condition";
        $selectResult = mysqli_query($link, $selectQuery);
        $deletedData = array(); // 用於存儲要删除的數據
    
        while ($row = mysqli_fetch_assoc($selectResult)) {
            $deletedData[] = $row;
        }
    
        // 執行刪除數據的 SQL 語句
        $deleteQuery = "DELETE FROM 計畫資料表 WHERE $condition";
        
    
        try {
            $result = mysqli_query($link, $deleteQuery);
            $affectedRows = mysqli_affected_rows($link);
            if ($affectedRows > 0) {
                $message = "刪除計畫資料成功！";
    
                // 顯示刪除的數據
                $message .= "<br><br>已刪除的資料：<br>";
                foreach ($deletedData as $data) {
                    $message .= "計畫種類：{$data['計畫種類']}, 計畫名稱：{$data['計畫名稱']}, 計畫期間：{$data['計劃期間']}, 身分：{$data['身分']}<br>";
                }
            } else {
                $message = "<p class='error-message'>未找到符合條件的計畫資料</p>";
            }
        } catch (Exception $e) {
            $message = "<p class='error-message'>刪除計畫資料失敗！</p>";
            $message .= "<p class='error-message'>" . $e->getMessage() . "</p>";
        }
    

        // 查詢計畫資料，按照計畫編號的升序排序
        $query = "SELECT 計畫編號 FROM 計畫資料表 ORDER BY 計畫編號 ASC";
        $result = mysqli_query($link, $query);

        // 變量用於追踪當前的編號
        $current_id = 1;

        // 更新計畫編號為連續的值
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['計畫編號'];
            
            // 更新計畫編號為當前的編號值
            $update_query = "UPDATE 計畫資料表 SET 計畫編號 = '$current_id' WHERE 計畫編號 = '$id'";
            mysqli_query($link, $update_query);
            
            // 將當前的編號加1
            $current_id++;
        }


        mysqli_close($link);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>刪除計畫資料</title>
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
            /* width: 180px; */
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
    <h1>刪除計畫資料</h1>
    <form method="POST" action="">
        <label for="input_id">請輸入要刪除的計畫編號：</label>
        <input type="text" name="input_id" required>

        <input type="submit" value="刪除">
    </form>
    <div id="message"><?php echo $message; ?></div>
    <div class="link">
        <a href="index_b.php">回後台首頁</a> | <a href="project_se.php">查看計畫資料</a>
    </div>
</body>
</html>