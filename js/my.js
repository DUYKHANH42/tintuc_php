$(".menu1").next('ul').toggle();

$(".menu1").click(function(event) {
	$(this).next("ul").toggle(500);
});
$('#backToTop').click(function () {
    $('html, body').animate({ scrollTop: 0 }, 1000);
});
