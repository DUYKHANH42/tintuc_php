<?php
include_once "10_myFunct.php";
$sliders = getAllSlider();
$data=[];
while($row = mysqli_fetch_assoc($sliders)) {
    $data[] = $row;
}
?>
<div class="row carousel-holder">
            <div class="col-md-12">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php foreach ($data as $i => $row) { ?>
                            <li data-target="#carousel-example-generic"
                                data-slide-to="<?php echo $i; ?>"
                                class="<?php echo ($i == 0) ? 'active' : ''; ?>">
                            </li>
                        <?php } ?>
                    </ol>
                    <div class="carousel-inner">

                        <?php $i = 0; foreach ($data as $row) {
                            $active = ($i == 0) ? 'active' : '';  ?>
                        <div class="item <?php echo $active; ?>">
                            <img class="slide-image" src="img/slide/<?php echo $row['Hinh']; ?>" alt="">
                        </div>
                        <?php $i++; } ?>
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
        </div>