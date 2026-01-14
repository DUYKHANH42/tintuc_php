$(document).ready(function() {
            $("#menu").on("click", ".loaitin", function(){
                var idLoaiTin = $(this).data("idloaitin");
                window.location.href = "10_loaitin.php?idLoaiTin=" + idLoaiTin;
            });
    });