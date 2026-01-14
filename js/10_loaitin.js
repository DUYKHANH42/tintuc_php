  $(document).ready(function() {
            var idLoaiTin = new URLSearchParams(window.location.search).get("idLoaiTin") || 1;
            // console.log(idLoaiTin);
            LoadTin(idLoaiTin, 1);
            $("#menu").on("click", ".loaitin", function(){
                LoadTin($(this).data("idloaitin"), 1);
            });
        $("#loai-tin").on("click", ".page-link", function () {
                $(".pagination li").removeClass("active");
                $(this).parent().addClass("active");
                var p = $(this).data("page");
                var idLoaiTin = $(this).data("idloaitin");
                LoadTin(idLoaiTin, p);
    });
        });
        function LoadTin(idLoaiTin, p){
            $.get("10_LoadTinTuc.php", {idLoaiTin, p}, function(data){
                $("#loai-tin").html(data);
            });
        }