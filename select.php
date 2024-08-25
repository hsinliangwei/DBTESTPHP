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
    <title>查詢資料</title>
</head>
<style>
    h2{
        background-color: powderblue;
    }
</style>
<body>
    <h2>系主任資料</h2>
    <table>
        <tr>
            <th>姓名</th>
            <th>職位名稱</th>
            <th>信箱</th>
        </tr>
        <?php
        $sql_1 = "SELECT * FROM 系主任資料表";
        $result_1 = mysqli_query($link, $sql_1);

        if ($result_1->num_rows > 0) {
            while($row = mysqli_fetch_array($result_1)) {
                echo "<tr>";
                echo "<td>" . $row["姓名"] . "</td>"; 
                echo "<td>" . $row["職位名稱"] . "</td>"; 
                echo "<td>" . $row["信箱"] . "</td>"; 
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>系主任資料表 0 個結果</td></tr>";
        }
        ?>
    </table>    


    <h2>分機資料</h2>
    <table>
        <tr>
            <th>分機編號</th>
            <th>分機號碼</th>
            <th>姓名</th>
        </tr>
        <?php 
        $sql_2 = "SELECT * FROM 分機資料表";
        $result_2 = mysqli_query($link, $sql_2);

        if ($result_2->num_rows > 0) {
            while($row = mysqli_fetch_array($result_2)) {
                echo "<tr>";
                echo "<td>" . $row["分機編號"] . "</td>"; 
                echo "<td>" . $row["分機號碼"] . "</td>"; 
                echo "<td>" . $row["姓名"] . "</td>"; 
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>分機資料表 0 個結果</td></tr>";
        }
        ?>
    </table>


    <h2>學歷資料</h2>
    <table>
        <tr>
            <th>學歷編號</th>
            <th>學校名稱</th>
            <th>科系名稱</th>
            <th>學位</th>
            <th>姓名</th>
        </tr>
        <?php
        $sql_3 = "SELECT * FROM 學歷資料表";
        $result_3 = mysqli_query($link, $sql_3);

        if ($result_3->num_rows > 0) {
            while($row = mysqli_fetch_array($result_3)) {
                echo "<tr>";
                echo "<td>" . $row["學歷編號"] . "</td>"; 
                echo "<td>" . $row["學校名稱"] . "</td>"; 
                echo "<td>" . $row["科系名稱"] . "</td>"; 
                echo "<td>" . $row["學位"] . "</td>"; 
                echo "<td>" . $row["姓名"] . "</td>"; 
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>學歷資料表 0 個結果</td></tr>";
        }
        ?>
    </table>


    <h2>專長資料</h2>
    <table>
        <tr>
            <th>專長編號</th>
            <th>項目</th>
            <th>expertise</th>
            <th>姓名</th>
        </tr>
        <?php
        $sql_4 = "SELECT * FROM 專長資料表";
        $result_4 = mysqli_query($link, $sql_4);

        if ($result_4->num_rows > 0) {
            while($row = mysqli_fetch_array($result_4)) {
                echo "<tr>";
                echo "<td>" . $row["專長編號"] . "</td>"; 
                echo "<td>" . $row["項目"] . "</td>"; 
                echo "<td>" . $row["expertise"] . "</td>"; 
                echo "<td>" . $row["姓名"] . "</td>"; 
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>專長資料表 0 個結果</td></tr>";
        }
        ?>
    </table>

    <h2>經歷資料</h2>
    <table>
        <tr>
            <th>經歷編號</th>
            <th>單位名稱</th>
            <th>職稱</th>
            <th>姓名</th>
        </tr>
        <?php
        $sql_11 = "SELECT * FROM 經歷資料表";
        $result_11 = mysqli_query($link, $sql_11);

        if ($result_11->num_rows > 0) {
            while($row = mysqli_fetch_array($result_11)) {
                echo "<tr>";
                echo "<td>" . $row["經歷編號"] . "</td>"; 
                echo "<td>" . $row["單位名稱"] . "</td>"; 
                echo "<td>" . $row["職稱"] . "</td>"; 
                echo "<td>" . $row["姓名"] . "</td>"; 
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>經歷資料表 0 個結果</td></tr>";
        }
        ?>
    </table>


    <h2>課程資料</h2>
    <table>
        <tr>
            <th>課程編號</th>
            <th>課程名稱</th>
            <th>授課老師</th>
        </tr>
        <?php
        $sql_5 = "SELECT * FROM 課程資料表";
        $result_5 = mysqli_query($link, $sql_5);

        if ($result_5->num_rows > 0) {
            while($row = mysqli_fetch_array($result_5)) {
                echo "<tr>";
                echo "<td>" . $row["課程編號"] . "</td>"; 
                echo "<td>" . $row["課程名稱"] . "</td>"; 
                echo "<td>" . $row["授課老師"] . "</td>"; 
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>課程資料表 0 個結果</td></tr>";
        }
        ?>
    </table>

    <h2>教學大綱資料</h2>
    <table>
        <tr>
            <th>教學大綱編號</th>
            <th>必選修</th>
            <th>學分數</th>
            <th>上課時間</th>
            <th>課程描述</th>
            <th>課程編號</th>
        </tr>
        <?php
        $sql_6 = "SELECT * FROM 教學大綱資料表";
        $result_6 = mysqli_query($link, $sql_6);

        if ($result_6->num_rows > 0) {
            while($row = mysqli_fetch_array($result_6)) {
                echo "<tr>";
                echo "<td>" . $row["教學大綱編號"] . "</td>"; 
                echo "<td>" . $row["必選修"] . "</td>"; 
                echo "<td>" . $row["學分數"] . "</td>"; 
                echo "<td>" . $row["上課時間"] . "</td>"; 
                echo "<td>" . $row["課程描述"] . "</td>"; 
                echo "<td>" . $row["課程編號"] . "</td>"; 
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>教學大綱資料表 0 個結果</td></tr>";
        }
        ?>
    </table>

    <h2>論文資料</h2>
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
        $sql_7 = "SELECT * FROM 論文資料表";
        $result_7 = mysqli_query($link, $sql_7);

        if ($result_7->num_rows > 0) {
            while($row = mysqli_fetch_array($result_7)) {
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
            echo "<tr><td colspan='5'>論文資料表 0 個結果</td></tr>";
        }
        ?>
    </table>

    <h2>計畫資料</h2>
    <table>
        <tr>
            <th>計畫編號</th>
            <th>計畫種類</th>
            <th>計畫名稱</th>
            <th>計畫期間</th>
            <th>身分</th>
            <th>姓名</th>
        </tr>
        <?php
        $sql_8 = "SELECT * FROM 計畫資料表";
        $result_8 = mysqli_query($link, $sql_8);

        if ($result_8->num_rows > 0) {
            while($row = mysqli_fetch_array($result_8)) {
                echo "<tr>";
                echo "<td>" . $row["計畫編號"] . "</td>"; 
                echo "<td>" . $row["計畫種類"] . "</td>"; 
                echo "<td>" . $row["計畫名稱"] . "</td>"; 
                echo "<td>" . $row["計畫期間"] . "</td>"; 
                echo "<td>" . $row["身分"] . "</td>"; 
                echo "<td>" . $row["姓名"] . "</td>"; 
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>計畫資料表 0 個結果</td></tr>";
        }
        ?>
    </table>


    <h2>專書資料</h2>
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
        $sql_9 = "SELECT * FROM 專書資料表";
        $result_9 = mysqli_query($link, $sql_9);

        if ($result_9->num_rows > 0) {
            while($row = mysqli_fetch_array($result_9)) {
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
            echo "<tr><td colspan='5'>專書資料表 0 個結果</td></tr>";
        }
        ?>
    </table>


    <h2>指導獲獎紀錄資料</h2>
    <table>
        <tr>
            <th>指導獲獎紀錄編號</th>
            <th>年度</th>
            <th>獎項</th>
            <th>日期</th>
            <th>頒發單位</th>
            <th>獲獎作品名稱</th>
            <th>學生1</th>
            <th>學生2</th>
            <th>學生3</th>
            <th>指導老師</th>
        </tr>
        <?php
        $sql_10 = "SELECT * FROM 指導獲獎紀錄資料表";
        $result_10 = mysqli_query($link, $sql_10);

        if ($result_10->num_rows > 0) {
            while($row = mysqli_fetch_array($result_10)) {
                echo "<tr>";
                echo "<td>" . $row["指導獲獎紀錄編號"] . "</td>"; 
                echo "<td>" . $row["年度"] . "</td>"; 
                echo "<td>" . $row["獎項"] . "</td>"; 
                echo "<td>" . $row["日期"] . "</td>"; 
                echo "<td>" . $row["頒發單位"] . "</td>"; 
                echo "<td>" . $row["獲獎作品名稱"] . "</td>"; 
                echo "<td>" . $row["學生1"] . "</td>"; 
                echo "<td>" . $row["學生2"] . "</td>"; 
                echo "<td>" . $row["學生3"] . "</td>"; 
                echo "<td>" . $row["指導老師"] . "</td>"; 
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>指導獲獎紀錄資料 0 個結果</td></tr>";
        }
        ?>
    </table>
   
</body>
</html>