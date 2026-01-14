        <?php
        session_start();
        include "10_myFunct.php";
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        if (isset($_POST['btnLuu'])) {
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        $noidung = isset($_POST['noidung']) ? trim($_POST['noidung']) : '';
        if ($id <= 0 || trim($noidung) === '') {
            exit();
        }
        EditComment($id, $noidung);
        $idTin = isset($_POST['idTinTuc']) ? $_POST['idTinTuc'] : 0;
        $comments = getCommentsByTinTuc($idTin);
        ?>
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