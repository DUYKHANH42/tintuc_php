  <?php
include_once "myFunct.php";
$theloai = getAllTheLoai();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Trang Chủ - Đặng Nguyễn Duy Khanh C24ATH</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <?php include "nav.php" ?>
    <!-- Page Content -->
    <div class="container main-content">
	<!-- slider -->
    <?php include "slider.php" ?>
        <!-- end slide -->
        <div class="space20"></div>
        <div class="row main-left">
            
    <?php include "menuleft.php" ?>
            <div class="col-md-9">
                <div class="panel panel-default">
    	            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;"> Tin Tức</h2>
	            	    </div>
	            	<div class="panel-body">
	            		<!-- item -->
					<?php 
                    while ($rtheloai = mysqli_fetch_assoc($theloai)) {
                        $idTheLoai = $rtheloai['id'];
                        $loatin = getLoaiTinbyIDTheLoai($idTheLoai);

                        while ($rowlt = mysqli_fetch_array($loatin)) {
                            $idLoaiTin = $rowlt['id'];
                            $tinTuc = getTop1TinTucByLoaiTin($idLoaiTin);
                            ?>
                                    <div class="row-item row">
                                        <h3 class="category-title">
                                            <span><?php echo $rtheloai['Ten']; ?></span>
                                            <small>
                                                <a href="loaitin.php?idTheLoai=<?php echo $idTheLoai; ?>&idLoaiTin=<?php echo $idLoaiTin; ?>">
                                                    / <?php echo $rowlt['Ten']; ?>
                                                </a>
                                            </small>
                                        </h3>
                                        <?php while ($row = mysqli_fetch_array($tinTuc)) { ?>
                                    <div class="col-md-12 border-right" style="margin-bottom:20px;">
                                                <div class="news-item">
                                                    <div class="row">
                                                        <div class="col-md-3 col-sm-4 col-xs-12">
                                                            <a href="chitiet.php?id=<?php echo $row['id']; ?>">
                                                                <div class="news-thumb">
                                                                    <img src="img/tintuc/<?php echo $row['Hinh']; ?>" class="img-responsive">
                                                                    <span class="thumb-icon">➜</span>
                                                                </div>
                                                            </a>
                                                        </div>

                                                        <div class="col-md-9 col-sm-8 col-xs-12">
                                                            <h3 class="news-title" style="margin-top:0; font-weight:bold;">
                                                                <?php echo $row['TieuDe']; ?>
                                                            </h3>

                                                            <p class="text-muted" style="max-height:3em; overflow:hidden;">
                                                                <?php echo $row['TomTat']; ?>
                                                            </p>
                                                            <a href="chitiet.php?id=<?php echo $row['id']; ?>"
                                                            class="btn btn-primary btn-sm read-more">
                                                                Xem chi tiết <span class="arrow">➜</span>
                                                            </a>
                                                        </div>

                                                    </div>
                                                </div>
                                        </div>
                                        <?php } ?>
                                        <div class="break"></div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
		                <!-- end item -->
					</div>
                </div>
        	</div>
        </div> 
    </div>
    <!-- Footer -->
    <hr>
    <?php include "footer.php" ?> 
    <!-- end Footer -->
</body>
 <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/my.js"></script>
    <script src="js/tintuc.js"></script>    
    <script src="js/timkiem.js"></script>  
</html>
