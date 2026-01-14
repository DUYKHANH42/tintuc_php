<?php
$conn = mysqli_connect("localhost","root","","tintuc_c24");
date_default_timezone_set('Asia/Ho_Chi_Minh');
function getTinTucbyID($id) {
    global $conn;
    $sql = "SELECT tintuc.*,loaitin.Ten FROM tintuc 
    INNER JOIN loaitin ON tintuc.idLoaiTin = loaitin.id 
    WHERE tintuc.id = '$id'";
    return $result = mysqli_query($conn,$sql);
}
function getAllTinTuc() {
    global $conn;
    $sql = "SELECT * FROM tintuc";
    return $result = mysqli_query($conn,$sql);
}
function getTinTucByTheLoaiPaging($idTheLoai, $from, $limit) {
    global $conn;
    $sql = "SELECT tintuc.* FROM tintuc 
            INNER JOIN loaitin ON tintuc.idLoaiTin = loaitin.id
            WHERE loaitin.idTheLoai = '$idTheLoai' 
            LIMIT $from, $limit";
    return $result = mysqli_query($conn,$sql);
}
function getTinTucByLoaiTinPaging($idLoaiTin, $from, $limit) {
    global $conn;
    $sql = "SELECT tintuc.* FROM tintuc 
            WHERE tintuc.idLoaiTin = '$idLoaiTin' 
            LIMIT $from, $limit";
    return $result = mysqli_query($conn,$sql);
}
function getLoaiTinByIdTheLoai($id) {
    global $conn;
    $sql = "SELECT * FROM loaitin WHERE idTheLoai = '$id'";
    return $result = mysqli_query($conn,$sql);
}
function getLoaiTinByID($id) {
    global $conn;
    $sql = "SELECT * FROM loaitin WHERE id = '$id'";
    return $result = mysqli_query($conn,$sql);
}
function getAllTheLoai() {
    global $conn;
    $sql = "SELECT * FROM theloai";
    return $result = mysqli_query($conn,$sql);
}
function getTheLoaiByID($id) {
    global $conn;
    $sql = "SELECT * FROM theloai WHERE id = '$id'";
    return $result = mysqli_query($conn,$sql);
}
function getTinTucByLoaiTin($id) {
    global $conn;
    $sql = "SELECT * FROM tintuc WHERE idLoaiTin = '$id'";
    return $result = mysqli_query($conn,$sql);
}
function getTop1TinTucByLoaiTin($id) {
    global $conn;
    $sql = "SELECT * FROM tintuc WHERE idLoaiTin = '$id' LIMIT 1";
    return $result = mysqli_query($conn,$sql);
}
function getTinTucbyIDTheLoai($idTheLoai) {
    global $conn;
    $sql = "SELECT tintuc.*, loaitin.Ten FROM tintuc INNER JOIN loaitin ON tintuc.idLoaiTin = loaitin.id 
    WHERE loaitin.idTheLoai = '$idTheLoai' AND tintuc.NoiBat = 1 ";
    return $result = mysqli_query($conn,$sql);
}
function getTinTucLienQuan($idLoaiTin,$idTinTuc) {
    global $conn;
    $sql = "SELECT * FROM tintuc WHERE idLoaiTin = '$idLoaiTin' AND id != '$idTinTuc' LIMIT 4";
    return $result = mysqli_query($conn,$sql);
}
function getTopTinTuc() {
    global $conn;
    $sql = "SELECT * FROM tintuc WHERE NoiBat = 1 ORDER BY id DESC LIMIT 5";
    return $result = mysqli_query($conn,$sql);
}
function getAllSlider() {
    global $conn;
    $sql = "SELECT * FROM slide";
    return $result = mysqli_query($conn,$sql);
}
function getCommentsByTinTuc($idTinTuc) {
    global $conn;
    $sql = "
        SELECT comment.*, users.name
        FROM comment
        INNER JOIN users ON comment.idUser = users.id
        WHERE comment.idTinTuc = '$idTinTuc'
        ORDER BY 
            COALESCE(comment.updated_at, comment.created_at) DESC
    ";
    return mysqli_query($conn, $sql);
}

function AddUser( $name, $email, $password) {
    global $conn;
    $sql = "INSERT INTO users(name,email,password)
            VALUES('$name', '$email', '$password')" ;
    return $result = mysqli_query($conn,$sql);
}
function CheckUser($email, $password,) {
    global $conn;
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    return $result = mysqli_query($conn,$sql);
}

function CheckUserByEmail($email) {
    global $conn;
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn,$sql);
    return mysqli_num_rows($result) > 0;
}
function AddComment($idUser, $idTinTuc, $noiDung) {
    global $conn;
    $sql = "INSERT INTO comment(idUser, idTinTuc, NoiDung, created_at)
            VALUES('$idUser', '$idTinTuc', '$noiDung', NOW())" ;
    return $result = mysqli_query($conn,$sql);
}

function EditComment($id, $noiDung) {
    global $conn;
    $sql = "UPDATE `comment`
            SET NoiDung='$noiDung', updated_at=NOW()
            WHERE id=$id";
    return $result = mysqli_query($conn,$sql);
}
function GetCommentByID($id) {
    global $conn;
    $sql = "SELECT * FROM `comment` WHERE id = '$id'";
    return $result = mysqli_query($conn,$sql);
}
function DeleteComment($id) {
    global $conn;
    $sql = "DELETE FROM comment WHERE id = '$id'";
    return $result = mysqli_query($conn,$sql);
}
function SearchTinTucByKeyWord($keyword) {
    global $conn;
    $sql = "SELECT * FROM tintuc 
            WHERE TieuDe LIKE '%$keyword%'";
    return mysqli_query($conn, $sql);
}

function SearchTinTucByKeyWordPaging($keyword, $from, $limit) {
    global $conn;
    $sql = "SELECT * FROM tintuc 
            WHERE TieuDe LIKE '%$keyword%' 
            LIMIT $from, $limit";
    return mysqli_query($conn, $sql);
}

function timeAgo($datetime) {
    if (!$datetime) return '';

    $timestamp = strtotime($datetime);
    $now = time();
    $diff = $now - $timestamp;

    if ($diff < 60) {
        return "Vừa xong";
    }

    if ($diff < 3600) {
        return floor($diff / 60) . " phút trước";
    }

    if ($diff < 86400) {
        return floor($diff / 3600) . " giờ trước";
    }

    if ($diff < 2592000) {
        return floor($diff / 86400) . " ngày trước";
    }

    if ($diff < 31536000) { 
        return floor($diff / 2592000) . " tháng trước";
    }

    return floor($diff / 31536000) . " năm trước";
}



