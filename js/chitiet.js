$(document).ready(function(){
    const urlParams = new URLSearchParams(window.location.search);
            $(document).on("click", ".btnEdit", function (e){
                e.preventDefault();
                let btn = $(this);
                let idComment = btn.data("idcomment");
                let box = $(this).closest(".comment-item");
                $(".formEdit").html("");
                $.get("editcomment.php",{idComment}, function(data){    
                    box.find(".formEdit").html(data);
                });
            });
            $(document).on("submit", ".editForm", function (e){
                e.preventDefault();
                var form = $(this);
                var noidung = form.find("textarea[name='noidung']").val();
                var id = form.find("input[name='id']").val();
                var idTinTuc = form.find("input[name='idTinTuc']").val();
                if(!noidung.trim() || !id || !idTinTuc){
                    Swal.fire({
                        title: 'Thất bại!',
                        text: 'Cập nhật bình luận thất bại!',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    return;
                }
                $.post("updatecomment.php",
                    {
                        btnLuu: true,
                        noidung,
                        id,
                        idTinTuc
                    }, 
                    function(data){
                        $("#media-body").html(data);
                            Swal.fire({
                                title: 'Thành công!',
                                text: 'Cập nhật bình luận thành công!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        }
                );
            });
            $(document).on("click", ".btnCancel", function (e){
                e.preventDefault();
                let box = $(this).closest(".formEdit");
                box.html("");
            });
            $(document).on("click", ".btnDelete", function (e) {
                    e.preventDefault();

                    let btn = $(this);
                    let idComment = btn.data("idcomment");

                    Swal.fire({
                        title: 'Bạn có chắc chắn muốn xóa bình luận này?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Có',
                        cancelButtonText: 'Không'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.post("xoacomment.php", {
                                id: idComment
                            }, function (data) {
                                if (data.trim() === "1") {
                                    Swal.fire({
                                        title: 'Đã xóa!',
                                        text: 'Bình luận đã được xóa.',
                                        icon: 'success'
                                    });
                                    btn.closest(".comment-item").remove();
                                } else {
                                    Swal.fire({
                                        title: 'Thất bại!',
                                        text: 'Không thể xóa bình luận.',
                                        icon: 'error'
                                    });
                                }
                            });
                        }
                    });
            });
            $(document).on("submit", "#form-add-cmt", function (e){
            e.preventDefault();
                var form = $(this);
                var noidung = form.find("textarea[name='noidung']").val();
                const idTinTuc = urlParams.get("id");
                if(!noidung.trim() || !idTinTuc){
                    Swal.fire({
                        title: 'Thất bại!',
                        text: 'Vui lòng nhập nội dung',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    return;
                }
                $.post("addcomment.php",
                    {
                        btnBinhLuan: true,
                        noidung,
                        idTinTuc
                    }, 
                    function(data){    
                        $("#media").html(data);
                        form.find("textarea[name='noidung']").val("");
                            Swal.fire({
                                title: 'Thành công!',
                                text: 'Thêm bình luận thành công!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                    }
                );
            });
    });