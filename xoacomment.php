<?php
    include "myFunct.php";
    $idComment = isset($_POST['id']) ? $_POST['id'] : 0;
    $idTinTuc = isset($_POST['idTinTuc']) ? $_POST['idTinTuc'] : 0;
     echo $kq = DeleteComment($idComment)
        
?>
