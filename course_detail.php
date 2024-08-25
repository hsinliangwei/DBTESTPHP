<?php
$link = mysqli_connect(
    'localhost',
    'D1050825',
    '#ohXia4ae',
    'D1050825');
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>查詢課程</title>
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
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #CCCCCC;
        }
        
        th {
            background-color: #5675af;
            color: #FFFFFF;
        }
        
        tr:nth-child(even) {
            background-color: #F1F1F1;
        }
        
        form {
            text-align: center;
            margin-top: 20px;
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
            color: #333;
            text-decoration: none;
        }

        .link :hover{
            color: #007bff;
        }
    </style>
</head>
<body>
    <h1>課程大綱</h1>
    <table>
        <tr>
            <th>課程編號</th>
            <th>必選修</th>
            <th>學分數</th>
            <th>上課時間</th>
            <th>課程描述</th>
        </tr>
       
        <?php 
        $courseId = $_GET['courseId'];
        $sql_2 = "SELECT * FROM 教學大綱資料表 WHERE 課程編號 = '$courseId' ";
        $result_2 = mysqli_query($link, $sql_2);

        

        if (!$link) {
            echo "MySQL資料庫連接錯誤!<br>";
            exit();
        } else {
            // 使用課程編號進行條件查詢
            $sql_2 = "SELECT * FROM 教學大綱資料表 WHERE 課程編號 = '$courseId'";
            $result = mysqli_query($link, $sql_2);
        
            // 處理查詢結果
            if ($result) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                echo "<td>" . $row["課程編號"] . "</td>"; 
                
                
                echo "<td>" . $row["必選修"] . "</td>"; 
                echo "<td>" . $row["學分數"] . "</td>"; 
                echo "<td>" . $row["上課時間"] . "</td>"; 
                echo "<td>" . $row["課程描述"] . "</td>"; 
                echo "</tr>";
                }
            } else {
                echo "查詢失敗";
            }
        
            mysqli_close($link);
        }
        
        ?>
    </table>
    
    
</body>
</html>