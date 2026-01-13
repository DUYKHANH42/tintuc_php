 <?php 
 if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Tin Tức</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="gioithieu.php">Giới thiệu</a>
                    </li>
                    <li>
                        <a href="lienhe.php">Liên hệ</a>
                    </li>
                </ul>

                <form class="navbar-form navbar-left" id="searchForm" role="search">
			        <div class="form-group">
			          <input type="text" class="form-control" name="search" id="keyword" placeholder="Search">
			        </div>
			        <button type="submit" class="btn btn-default">Tìm Kiếm</button>
			    </form>

			    <ul class="nav navbar-nav pull-right">
                    <?php
                        if(!isset($_SESSION['name'])){
                    ?>
                    <li>
                        <a href="dangki.php">Đăng ký</a>
                    </li>
                    <li>
                        <a href="dangnhap.php">Đăng nhập</a>
                    </li>
                    <?php
                        }
                        else{
                    ?>
                    <li>
                    	<a>
                    		<span class ="glyphicon glyphicon-user"></span>
                    		<?php echo $_SESSION['name']; ?>
                    	</a>
                    </li>

                    <li>
                    	<a href="logout.php">Đăng xuất</a>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <script src="js/jquery.js"></script>
    <script src="js/nav.js"></script>