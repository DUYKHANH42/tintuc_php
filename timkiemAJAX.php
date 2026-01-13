    <?php
    include "myFunct.php";

    $keyword = $_POST['keyword'] ?? '';
    $p = $_POST['p'] ?? 1;
    $limit = 2;
    $allTin = SearchTinTucByKeyWordPaging($keyword, 0, 100);
    $total = mysqli_num_rows($allTin);
    $tst = ceil($total / $limit);
    $from = ($p - 1) * $limit;
    $dsTin = SearchTinTucByKeyWordPaging($keyword, $from, $limit);
    $disablePrev = ($p <= 1) ? "disabled" : "";
    $disableNext = ($p >= $tst) ? "disabled" : "";
    ?>
    <div class="space20"></div>

    <div class="row main-left">
        <?php include "menuleft.php"; ?>

        <div class="col-md-9">
            <?php if (mysqli_num_rows($dsTin) == 0): ?>
                <p>Không tìm thấy kết quả</p>
            <?php else: ?>
                <?php while ($rowTin = mysqli_fetch_array($dsTin)) { ?>
                    <div class="row news-item">
                            <div class="col-md-3">
                                <a href="chitiet.php?id=<?= $rowTin['id'] ?>">
                                    <div class="news-thumb">
                                        <img class="img-responsive"
                                            src="img/tintuc/<?= $rowTin['Hinh'] ?>">
                                        <span class="thumb-icon">➜</span>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-9">
                                <h3 class="news-title"><?= $rowTin['TieuDe'] ?></h3>

                                <p><?= $rowTin['TomTat'] ?></p>

                                <a class="btn btn-primary read-more"
                                href="chitiet.php?id=<?= $rowTin['id'] ?>">
                                    Xem chi tiết
                                    <span class="arrow">➜</span>
                                </a>
                            </div>
                    </div>
                        <hr>
                <?php } ?>
            <?php endif; ?>
            <div class="row text-center">
                            <div class="col-lg-12">
                                <ul class="pagination">
                                    <li class="<?php echo $disablePrev; ?>">
                                        <a class="page-link " data-keyword="<?php echo $keyword; ?>" data-page="1" style="cursor: pointer">&laquo;</a>
                                    </li>
                                    <?php
                                            $before = max($p - 1, 1);
                                            $after = min($p + 1, $tst);
                                            for ( $i = $before; $i <= $after ; $i++ ) { 
                                                $active = $p == $i ?"active" : "" ;                                     
                                    ?>
                                    <li class="<?php echo $active; ?>">
                                        <a class="page-link" data-keyword="<?php echo $keyword; ?>"
                                            data-page="<?php echo $i; ?>"
                                            style="cursor: pointer"><?php echo $i; ?></a>
                                    </li>
                                    <?php } ?>
                                    <li class="<?php echo $disableNext; ?>">
                                        <a class="page-link" data-keyword="<?php echo $keyword; ?>" data-page="<?php echo $tst; ?>" style="cursor: pointer">&raquo;</a>
                                    </li>
                                </ul>
                            </div>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/my.js"></script>
    <script src="js/tintuc.js"></script>  
    <script src="js/timkiem.js"></script>  