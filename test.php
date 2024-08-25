<!DOCTYPE html>
<html lang="en">

    <head>
        <title>系主任網頁</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <style>
            body {

                justify-content: center;
                align-items: center;

            }
            .carousel {
                margin-left:9%;
                
            }

            .card {
                /*background-color: #979796;
                border-color:#979796;*/
                width: 82%;
                /*background-color: rgb(238, 217, 190);*/
                /*border-color: rgb(238, 217, 190);*/
                background-color: rgb(220, 220, 220);
                border-color: rgb(220, 220, 220);
                padding: 70px;
                margin-top: 20px;
            }

            .container {
                display: grid;
                grid-template-columns: 1fr 1fr;
                column-gap: 50px;
                justify-content: center;

            }



            .left-content {
                padding-left: 200px;

                /* 調整左邊邊界大小 */

            }

            .tab {
                overflow: hidden;
            }

            .tab button {
                background-color: #e7ecef;
                border: none;
                color: black;
                float: left;
                padding: 25px 45px;
                transition: background-color 0.3s;
            }

            .tab button:hover {
                background-color: #aaa;
            }

            .tab button.active {
                background-color: #979796;
            }

            #content{
                /*text-align: center;*/
                
            }

            .tab-content {
                display: center;
                padding-top: 20px;

            }

        </style>
    </head>

    <body>
        <!-- Carousel -->
        <div id="demo" class="carousel slide carousel" data-bs-ride="carousel">

            <!-- Indicators/dots -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
            </div>

            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="3000">
                    <img src="https://www.iecs.fcu.edu.tw/media/img/index/banner/cs.jpg.1336x470_q85_box-0%2C0%2C1336%2C470_crop_detail.jpg"
                    alt="cs" class="d-block" style="width:90%; height: 300px;">
                </div>
                <div class="carousel-item" data-bs-interval="5000">
                <img src="https://www.iecs.fcu.edu.tw/media/img/index/banner/1BB98B6E-646A-4EB3-A9A0-CED911AAE904.jpeg.1336x470_q85_box-0%2C30%2C2900%2C1050_crop_detail.jpg"
                alt="ai" class="d-block" style="width: 90%; height: 300px;">
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <img src="https://www.iecs.fcu.edu.tw/media/img/index/banner/7040A41E-047B-4BCA-AB63-C4833016C070.jpeg.1336x470_q85_box-0%2C30%2C2900%2C1050_crop_detail.jpg"
                alt="殊榮" class="d-block" style="width: 90%; height: 300px;">
            </div>
            
        </div>



            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>

        
        <!-- <div style="display: flex; align-items: center; margin-left: 150px; margin-right: 100px;">
            <img src="https://www.iecs.fcu.edu.tw/static/image/logo.c66c5c58752c.svg" alt="ai" class="d-block" style="width: 20%;">
            <div style="width: 15%;"></div>
            <h1 style="font-size: 60px; margin-left: 20px; color: #6096ba;">系主任網站</h1>
        </div> -->



        

        <div class="mt-3" style="margin-right: 130px;margin-left: 120px; ">

        <div style="display: flex; align-items: center;">
            <img src="https://www.iecs.fcu.edu.tw/static/image/logo.c66c5c58752c.svg" alt="ai" class="d-block" style="width: 20%;">
            <div style="width: 15%;"></div>
            <h1 style="font-size: 60px; margin-left: 20px; color: #6096ba;">系主任網站</h1>
        </div> 

            <ul class="nav nav-tabs " style="justify-content: flex-end">

            

                <li class="nav-item ">
                    <a class="nav-link " href="login_main.php" style="color: black;">登入</a>
                </li>


            </ul>
        </div>



        <div class="container pt-5 left-content card">
            <div class="row">

                <div class="col-md-6 order-1">

                    <!-- 加上 left-content 類別 -->
                    <div class="overflow-hidden">
                        <h1 class="text-color-dark font-weight-bold text-8 mb-0 pt-0 mt-0">李榮三</h1>
                    </div>
                    <div class="overflow-hidden mb-3">
                        <p class="font-weight-bold  text-uppercase mb-0 "><?php
                                $link = mysqli_connect('localhost', 'D1050825', '#ohXia4ae', 'D1050825');

                                if (!$link) {
                                    echo "MySQL資料庫連接錯誤!<br>";
                                    exit();
                                } else {
                                    $sql = "SELECT * FROM 系主任資料表";
                                    $result = mysqli_query($link, $sql);

                                    while ($row = mysqli_fetch_array($result)) {
                                        
                                        echo $row["職位名稱"];
                                        
                                    }
                                }

                            mysqli_close($link);
                        ?></p>
                    </div>

                    <div class="row align-items-center">
                        <button class="btn btn-outline btn-rounded btn-primary mt-3 mr-1 "
                            style="background-color: #6096ba; border-color: #6096ba;">
                            <i></i>信箱:
                            <?php
                                $link = mysqli_connect('localhost', 'D1050825', '#ohXia4ae', 'D1050825');

                                if (!$link) {
                                    echo "MySQL資料庫連接錯誤!<br>";
                                    exit();
                                } else {
                                    $sql = "SELECT * FROM 信箱資料表";
                                    $result = mysqli_query($link, $sql);

                                    while ($row = mysqli_fetch_array($result)) {
                                        echo $row["信箱"];
                                        echo "<br>";
                                    }
                                }

                            mysqli_close($link);
                        ?>






                        </button>
                        <button class="btn btn-outline btn-rounded btn-primary mt-3 mr-1"
                            style="background-color: #6096ba; border-color: #6096ba;">
                            <i></i>分機:
                            <?php
                                $link = mysqli_connect('localhost', 'D1050825', '#ohXia4ae', 'D1050825');

                                if (!$link) {
                                    echo "MySQL資料庫連接錯誤!<br>";
                                    exit();
                                } else {
                                    $sql = "SELECT * FROM 分機資料表";
                                    $result = mysqli_query($link, $sql);

                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "＃";
                                        echo $row["分機號碼"];
                                        echo "<br>";
                                    }
                                }

                            mysqli_close($link);
                        ?>
                        </button>

                        <button class="btn btn-outline btn-rounded btn-primary mt-3 mr-1"
                        onclick="goToCourse()" style="background-color: #6096ba; border-color: #6096ba;" >
                            <i></i>點我看授課內容
                        </button>
                    </div>
                </div>
                <script>
            
            function goToCourse() {
                window.location.href = "course.php";
            }
        </script>
            </div>
            
            <img alt="Porto" width="300" height="250" style="float:right;"
                        src="https://www.iecs.fcu.edu.tw/media/img/teacher/avatar/899631.jpg">
            
        </div>


        <section class="section section-default  mt-5 p-0 ">
            <div class="container pt-5 row left-content">

                <div class="col-md-8 order-1 ">

                    <h3 class="my-4">學歷</h3>
                    <?php
                        $link = mysqli_connect('localhost', 'D1050825', '#ohXia4ae', 'D1050825');

                        if (!$link) {
                            echo "MySQL資料庫連接錯誤!<br>";
                            exit();
                        } else {
        
                            $sql = "SELECT * FROM 學歷資料表";
                            $result = mysqli_query($link, $sql);

                            echo "<ul>";
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<li>" . $row["學校名稱"] . " " . $row["科系名稱"] . " " . $row["學位"] . "</li>";
                            }
                            echo "</ul>";
                        }

                        mysqli_close($link);
                    ?>

<h3 class="my-4">經歷</h3>
                    <?php
                        $link = mysqli_connect('localhost', 'D1050825', '#ohXia4ae', 'D1050825');

                        if (!$link) {
                            echo "MySQL資料庫連接錯誤!<br>";
                            exit();
                        } else {
        
                            $sql = "SELECT * FROM 經歷資料表";
                            $result = mysqli_query($link, $sql);

                            echo "<ul>";
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<li>" . $row["單位名稱"] . " " . $row["職稱"] . "</li>";
                            }
                            echo "</ul>";
                        }

                        mysqli_close($link);
                    ?>
                </div>


                <div class="col-md-8 order-2">
                    <h3 class="my-4 ">專長</h3>
                    <ul>
                        <?php
                            $link = mysqli_connect('localhost', 'D1050825', '#ohXia4ae', 'D1050825');

                            if (!$link) {
                                echo "MySQL資料庫連接錯誤!<br>";
                                exit();
                            } else {
                                $sql = "SELECT * FROM 專長資料表";
                                $result = mysqli_query($link, $sql);

                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<li>" . $row["專長項目_中文"] . "<br>" . $row["專長項目_英文"] . "</li>";
                                }
                            }

                            mysqli_close($link);
                        ?>
                    </ul>
                </div>
            </div>


        </section>
            <div style="text-align: center; ">
                <br>
                <br>
                <h2 style="margin-right: 150px;margin-left: 150px;background-color: #a3cefe;padding: 15px; background-color: #6096ba;">論文及參與計畫
                </h2>
                <br><br>
                <div style="margin-left: 220px; margin-right: 215px;">
                    <div class="tab ">
                        <button onclick="showTab('發表期刊論文')" >發表期刊論文</button>
                        <button onclick="showTab('會議論文')">會議論文</button>
                        <button onclick="showTab('指導獲獎紀錄')">指導獲獎紀錄</button>
                        <button onclick="showTab('國科會計畫')">國科會計畫</button>
                        <button onclick="showTab('產學合作計畫')">產學合作計畫</button>
                        <button onclick="showTab('專書')">專書</button>
                    </div>

                <div id="content">
                    <div id="發表期刊論文" class="tab-content ">
                    <?php
    
                        $link = mysqli_connect(
                        'localhost',
                        'D1050825',
                        '#ohXia4ae',
                        'D1050825');

                        if(!$link){
                            echo "MySQL資料庫連接錯誤!<br>";
                            exit();
                        }else{
            
                            $sql = "SELECT * FROM 論文資料表 WHERE 論文種類='發表期刊論文'";
                            $result = mysqli_query($link, $sql);

                            echo "<style>";
                            echo "table {";
                            echo "    border-collapse: collapse;";
                            //echo "    width: 100%;";
                            echo "}";
                            echo "th, td {";
                            echo "    text-align: left;";
                            echo "    padding: 8px;";
                            echo "}";
                            echo "th {";
                            echo "    background-color: #f2f2f2;";
                            echo "}";
                            echo "tr:nth-child(even) {";
                            echo "    background-color: #dddddd;";
                            echo "}";
                            echo "</style>";


                            echo "<table>";
                            echo "<tr>";
                            echo "<th>論文名稱</th>";
            
                            echo "<th>日期</th>";
                            echo "<th>頁數</th>";
                            echo "<th>卷號</th>";
            
                            echo "</tr>";
            
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                echo "<td style='text-align: left;'>" . $row["論文名稱"] . "</td>"; 
                
                                echo "<td style='text-align: left;'>" . $row["日期"] . "</td>"; 
                                echo "<td style='text-align: left;'>" . $row["頁數"] . "</td>"; 
                                echo "<td style='text-align: left;'>" . $row["卷號"] . "</td>"; 
                 
                                echo "</tr>";
                            }
            
                            echo "</table>";
                        }
    
                        mysqli_close($link);

                    ?>
                    </div>

                    <div id="會議論文" class="tab-content">
                        <?php
    
                        $link = mysqli_connect(
                        'localhost',
                        'D1050825',
                        '#ohXia4ae',
                        'D1050825');

                        if(!$link){
                            echo "MySQL資料庫連接錯誤!<br>";
                            exit();
                        }else{
            
                            $sql = "SELECT * FROM 論文資料表 WHERE 論文種類='會議論文'";
                            $result = mysqli_query($link, $sql);

                            echo "<style>";
                            echo "table {";
                            echo "    border-collapse: collapse;";
                            echo "    width: 100%;";
                            echo "}";
                            echo "th, td {";
                            echo "    text-align: left;";
                            echo "    padding: 8px;";
                            echo "}";
                            echo "th {";
                            echo "    background-color: #f2f2f2;";
                            echo "}";
                            echo "tr:nth-child(even) {";
                            echo "    background-color: #dddddd;";
                            echo "}";
                            echo "</style>";


                            echo "<table>";
                            echo "<tr>";
                            echo "<th>論文名稱</th>";
                            echo "<th>主辦方</th>";
                            echo "<th>日期</th>";
                            echo "<th>頁數</th>";
                            
                            echo "<th>地點</th>";
                            echo "</tr>";
            
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                echo "<td style='text-align: left;'>" . $row["論文名稱"] . "</td>"; 
                                echo "<td style='text-align: left;'>" . $row["主辦方"] . "</td>";
                                echo "<td style='text-align: left;'>" . $row["日期"] . "</td>"; 
                                echo "<td style='text-align: left;'>" . $row["頁數"] . "</td>"; 
                                
                                echo "<td style='text-align: left;'>" . $row["地點"] . "</td>"; 
                                echo "</tr>";
                            }
            
                            echo "</table>";
                        }
    
                        mysqli_close($link);

                    ?>
                    </div>

                    <div id="指導獲獎紀錄" class="tab-content">
                        <?php
    
                        $link = mysqli_connect(
                        'localhost',
                        'D1050825',
                        '#ohXia4ae',
                        'D1050825');

                        if(!$link){
                            echo "MySQL資料庫連接錯誤!<br>";
                            exit();
                        }else{
            
                            $sql = "SELECT * FROM 指導獲獎紀錄資料表 ";
                            $result = mysqli_query($link, $sql);

                            echo "<style>";
                            echo "table {";
                            echo "    border-collapse: collapse;";
                            echo "    width: 100%;";
                            echo "}";
                            echo "th, td {";
                            echo "    text-align: left;";
                            echo "    padding: 8px;";
                            echo "}";
                            echo "th {";
                            echo "    background-color: #f2f2f2;";
                            echo "}";
                            echo "tr:nth-child(even) {";
                            echo "    background-color: #dddddd;";
                            echo "}";
                            echo "</style>";


                            echo "<table>";
                            echo "<tr>";
                            echo "<th>年度</th>";
                            echo "<th>獎項</th>";
                            echo "<th>日期</th>";
                            echo "<th>頒發單位</th>";
                            echo "<th>獲獎作品名稱</th>";
                            echo "<th>學生</th>";
                            echo "</tr>";
            
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                echo "<td style='text-align: left;'>" . $row["年度"] . "</td>"; 
                                echo "<td style='text-align: left;'>" . $row["獎項"] . "</td>";
                                echo "<td style='text-align: left;'>" . $row["日期"] . "</td>"; 
                                echo "<td style='text-align: left;'>" . $row["頒發單位"] . "</td>"; 
                                echo "<td style='text-align: left;'>" . $row["獲獎作品名稱"] . "</td>"; 
                                echo "<td style='text-align: left;'>";
                                if ($row["學生1"] !== null) {
                                    echo $row["學生1"];
                                }
                                if ($row["學生2"] !== null) {
                                    echo "、 " . $row["學生2"];
                                }
                                if ($row["學生3"] !== null) {
                                    echo "、 " . $row["學生3"];
                                }
                                echo "</td>";

                                echo "</tr>";
                            }
            
                            echo "</table>";
                        }
    
                        mysqli_close($link);

                    ?>
                    </div>

                    <div id="國科會計畫" class="tab-content">
                        <?php
    
                        $link = mysqli_connect(
                        'localhost',
                        'D1050825',
                        '#ohXia4ae',
                        'D1050825');

                        if(!$link){
                            echo "MySQL資料庫連接錯誤!<br>";
                            exit();
                        }else{
            
                            $sql = "SELECT * FROM 計畫資料表 WHERE 計畫種類='國科會計畫'";
                            $result = mysqli_query($link, $sql);

                            echo "<style>";
                            echo "table {";
                            echo "    border-collapse: collapse;";
                            echo "    width: 100%;";
                            echo "}";
                            echo "th, td {";
                            echo "    text-align: left;";
                            echo "    padding: 8px;";
                            echo "}";
                            echo "th {";
                            echo "    background-color: #f2f2f2;";
                            echo "}";
                            echo "tr:nth-child(even) {";
                            echo "    background-color: #dddddd;";
                            echo "}";
                            echo "</style>";


                            echo "<table>";
                            echo "<tr>";
                            echo "<th>計畫名稱</th>";
                            echo "<th>計劃期間</th>";
                            echo "<th>身份</th>";
                            echo "</tr>";
            
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                echo "<td style='text-align: left;'>" . $row["計畫名稱"] . "</td>"; 
                                echo "<td style='text-align: left;'>" . $row["計劃期間"] . "</td>";
                                echo "<td style='text-align: left;'>" . $row["身分"] . "</td>";
                                
                                
                                echo "</tr>";
                            }
            
                            echo "</table>";
                        }
    
                        mysqli_close($link);

                    ?>
                    </div>

                    <div id="產學合作計畫" class="tab-content">
                        <?php
    
                        $link = mysqli_connect(
                        'localhost',
                        'D1050825',
                        '#ohXia4ae',
                        'D1050825');

                        if(!$link){
                            echo "MySQL資料庫連接錯誤!<br>";
                            exit();
                        }else{
            
                            $sql = "SELECT * FROM 計畫資料表 WHERE 計畫種類='產學合作計畫'";
                            $result = mysqli_query($link, $sql);

                            echo "<style>";
                            echo "table {";
                            echo "    border-collapse: collapse;";
                            echo "    width: 100%;";
                            echo "}";
                            echo "th, td {";
                            echo "    text-align: left;";
                            echo "    padding: 8px;";
                            echo "}";
                            echo "th {";
                            echo "    background-color: #f2f2f2;";
                            echo "}";
                            echo "tr:nth-child(even) {";
                            echo "    background-color: #dddddd;";
                            echo "}";
                            echo "</style>";


                            echo "<table>";
                            echo "<tr>";
                            echo "<th>計畫名稱</th>";
                            echo "<th>計劃期間</th>";
                            echo "<th>身份</th>";
                            echo "</tr>";
            
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                echo "<td style='text-align: left;'>" . $row["計畫名稱"] . "</td>"; 
                                echo "<td style='text-align: left;'>" . $row["計劃期間"] . "</td>";
                                echo "<td style='text-align: left;'>" . $row["身分"] . "</td>";
                                
                                
                                echo "</tr>";
                            }
            
                            echo "</table>";
                        }
    
                        mysqli_close($link);

                    ?>
                    </div>

                    <div id="專書" class="tab-content">
                        <?php
    
                        $link = mysqli_connect(
                        'localhost',
                        'D1050825',
                        '#ohXia4ae',
                        'D1050825');

                        if(!$link){
                            echo "MySQL資料庫連接錯誤!<br>";
                            exit();
                        }else{
            
                            $sql = "SELECT * FROM 專書資料表 ";
                            $result = mysqli_query($link, $sql);

                            echo "<style>";
                            echo "table {";
                            echo "    border-collapse: collapse;";
                            echo "    width: 100%;";
                            echo "}";
                            echo "th, td {";
                            echo "    text-align: left;";
                            echo "    padding: 8px;";
                            echo "}";
                            echo "th {";
                            echo "    background-color: #f2f2f2;";
                            echo "}";
                            echo "tr:nth-child(even) {";
                            echo "    background-color: #dddddd;";
                            echo "}";
                            echo "</style>";


                            echo "<table>";
                            echo "<tr>";
                            echo "<th>專書名稱</th>";
                            echo "<th>出版</th>";
                            echo "<th>日期</th>";
                            echo "<th>作者</th>";
                            
                            echo "</tr>";
            
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                echo "<td style='text-align: left;'>" . $row["專書名稱"] . "</td>"; 
                                echo "<td style='text-align: left;'>" . $row["出版"] . "</td>";
                                echo "<td style='text-align: left;'>" . $row["日期"] . "</td>"; 
                                echo "<td style='text-align: left;'>";
                                if ($row["作者1"] !== null) {
                                    echo $row["作者1"];
                                }
                                if ($row["作者2"] !== null) {
                                    echo "、 " . $row["作者2"];
                                }
                                if ($row["作者3"] !== null) {
                                    echo "、 " . $row["作者3"];
                                }
                                echo "</td>";
                            
                                echo "</tr>";
                            }
            
                            echo "</table>";
                        }
    
                        mysqli_close($link);

                    ?>
                    </div>

                </div>
                <script>
                    function showTab(tabName) {
                        var tabs = document.getElementsByClassName("tab")[0].getElementsByTagName("button");
                        var tabContents = document.getElementsByClassName("tab-content");
                        for (var i = 0; i < tabs.length; i++) {
                            tabs[i].classList.remove("active");
                            tabContents[i].style.display = "none";
                        }
                        document.getElementById(tabName).style.display = "block";
                        event.currentTarget.classList.add("active");
                    }
                </script>
            </div>
        </div>


        <div>
            <div class="mt-4 p-5  text-white rounded" style="background-color: #797878;">
                
            <div class="row">
        <div class="col-sm-4" style="padding-left: 100px;">
            <p>逢甲資訊工程系成立於1969年，是我國資訊教育界先驅之一，具有學士班、碩士班及博士班，學制完整形成相互學習的場域，迄今已有畢業系友萬餘人。本系以教學為本，建立扎實基礎; 精實研究，厚實創能人才; 鼓勵產學合作，培育務實能力。</p>
        </div>
        <div class="col-sm-3" style="padding-left: 100px;">
            
            <img src="https://www.iecs.fcu.edu.tw/static/image/logo_footer.ed94b80e9e25.svg" alt="">
            <img src="https://www.iecs.fcu.edu.tw/static/image/IEET.9fdebee6472f.svg" alt="">
            
        </div>
        <div class="col-sm-4" style="padding-left: 150px;">
            <h4>聯絡我們</h4><br>
            <p>逢甲大學 資訊電機館二樓(資電201)</p>
            <p>台中市西屯區逢大路127號(文華路100號)</p><br>
            <p>連絡電話：0424517250#3701</p>
            <p>聯絡信箱：iecs@fcu.edu.tw</p>
        </div>
    </div>
            </div>
        </div>
    </body>

</html>
