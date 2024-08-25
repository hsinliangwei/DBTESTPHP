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
    <title>查詢專書</title>
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
            margin-bottom: 20px;
        }
        
        .link a {
            color: #333;
            text-decoration: none;
        }

        .link :hover{
            color: #5372ac;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>所有專書資料</h1>
    <table>
        <tr>
            <th>專書編號</th>
            <th>專書名稱</th>
            <th>出版</th>
            <th>日期</th>
            <th>作者1</th>
            <th>作者2</th>
            <th>作者3</th>
        </tr>
        <?php 
        $sql_2 = "SELECT * FROM 專書資料表 ORDER BY 專書編號 ASC";
        $result_2 = mysqli_query($link, $sql_2);

        if ($result_2->num_rows > 0) {
            while($row = mysqli_fetch_array($result_2)) {
                echo "<tr>";
                echo "<td>" . $row["專書編號"] . "</td>"; 
                echo "<td>" . $row["專書名稱"] . "</td>"; 
                echo "<td>" . $row["出版"] . "</td>"; 
                echo "<td>" . $row["日期"] . "</td>"; 
                echo "<td>" . $row["作者1"] . "</td>"; 
                echo "<td>" . $row["作者2"] . "</td>"; 
                echo "<td>" . $row["作者3"] . "</td>"; 
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>專書資料表 0 個結果</td></tr>";
        }
        
        ?>
    </table>
    
    <form action="index_b.php">
        <input type="submit" value="回後台首頁">
    </form>
    <div class="link">
        <a href="book_in.php">新增專書資料</a> | <a href="book_up.php">更新專書資料</a> | <a href="book_de.php">刪除專書資料</a>
    </div>
</body>
</html>