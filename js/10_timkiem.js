$(document).ready(function() {
function LoadTin(keyword, p){
            $.post("10_timkiemAJAX.php", {keyword, p}, function(data){
                $(".main-content").html(data);
            });
        }
        $(".main-content").on("click", ".page-link", function () {
                $(".pagination li").removeClass("active");
                $(this).parent().addClass("active");
                var p = $(this).data("page");
                var keyword = $(this).data("keyword");
                LoadTin(keyword, p);
        });       
    $('#backToTop').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 1000);
    });
});
