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
    <title>查詢論文</title>
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
    <h1>所有論文資料</h1>
    <table>
        <tr>
            <th>論文編號</th>
            <th>論文名稱</th>
            <th>論文種類</th>
            <th>主辦方</th>
            <th>日期</th>
            <th>頁數</th>
            <th>卷號</th>
            <th>地點</th>
            <th>作者</th>
        </tr>
        <?php 
        $sql_2 = "SELECT * FROM 論文資料表 ORDER BY 論文編號 ASC";
        $result_2 = mysqli_query($link, $sql_2);

        if ($result_2->num_rows > 0) {
            while($row = mysqli_fetch_array($result_2)) {
                echo "<tr>";
                echo "<td>" . $row["論文編號"] . "</td>"; 
                echo "<td>" . $row["論文名稱"] . "</td>"; 
                echo "<td>" . $row["論文種類"] . "</td>"; 
                echo "<td>" . $row["主辦方"] . "</td>"; 
                echo "<td>" . $row["日期"] . "</td>"; 
                echo "<td>" . $row["頁數"] . "</td>"; 
                echo "<td>" . $row["卷號"] . "</td>"; 
                echo "<td>" . $row["地點"] . "</td>"; 
                echo "<td>" . $row["作者"] . "</td>"; 
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>論文資料表 0 個結果</td></tr>";
        }
        
        ?>
    </table>
    
    <form action="index_b.php">
        <input type="submit" value="回後台首頁">
    </form>
    <div class="link">
        <a href="article_in.php">新增論文資料</a> | <a href="article_up.php">更新論文資料</a> | <a href="article_de.php">刪除論文資料</a>
    </div>
</body>
</html>