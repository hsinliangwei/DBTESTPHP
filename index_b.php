<?php
$link = mysqli_connect(
    'localhost',
    'D1050825',
    '#ohXia4ae',
    'D1050825');
?>
<!--後台首頁 -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>系主任網頁後台</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }
        
        .container {
            max-width: 820px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        h1 {
            margin: 20px 0;
            text-align: center;
            color: #333;
        }
        h4{
            margin-bottom: 20px;
            display: inline-block;
            background-color: #bac7e0;
            color: black;
            font-size: 18px;
            padding: 8px;
            border-radius: 10px; 
        }

        input[type="submit"] {
            background-color: #5675af;
            color: #FFFFFF;
            border: none;
            padding: 10px 20px;
            text-transform: uppercase;
            cursor: pointer;
        }

        .logout_form {
            text-align: right;
        }

        input[type="submit"]:hover {
            background-color: #435983;
        }

        .nav-tabs{
            background-color: #5675af;
        }

        .nav-item:last-child {
            margin-left: 240px;
        }

        .nav-tabs .nav-link {
            color: white;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .nav-tabs .nav-item {
            text-align: center;
            width: 100px;
            height: 50px;
        }

        .nav-tabs .nav-link.active {
            color: black;
        }
        
        ul {
            list-style: none;
            padding: 0;
        }

        .tab-content ul li {
            margin-bottom: 10px;
        }

        ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            padding-right: 100px;
        }

        ul li a:hover {
            color: #5372ac;
        }
    </style>
  </head>

<body>
    
    <h1>逢甲大學資訊系 系主任後台</h1>

    
    <!--Navs tabs-->
    <div class="container" style="margin: auto; width: 80%;">
    <form action="test.php" class="logout_form">
        <input type="submit" value="登出" class="logout">
    </form> 
    <ul class="nav nav-tabs mt-4">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#insert">新增資料</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#update">更新資料</a>     
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#select">查詢資料</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#delete">刪除資料</a>
        </li>
        <li class="nav-item">
            <form action="account_se.php">
                <input type="submit" value="查詢帳號資料" class="nav-link">
            </form> 
        </li>
    </ul>

        <div class="tab-content mt-5">
            <!-- Insert -->
            <div class="tab-pane container active" id="insert">
            <ul class="row" style="height: 250px;">
                <div class="col-sm-4">
                    <h4>基本資料</h4>
                    <li><a href="ext_in.php">新增分機</a></li>
                    <li><a href="email_in.php">新增信箱</a></li>
                    <li><a href="personal_in.php">新增職位</a></li>
                    <li><a href="interest_in.php">新增專長</a></li>
                </div>
                <div class="col-sm-4">
                    <h4>學歷/經歷</h4>
                    <li><a href="edu_in.php">新增學歷</a></li>
                    <li><a href="exp_in.php">新增經歷</a></li><hr>
                    <h4>課程資料</h4>
                    <li><a href="course_in.php">新增課程</a></li>
                    <li><a href="outline_in.php">新增教學大綱</a></li>
                </div>
                <div class="col-sm-4">
                    <h4>論文/參與計畫</h4>
                    <li><a href="article_in.php">新增論文</a></li>
                    <li><a href="project_in.php">新增計畫</a></li>
                    <li><a href="book_in.php">新增專書</a></li>
                    <li><a href="award_in.php">新增指導獲獎紀錄</a></li>
                </div>
            </ul>
            </div>

            <!--Update-->
            <div class="tab-pane container fade" id="update">
            <ul class="row" style="height: 250px;">
                <div class="col-sm-4">
                    <h4>基本資料</h4>
                    <li><a href="ext_up.php">更新分機</a></li>
                    <li><a href="email_up.php">更新信箱</a></li>
                    <li><a href="personal_up.php">更新職位</a></li>
                    <li><a href="interest_up.php">更新專長</a></li>
                </div>
                <div class="col-sm-4">
                    <h4>學歷/經歷</h4>
                    <li><a href="edu_up.php">更新學歷</a></li>
                    <li><a href="exp_up.php">更新經歷</a></li><hr>
                    <h4>課程資料</h4>
                    <li><a href="course_up.php">更新課程</a></li>
                    <li><a href="outline_up.php">更新教學大綱</a></li>
                </div>
                <div class="col-sm-4">
                    <h4>論文/參與計畫</h4>
                    <li><a href="article_up.php">更新論文</a></li>
                    <li><a href="project_up.php">更新計畫</a></li>
                    <li><a href="book_up.php">更新專書</a></li>
                    <li><a href="award_up.php">更新指導獲獎紀錄</a></li>
                </div>
            </ul>
            </div>
            <!--Select-->
            <div class="tab-pane container fade" id="select">
            <ul class="row" style="height: 250px;">
                <div class="col-sm-4">
                    <h4>基本資料</h4>
                    <li><a href="ext_se.php">查詢分機</a></li>
                    <li><a href="email_se.php">查詢信箱</a></li>
                    <li><a href="personal_se.php">查詢職位</a></li>
                    <li><a href="interest_se.php">查詢專長</a></li>
                </div>
                <div class="col-sm-4">
                    <h4>學歷/經歷</h4>
                    <li><a href="edu_se.php">查詢學歷</a></li>
                    <li><a href="exp_se.php">查詢經歷</a></li><hr>
                    <h4>課程資料</h4>
                    <li><a href="course_se.php">查詢課程</a></li>
                    <li><a href="outline_se.php">查詢教學大綱</a></li>
                </div>
                <div class="col-sm-4">
                    <h4>論文/參與計畫</h4>
                    <li><a href="article_se.php">查詢論文</a></li>
                    <li><a href="project_se.php">查詢計畫</a></li>
                    <li><a href="book_se.php">查詢專書</a></li>
                    <li><a href="award_se.php">查詢指導獲獎紀錄</a></li>
                </div>
            </ul>
            </div>
            <!--Delete-->
            <div class="tab-pane container fade" id="delete">
            <ul class="row" style="height: 250px;">
                <div class="col-sm-4">
                    <h4>基本資料</h4>
                    <li><a href="ext_de.php">刪除分機</a></li>
                    <li><a href="email_de.php">刪除信箱</a></li>
                    <li><a href="personal_de.php">刪除職位</a></li>
                    <li><a href="interest_de.php">刪除專長</a></li>
                </div>
                <div class="col-sm-4">
                    <h4>學歷/經歷</h4>
                    <li><a href="edu_de.php">刪除學歷</a></li>
                    <li><a href="exp_de.php">刪除經歷</a></li><hr>
                    <h4>課程資料</h4>
                    <li><a href="course_de.php">刪除課程</a></li>
                    <li><a href="outline_de.php">刪除教學大綱</a></li>
                </div>
                <div class="col-sm-4">
                    <h4>論文/參與計畫</h4>
                    <li><a href="article_de.php">刪除論文</a></li>
                    <li><a href="project_de.php">刪除計畫</a></li>
                    <li><a href="book_de.php">刪除專書</a></li>
                    <li><a href="award_de.php">刪除指導獲獎紀錄</a></li>
                </div>
            </ul>
            </div>
        </div>
    </div>


</body>
</html>