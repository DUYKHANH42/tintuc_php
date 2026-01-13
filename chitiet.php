<?php
    session_start();
    include "myFunct.php";
    $id = isset($_GET['id']) ? $_GET['id'] : 0; 
    $tinTuc = getTinTucbyID($id);
    $row = mysqli_fetch_assoc($tinTuc);
    if(!$row){
    echo "Bài viết không tồn tại";
    exit;
    }
    $comments = getCommentsByTinTuc($id);
    $countcmt = mysqli_num_rows($comments);
    $ttLienQuan = getTinTucLienQuan($row['idLoaiTin'],$id);
    $ttLienQuanNoiBat = getTopTinTuc();
    date_default_timezone_set('Asia/Ho_Chi_Minh'); 
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Chi Tiết Tin Tức - Đặng Nguyễn Duy Khanh C24ATH</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- CDN sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">

</head>

<body>

    <!-- Navigation -->
    <?php include "nav.php" ?>
    <!-- Page Content -->
<div class="container main-content">
    <nav class="mb-4">
    <ol class="breadcrumb small">
        <li class="breadcrumb-item">
            <a href="index.php">Trang chủ</a>
        </li>
        <li class="breadcrumb-item breadcrumb-loai-tin ">
            <a class="text-primary" href="loaitin.php?idLoaiTin=<?php echo $row['idLoaiTin']; ?>">
                <?php echo $row['Ten']; ?>
            </a>
        </li>
        <li class="breadcrumb-item active text-truncate" aria-current="page">
            <?php echo $row['TieuDe']; ?>
        </li>
    </ol>
</nav>
        <div class="row">
            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

             <!-- Blog Post -->
                    <article class="bg-white p-4 rounded shadow-sm">

                        <!-- Title -->
                        <h1 class="fw-bold mb-3">
                            <?php echo $row['TieuDe']; ?>
                        </h1>

                        <!-- Author -->
                        <p class="text-muted mb-2">
                            by <a href="#" class="text-decoration-none fw-semibold">Admin</a>
                        </p>

                        <!-- Preview Image -->
                        <div class="mb-4">
                            <img 
                                src="img/tintuc/<?php echo $row['Hinh']; ?>"
                                alt="<?php echo $row['TieuDeKhongDau']; ?>"
                                class="img-fluid rounded w-100 shadow-sm img-responsive"
                            >
                        </div>

                        <!-- Date/Time -->
                        <p class="text-muted small mb-4">
                            <i class="glyphicon glyphicon-time"></i>
                            <?php 
                                $time = !empty($row['updated_at']) 
                                ? $row['updated_at'] 
                                : $row['created_at'];
                            echo $time ? timeAgo($time) : "Đang cập nhật";
                            ?>
                        </p>

                        <hr>

                        <!-- Summary -->
                        <p class="lead fw-semibold mb-4">
                            <?php echo $row['TomTat']; ?>
                        </p>

                        <!-- Content -->
                        <div class="fs-6 lh-lg">
                            <?php echo $row['NoiDung']; ?>
                        </div>

                    </article>
                <hr>
                <!-- Comments Section -->
    <section class="mt-5">
        <!-- Comment Form -->
        <?php if(isset($_SESSION['name'])) { ?>
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h4 class="card-title mb-3">
                    Viết bình luận 
                    <span class="glyphicon glyphicon-pencil"></span>
                </h4>
                <form role="form" id="form-add-cmt" method="POST">
                    <div class="form-group">
                    <textarea name="noidung" class="form-control" rows="3">
                    </textarea>
                    </div> 
                    <button type="submit" name="btnBinhLuan" class="btn btn-primary">Gửi</button> 
                </form>
            </div>
        </div>
        <?php } else { 
            $_SESSION['saudangnhap'] = $_SERVER['REQUEST_URI'];
        ?>
            <div class="alert alert-info">
                Vui lòng 
                <a href="dangnhap.php" class="fw-semibold text-decoration-none">
                    đăng nhập
                </a>
                để bình luận bài viết.
            </div>
        <?php } ?>
        <!-- Comment List -->
        <div id="media" class="media">
            <div class="media-header mb-3">
            <h4 class="text-uppercase text-muted">
                Bình luận (<?php echo $countcmt ?? 0; ?>)
            </h4>
            <hr>
        </div>
            <div id="media-body" class="media-body">
                <?php
                            if ($countcmt == 0) {
                        ?>
                                <div class="alert alert-info">
                                    Chưa có bình luận nào. Hãy là người đầu tiên bình luận.
                                </div>
                        <?php
                            } else {
                                while($rowCmt = mysqli_fetch_assoc($comments)){
                                    if($rowCmt < 0)
                            ?>
                            <div class="comment-item">
                            <h4 class="media-heading"><?php echo $rowCmt['name']; ?>
                                <small><?php
                                    $time = !empty($rowCmt['updated_at'])
                                        ? $rowCmt['updated_at']
                                        : $rowCmt['created_at'];
                                    echo timeAgo($time);
                                    ?>
                                </small>
                                    <?php if(isset($_SESSION['iduser']) && $_SESSION['iduser'] == $rowCmt['idUser']) { ?>
                                    <button 
                                        class="btnEdit btn btn-warning btn-xs"
                                        data-idcomment="<?php echo $rowCmt['id']; ?>">
                                        Sửa
                                    </button>
                                    <a data-idcomment="<?php echo $rowCmt['id']; ?>" 
                                    class="btnDelete btn btn-danger btn-xs">Xóa</a>
                                <?php } ?>
                            </h4>
                            <div class="comment-content">
                            <?php echo $rowCmt['NoiDung'];?>
                            <div class="formEdit"></div>
                            </div>
                            <hr>
                            </div>
                            <?php
                                }
                            }
                            ?>
            </div>
        </div>

    </section>
</div>


            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">
                <div class="panel panel-default ">
                    <div class="panel-heading">
                        <b>Tin liên quan</b>
                    </div>
                    <div class="panel-body">
                        <?php while($rowLienQuan = mysqli_fetch_assoc($ttLienQuan)) { ?>
                        <div  style="margin-bottom:15px;">
                            <div class="media-left">
                                <a href="chitiet.php?id=<?php echo $rowLienQuan['id']; ?>">
                                    <img 
                                        class="media-object img-thumbnail"
                                        src="img/tintuc/<?php echo $rowLienQuan['Hinh']; ?>"
                                        alt=""
                                        width="120"
                                    >
                                </a>
                        </div>
                        <div class="media-body">
                                <h5 class="media-heading" style="margin-top:0;">
                                    <a href="chitiet.php?id=<?php echo $rowLienQuan['id']; ?>">
                                        <b><?php echo $rowLienQuan['TieuDe']; ?></b>
                                    </a>
                                </h5>
                                <p class="text-muted small">
                                    <?php
                                    echo mb_strlen($rowLienQuan['TomTat'], 'UTF-8') > 60
                                        ? mb_substr($rowLienQuan['TomTat'], 0, 60, 'UTF-8') . '...'
                                        : $rowLienQuan['TomTat'];
                                    ?>
                                </p>
                        </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="panel panel-default sticky-top-news">
            <div class="panel-heading">
                <b>Tin nổi bật</b>
            </div>
            <div class="panel-body">
                <?php while($rttnb = mysqli_fetch_assoc($ttLienQuanNoiBat)) { ?>
                <div  style="margin-bottom:15px;">
                    <div class="media-left">
                        <a href="chitiet.php?id=<?php echo $rttnb['id']; ?>">
                            <img 
                                class="media-object img-thumbnail"
                                src="img/tintuc/<?php echo $rttnb['Hinh']; ?>"
                                alt="<?php echo $rttnb['TieuDeKhongDau']; ?>"
                                width="120"
                            >
                        </a>
                    </div>
                    <div class="media-body">
                        <h5 class="media-heading" style="margin-top:0;">
                            <a href="chitiet.php?id=<?php echo $rttnb['id']; ?>">
                                <b><?php echo $rttnb['TieuDe']; ?></b>
                            </a>
                        </h5>
                        <p class="text-muted small">
                            <?php
                            echo mb_strlen($rttnb['TomTat'], 'UTF-8') > 60
                                ? mb_substr($rttnb['TomTat'], 0, 60, 'UTF-8') . '...'
                                : $rttnb['TomTat'];
                            ?>
                        </p>
                    </div>
                </div>
                <?php } ?>

    </div>
</div>

                
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->

    <!-- Footer -->
    <hr>
    <?php include "footer.php" ?> 
    <!-- end Footer -->
     
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
    <script src="js/chitiet.js"></script>
    
</body>

</html>
