<?php
$keyword = $_POST['keyword'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Tìm kiếm - Đặng Nguyễn Duy Khanh C24ATH</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/shop-homepage.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">
</head>
<body>

<?php include "nav.php"; ?>

<div class="container main-content">
    <div class="space20"></div>
    <div class="row main-left">
        <?php include "menuleft.php"; ?>

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading" style="background:#337AB7;color:white;">
                    <h3>Kết quả tìm kiếm</h3>
                </div>
                <div class="panel-body" id="news-list">
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/my.js"></script>
<script src="js/tintuc.js"></script>  
</body>
</html>
