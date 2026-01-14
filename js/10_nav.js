$(document).on("submit", "#searchForm", function (e) {
    e.preventDefault();

    var keyword = $("#keyword").val().trim();
    if (keyword === "") return;
    $.post("10_timkiemAJAX.php", { keyword: keyword, p: 1 }, function (data) {
        $(".main-content").html(data);
    });
});
