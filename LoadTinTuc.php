<?php
include_once "myFunct.php";
$idLoaiTin = isset($_GET['idLoaiTin']) ? (int)$_GET['idLoaiTin'] : 0;
getLoaiTinByID($idLoaiTin);
$rowLoaiTin = mysqli_fetch_assoc(getLoaiTinByID($idLoaiTin));
$tt1t = 5;
$tinTucAll = getTinTucByLoaiTin($idLoaiTin);
$sumTinTuc = mysqli_num_rows($tinTucAll);
$tst = ceil($sumTinTuc / $tt1t);
$p = isset($_GET['p']) ? (int)$_GET['p'] : 1;
$from = ($p - 1) * $tt1t;
$tinTucPaging = getTinTucByLoaiTinPaging($idLoaiTin, $from, $tt1t);
$disablePrev = ($p == 1) ? "disabled" : "";
$disableNext = ($p == $tst) ? "disabled" : "";
?>

<div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h4 ><b><?php echo $idLoaiTin ? $rowLoaiTin['Ten'] : $rowTheLoai['Ten']; ?></b></h4>
                    </div>
                    <?php while($row = mysqli_fetch_assoc($tinTucPaging)) {  ?>
                    <div class="row-item row news-item">
                            <div class="col-md-3">
                                <a href="chitiet.php?id=<?php echo $row['id']; ?>">
                                    <div class="news-thumb">
                                        <img width="200" height="200"
                                            class="img-responsive"
                                            src="img/tintuc/<?php echo $row['Hinh']; ?>" alt="">
                                        <span class="thumb-icon">➜</span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-9">
                                <h3 class="news-title"><?php echo $row['TieuDe']; ?></h3>

                                <p><?php echo $row['TomTat']; ?></p>

                                <a class="btn btn-primary read-more"
                                href="chitiet.php?id=<?php echo $row['id']; ?>">
                                    View Project
                                    <span class="arrow">➜</span>
                                </a>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="break"></div>
                    <!-- Pagination -->
                    <div class="row text-center">
                        <div class="col-lg-12">
                            <ul class="pagination">
                                <li class="<?php echo $disablePrev; ?>">
                                    <a class="page-link " data-idLoaiTin="<?php echo $idLoaiTin; ?>" data-page="1" style="cursor: pointer">&laquo;</a>
                                </li>
                                <?php
                                        $before = max($p - 1, 1);
                                        $after = min($p + 1, $tst);
                                        for ( $i = $before; $i <= $after ; $i++ ) { 
                                            $active = $p == $i ?"active" : "" ;                                     
                                ?>
                                <li class="<?php echo $active; ?>">
                                    <a class="page-link" data-idLoaiTin="<?php echo $idLoaiTin; ?>"
                                        data-page="<?php echo $i; ?>"
                                        style="cursor: pointer"><?php echo $i; ?></a>
                                </li>
                                <?php } ?>
                                <li class="<?php echo $disableNext; ?>">
                                    <a class="page-link" data-idLoaiTin="<?php echo $idLoaiTin; ?>" data-page="<?php echo $tst; ?>" style="cursor: pointer">&raquo;</a>
                                </li>
                            </ul>
                        </div>
                    </div>