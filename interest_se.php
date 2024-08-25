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
    <title>查詢專長項目</title>
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

        .cen {
            padding-left: 150px;
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
    <h1>所有專長資料</h1>
    <table>
        <tr>
            <th>專長編號</th>
            <th class="cen">專長項目 (中文)</th>
            <th class="cen">專長項目 (英文)</th>
        </tr>
        <?php 
        $sql_2 = "SELECT * FROM 專長資料表 ORDER BY 專長編號 ASC";
        $result_2 = mysqli_query($link, $sql_2);

        if ($result_2->num_rows > 0) {
            while($row = mysqli_fetch_array($result_2)) {
                echo "<tr>";
                echo "<td>" . $row["專長編號"] . "</td>"; 
                echo "<td class='cen'>" . $row["專長項目_中文"] . "</td>"; 
                echo "<td class='cen'>" . $row["專長項目_英文"] . "</td>"; 
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>專長資料表 0 個結果</td></tr>";
        }
        
        ?>
    </table>
    
    <form action="index_b.php">
        <input type="submit" value="回後台首頁">
    </form>
    <div class="link">
        <a href="interest_in.php">新增專長資料</a> | <a href="interest_up.php">更新專長資料</a> | <a href="interest_de.php">刪除專長資料</a>
    </div>
</body>
</html>