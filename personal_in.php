<?php
$link = mysqli_connect(
    'localhost',
    'D1050825',
    '#ohXia4ae',
    'D1050825');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //$id = $_POST["系主任編號"];
        $position = $_POST["position"];
        $name =  "李榮三";


        // 檢查職位名稱是否已存在
        $existingPositionQuery = "SELECT 職位名稱 FROM 系主任資料表";
        $existingPositionResult = mysqli_query($link, $existingPositionQuery);
        $existingPositions = mysqli_fetch_all($existingPositionResult, MYSQLI_ASSOC);

        $isExistingPosition = false;

        foreach ($existingPositions as $existingPosition) {
            $positions = explode("兼", $existingPosition['職位名稱']);
            
            // 判斷職位名稱是否已存在
            if (in_array($position, $positions)) {
                $isExistingPosition = true;
                break;
            }
        }

        if ($isExistingPosition) {
            $message = "<p class='error-message'>職位 $position 已存在！請輸入不同職位</p>";
        } else {
            $sql_2 = "SELECT 職位名稱 FROM 系主任資料表 ";
            $position_query = mysqli_query($link, $sql_2);
            $existingPositions = mysqli_fetch_assoc($position_query)['職位名稱'];
        
            if ($existingPositions) {
                $newPosition = $existingPositions . "兼" . $position;
            } else {
                $newPosition = $position;
            }
            $sql = "UPDATE 系主任資料表 SET 職位名稱='$newPosition' WHERE 姓名='$name'";

            try {
                $result = mysqli_query($link, $sql);
                $message = "新增 $position 成功！";
            } catch (Exception $e) {
                $message = "<p class='error-message'>新增職位 $position 失敗！</p>";
                $message .= "<p class='error-message'>" . $e->getMessage() . "</p>";
                // $message .= "<p class='error-message'>系主任號碼 $position已存在</p>";
            }
        }

        
        
        mysqli_close($link);
        
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title>新增職位</title>
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
        <h1>新增職位資料</h1>
        <form method="POST" action="">
            新增職位： <input type="text" name="position" required>

            <input type="submit" value="確認">
        </form>
        <div id="message"><?php echo $message; ?></div>
        <div class="link">
        <a href="index_b.php">回後台首頁</a> | <a href="personal_se.php">查看職位資料</a>
    </div>
    </div>
</body>
</html>