let oTable = dataTables(
    {
        "url": $("#datatable_url").val(),
        "dataType": "json",
        "type": "GET",
        "data": function (d) {
            d.name = $('input[name=search_name]').val();
        },
    },
    [
        {data: 'title', name: 'title', "className": "text-center"},
        {data: 'image', name: 'image', "className": "text-center"},
        {data: 'created_at', name: 'created_at', "className": "text-center"},
        {data: 'is_sent', name: 'is_sent', "className": "text-center"},
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false,
            "className": "text-center",
            width: "11%",
        }
    ]);
$('#search-form').on('submit', function (e) {
    oTable.draw();
    e.preventDefault();
});

showImage('image');

$('body').on('click', '.btn-submit', function (e) {
    updateFormFile();
})

$('body').on('change', '.status', function (e) {
    const href = $("#url-update-patch").data('href');
    const data = {
      'status' :  $(this).children("option").filter(":selected").val()
    };
    updatePatch(href,data);
});

function updatePatch(href, data) {
    $.ajax({
        type: 'PATCH',
        url: href,
        dataType: 'json',
        data: data,
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
