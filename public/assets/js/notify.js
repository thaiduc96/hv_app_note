function showSuccess(msg, icon){
    $.notify({
        // title: "Update Complete : ",
        message: msg ?? "Thành công",
        icon: icon ?? 'fa fa-check'
    },{
        type: "info"
    });
}

function showError(msg, icon){
    $.notify({
        // title: "Update Complete : ",
        message: msg ?? "Thất bại",
        icon: icon ?? 'fa fa-times'
    },{
        type: "danger"
    });
}
