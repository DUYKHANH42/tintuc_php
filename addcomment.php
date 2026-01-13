<?php
session_start();
include "myFunct.php";
$iduser = $_SESSION['iduser'];
$idTinTuc = isset($_POST['idTinTuc']) ? $_POST['idTinTuc'] : 0;
$noidung = isset($_POST['noidung']) ? $_POST['noidung'] : '';
if(isset($_POST['btnBinhLuan'])) {
    if (!$idTinTuc  || !$iduser|| trim($noidung) === '') {
            exit();
        }
$themCmt = AddComment( $iduser, $idTinTuc, $noidung);
$comments = getCommentsByTinTuc($idTinTuc);
$countcmt = mysqli_num_rows($comments);
?>
<div class="media-header mb-3">
            <h4 class="text-uppercase text-muted">
                Bình luận (<?php echo $countcmt ?? 0; ?>)
            </h4>
            <hr>
        </div>
<div class="media-body">
                            <?php
                                while($rowCmt = mysqli_fetch_assoc($comments)){
                            ?>
                            <div class="comment-item">
                            <h4 class="media-heading"><?php echo $rowCmt['name']; ?>
                                <small>
                                    <?php $time = !empty($rowCmt['updated_at'])
                                        ? $rowCmt['updated_at']
                                        : $rowCmt['created_at'];
                                    echo timeAgo($time); ?></small>
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
                            ?>
                        </div>
                        <?php } ?>  