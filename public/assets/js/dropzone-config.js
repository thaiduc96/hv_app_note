const maxFileUpload = 10;
let removeCallback = undefined;
let arrFileIds = [];
Dropzone.options.myDropzone = {
    acceptedFiles: 'image/*',
    maxFiles: maxFileUpload,
    uploadMultiple: true,
    parallelUploads: 16,
    maxFilesize: 16,
    previewTemplate: document.querySelector('#preview-dropzone').innerHTML,
    addRemoveLinks: true,
    dictRemoveFile: 'Xoá tập tin',
    dictFileTooBig: 'Tập tin quá lớn, vui lòng chọn tập tin nhỏ hơn 16MB',
    dictRemoveFileConfirmation: 'Bạn thực sự muốn xoá tập tin này?',
    timeout: 10000,
    renameFile: function (file) {
        return file.name;
    },
    init: function () {
        this.on("removedfile", function (file) {
            console.log(file);
            if ($.inArray(file.id, arrFileIds) >= 0) {
                arrFileIds.splice($.inArray(file.id, arrFileIds), 1);
                console.log(file.href_delete);
                deleteData(file.hrefDelete ?? file.href_delete);
                $("#productImages").val(arrFileIds);
            }
        });

        this.on("addedfile", function (event) {
            while (this.files.length > this.options.maxFiles) {
                this.removeFile(this.files[0]);
            }
        });

        this.on('success', function (file, response) {
            if (response.success === true) {
                $.each(response.data, function (key, value) {
                    file.id = value.id;
                    file.hrefDelete = value.href_delete;
                    if ($.inArray(file.id, arrFileIds) < 0) {
                        arrFileIds.push(file.id);
                    }
                });
                $("#productImages").val(arrFileIds);
            }
        });

        myDropzone = this;
        const urlGetOldImage = $("#url-get-image").val();
        if (urlGetOldImage) {
            $.ajax({
                url: $("#url-get-image").val(),
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    $.each(response.data, function (key, file) {
                        var mockFile = file;
                        myDropzone.emit("addedfile", mockFile);
                        myDropzone.emit("thumbnail", mockFile, file.image_thumbnail_path);
                        myDropzone.emit("complete", mockFile);

                        if ($.inArray(file.id, arrFileIds) < 0) {
                            arrFileIds.push(file.id);
                        }
                    });
                }
            });
        }
    },
    success: function (file, done) {
        // console.log(this.files);
        // console.log(file);
        // alert('thành công');
        // console.log(file);/
    }
};

Dropzone.confirm = function (question, fnAccepted, fnRejected) {
    // retain the callback to invoke to accept the removal
    removeCallback = fnAccepted;
    swal({
        title: "Bạn có chắc muốn xoá ảnh này ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Xoá!",
        cancelButtonText: "Không",
        closeOnConfirm: true,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            if (removeCallback) {
                removeCallback();
            }
        } else {
        }
    });
};

