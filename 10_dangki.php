<?php
    include "10_myFunct.php";
    if(isset($_POST['btnDangKy'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $passwordAgain = md5($_POST['passwordAgain']);
        if($password != $passwordAgain){
        $swal = "Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Mật khẩu không khớp'
            });";
        }
        elseif(CheckUserByEmail($email)){
            $swal = "Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Email đã tồn tại'
            });";
        }
        else{
        $kq = AddUser( $name, $email, $password);
        if($kq){
        $swal = "Swal.fire({
                icon: 'success',
                title: 'Thành công',
                text: 'Đăng ký thành công'
            }).then((result) => {
            window.location.href = '10_dangnhap.php';    
            },5000);";
        } else {
            $swal = "Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Đăng ký thất bại'
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

    <title>Đăng Ký - Đặng Nguyễn Duy Khanh C24ATH</title>
    <!-- CDN sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">  
    <link href="css/10_style.css" rel="stylesheet">

</head>

<body>

    <!-- Navigation -->
    <?php include "10_nav.php" ?>
    <!-- Page Content -->
    <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
				<div class="panel-heading">Đăng ký tài khoản</div>
				<div class="panel-body">
				    	<form action="" method="POST">
				    		<div>
				    			<label>Họ tên</label>
							  	<input type="text" class="form-control" placeholder="Username" name="name" aria-describedby="basic-addon1">
							</div>
							<br>
							<div>
				    			<label>Email</label>
							  	<input type="email" class="form-control" placeholder="Email" name="email" aria-describedby="basic-addon1"
							  	>
							</div>
							<br>	
							<div>
				    			<label>Nhập mật khẩu</label>
							  	<input type="password" class="form-control" name="password" aria-describedby="basic-addon1">
							</div>
							<br>
							<div>
				    			<label>Nhập lại mật khẩu</label>
							  	<input type="password" class="form-control" name="passwordAgain" aria-describedby="basic-addon1">
							</div>
							<br>
							<button type="submit" name="btnDangKy" class="btn btn-success">Đăng ký
							</button>
				    	</form>
                        
				  	</div>
				</div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>
    <!-- end Page Content -->
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
