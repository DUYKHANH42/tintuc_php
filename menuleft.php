<?php
	include_once "myFunct.php";
	$dsTheLoai = getAllTheLoai();
?> 
<div class="col-md-3 ">
                <ul class="list-group" id="menu">
                    <li href="#" class="list-group-item menu1 active">
                    DANH MỤC
                    </li>
					<?php  while($rtl = mysqli_fetch_assoc($dsTheLoai)){ ?>
                    <li class="list-group-item menu1">
                    <?php echo $rtl["Ten"] ?>
                    </li>
					<ul>
					<?php 
							$dsLoaiTin = getLoaiTinByIdTheLoai($rtl["id"]);
							while($rlt = mysqli_fetch_assoc($dsLoaiTin)){
						?>
                	<li class="list-group-item">
                	<a style="cursor: pointer;" class="loaitin" data-idloaitin="<?php echo $rlt["id"]; ?>">
								<?php echo $rlt["Ten"] ?>
					</a>
                	</li>
					<?php } ?>	
                    </ul>
					<?php } ?>
				</ul>             
            </div>
			