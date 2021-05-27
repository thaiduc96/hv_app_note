
function dataTables(route, columns, id = '#data-datatables', orderCol = 0) {
    return $(id).DataTable({
        processing: true,
        serverSide: true,
        info: true,
        autoWidth: false,
        ajax: route,
        columns: columns,
        order: [[orderCol, "DESC"]],
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement("input");
                input.style.width = '100%';
                $(input).appendTo($(column.footer()).empty())
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        column.search(val ? val : '', true, false).draw();
                    });
            });
        },
        language: {
            "lengthMenu": "Hiển thị _MENU_ bản ghi mỗi trang",
            "zeroRecords": "Không có bản ghi nào!",
            "info": "Hiển thị trang _PAGE_ của tổng _PAGES_ trang",
            "infoEmpty": "Không có bản ghi nào!!!",
            "infoFiltered": "(Đã lọc từ tổng _MAX_ bản ghi)",
            "search" : "Tìm kiếm chi tiết",
            "paginate": {
                "previous": "Trang trước",
                "first": "Trang đầu",
                "next": "Trang sau",
                "last": "Trang cuối",
            },
            processing: '<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i><span class="sr-only">Tải dữ liệu...</span>'
        },
        pageLength: 10
    });
}

function showImage(className) {
    $('body').on('change', "." + className, function (e) {
        var imageShowName = className + "-show";
        $("." + imageShowName).remove();
        for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
            var file = e.originalEvent.srcElement.files[i];
            var img = document.createElement("img");
            img.className = imageShowName;
            var reader = new FileReader();
            reader.onloadend = function () {
                img.src = reader.result;
            }
            reader.readAsDataURL(file);
            $("." + className).after(img);
            $("." + imageShowName).addClass('image-in-form');
        }
    });
}

function updateFormFile( formId= "form#data-form") {


    const form = $(formId );
    const formData = new FormData(form[0]);
    formData.append("_method",  form.attr('method'));

    form.find('span.messageErrors').remove();
    form.find("br").remove();

    $.ajax({
        type: 'POST',
        url:  form.attr('action'),
        data: formData,
        processData: false,
        enctype: 'multipart/form-data',
        dataType: 'json',
        contentType: false,
        success: function (result) {
            if(result.success == true){
                showSuccess();
                const backpage = form.data('backpage');
                if(backpage){
                    setTimeout(function () {
                        window.location.replace(backpage);
                    }, 1500);
                }else{
                    oTable.draw();
                }
            }
        }, error: function (errors) {
            const response = errors.responseJSON;
            showError(response.errorMessage);
            $.each(response.errorMessageArray, function (elementName, arrMessagesEveryElement) {
                $.each(arrMessagesEveryElement, function (messageType, messageValue) {
                    $('form#data-form').find('.' + elementName).parents('.form-group').append('<span class="messageErrors" style="color:red">' + messageValue + '</span><br>');
                });
            });
        }
    });
}


$('body').on('click', '.restore_data', function (e) {
    e.preventDefault();
    var href = $(this).data('href');
    swal({
        title: "Bạn có muốn khôi phục dữ  liệu này không ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Khôi phục !",
        cancelButtonText: "Không",
        closeOnConfirm: true,
        closeOnCancel: true
    }, function(isConfirm) {
        if (isConfirm) {
            restoreData(href);
            // swal("Đã xoá!", "Your imaginary file has been deleted.", "success");
        } else {
            // swal("Đã huỷ", "Dữ liệu của bạn được ", "error");
        }
    });
});


function restoreData(href) {
    $.ajax({
        type: 'PATCH',
        url: href,
        dataType: 'json',
        success: function (data) {
            if (data.success === true) {
                showSuccess();
                oTable.draw();
            }
        }, error: function (data) {
            showError(data.responseJSON.errorMessage);
        }
    }).done(function (data) {

        $(this).prop('disabled', false);
    });
}

$('body').on('click', '.delete_data', function (e) {
    e.preventDefault();
    var href = $(this).data('href');
    swal({
        title: "Bạn có muốn xoá dữ liệu này ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Xoá!",
        cancelButtonText: "Không",
        closeOnConfirm: true,
        closeOnCancel: true
    }, function(isConfirm) {
        if (isConfirm) {
            deleteData(href);
            // swal("Đã xoá!", "Your imaginary file has been deleted.", "success");
        } else {
            // swal("Đã huỷ", "Dữ liệu của bạn được ", "error");
        }
    });
})


function deleteData(href) {
    $.ajax({
        type: 'DELETE',
        url: href,
        dataType: 'json',
        success: function (data) {
            if (data.success === true) {
                showSuccess();
                oTable.draw();
            }
        }, error: function (data) {
            showError(data.responseJSON.errorMessage);
        }
    }).done(function (data) {
        $(this).prop('disabled', false);
    });
}
