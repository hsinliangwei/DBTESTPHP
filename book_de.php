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
            $conditions[] = "專書編號 = '$input_id'";
        }
    
        $condition = implode(" OR ", $conditions);
    
        // 查詢要刪除的數據
        $selectQuery = "SELECT * FROM 專書資料表 WHERE $condition";
        $selectResult = mysqli_query($link, $selectQuery);
        $deletedData = array(); // 用於存儲要删除的數據
    
        while ($row = mysqli_fetch_assoc($selectResult)) {
            $deletedData[] = $row;
        }
    
        // 執行刪除數據的 SQL 語句
        $deleteQuery = "DELETE FROM 專書資料表 WHERE $condition";
        
    
        try {
            $result = mysqli_query($link, $deleteQuery);
            $affectedRows = mysqli_affected_rows($link);
            if ($affectedRows > 0) {
                $message = "刪除專書資料成功！";
    
                // 顯示刪除的數據
                $message .= "<br><br>已刪除的資料：<br>";
                foreach ($deletedData as $data) {
                    $message .= "專書名稱：{$data['專書名稱']}, 出版：{$data['出版']}, 日期：{$data['日期']}, 作者2：{$data['作者2']}, 作者3：{$data['作者3']}<br>";
                }
            } else {
                $message = "<p class='error-message'>未找到符合條件的專書資料</p>";
            }
        } catch (Exception $e) {
            $message = "<p class='error-message'>刪除專書資料失敗！</p>";
            $message .= "<p class='error-message'>" . $e->getMessage() . "</p>";
        }
    

        // 查詢專書資料，按照專書編號的升序排序
        $query = "SELECT 專書編號 FROM 專書資料表 ORDER BY 專書編號 ASC";
        $result = mysqli_query($link, $query);

        // 變量用於追踪當前的編號
        $current_id = 1;

        // 更新專書編號為連續的值
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['專書編號'];
            
            // 更新專書編號為當前的編號值
            $update_query = "UPDATE 專書資料表 SET 專書編號 = '$current_id' WHERE 專書編號 = '$id'";
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
    <title>刪除專書資料</title>
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
    <h1>刪除專書資料</h1>
    <form method="POST" action="">
        <label for="input_id">請輸入要刪除的專書編號：</label>
        <input type="text" name="input_id" required>

        <input type="submit" value="刪除">
    </form>
    <div id="message"><?php echo $message; ?></div>
    <div class="link">
        <a href="index_b.php">回後台首頁</a> | <a href="book_se.php">查看專書資料</a>
    </div>
</body>
</html>