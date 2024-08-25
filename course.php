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
    <h1>所有課程資料</h1>
    <table>
        <tr>
            <th>課程編號</th>
            <th>課程名稱</th>
            <th>授課老師</th>
        </tr>
        <?php 
        $sql_2 = "SELECT * FROM 課程資料表 ORDER BY 課程編號 ASC";
        $result_2 = mysqli_query($link, $sql_2);

        if ($result_2->num_rows > 0) {
            while($row = mysqli_fetch_array($result_2)) {
                echo "<tr>";
                echo "<td>" . $row["課程編號"] . "</td>"; 
                
                echo "<td><a href='course_detail.php?courseId=" . $row["課程編號"] . "'>" . $row["課程名稱"] . "</a></td>";
                echo "<td>" . $row["授課老師"] . "</td>"; 
                echo "</tr>";
            }
        } 
        
        ?>
    </table>
    
    
</body>
</html>