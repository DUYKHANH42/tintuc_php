<?php
session_start();
include "myFunct.php";
if(isset($_POST['btnDangNhap'])){
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $password = isset($_POST['password']) ? $_POST['password'] : "" ;
        $hashPassword = md5($password);
        if(empty($email) || empty($password) ) {
            $swal = "Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Vui lòng nhập email và mật khẩu'
            });";
        }
        else{
        $kq = CheckUser($email, $hashPassword);
        if( mysqli_num_rows($kq) > 0){
            $row = mysqli_fetch_assoc($kq);
            $_SESSION['name'] = $row['name'];
            $_SESSION['iduser'] = $row['id'];
            $redirect = isset($_SESSION['saudangnhap']) ? $_SESSION['saudangnhap'] : 'index.php';
            unset($_SESSION['saudangnhap']);
            header("location:$redirect");
            exit;
        }
        else {
             $swal = "Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Email hoặc mật khẩu không chính xác'
            });";
        }
    }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Đăng Nhập - Đặng Nguyễn Duy Khanh C24ATH</title>

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
    <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
    		<div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="panel panel-default">
				  	<div class="panel-heading">Đăng nhập</div>
				  	<div class="panel-body">
				    	<form action="" method="POST">
							<div>
				    			<label>Email</label>
							  	<input type="email" class="form-control" placeholder="Email" name="email" 
							  	>
							</div>
							<br>	
							<div>
				    			<label>Mật khẩu</label>
							  	<input type="password" class="form-control" name="password">
							</div>
							<br>
							<button type="submit" name="btnDangNhap" class="btn btn-success">Đăng nhập
							</button>
				    	</form>
				  	</div>
				</div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <!-- end slide -->
    </div>
    <!-- end Page Content -->

 
    <!-- end Footer -->
     <!-- CDN sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/my.js"></script>
    <script>
        <?php 
            if(!empty($swal)){
                echo $swal;
            }
        ?>
    </script>
</body>

</html>
