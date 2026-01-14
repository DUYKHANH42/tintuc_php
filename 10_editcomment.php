<?php
include "10_myFunct.php";
$id = $_GET['idComment'] ?? 0;
$cmt = GetCommentByID($id);
$row = mysqli_fetch_assoc($cmt);
?>

<form method="post" class="editForm">
    <textarea name="noidung" class="form-control" rows="3"><?php 
        echo ($row['NoiDung']); 
    ?></textarea>
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <input type="hidden" name="idTinTuc" value="<?php echo $row['idTinTuc']; ?>">
    <button name="btnLuu" class="btn btn-success btn-xs">Lưu</button>
    <button type="button" class="btn btn-default btn-xs btnCancel">Hủy</button>
</form>
