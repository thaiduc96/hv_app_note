let oTable = dataTables(
    {
        "url": $("#datatable_url").val(),
        "dataType": "json",
        "type": "GET",
        "data": function (d) {
            d.address = $('input[name=search_address]').val();
            d.zalo_phone = $('input[name=search_zalo_phone]').val();
        },
    },
    [
        {data: 'address', name: 'address', "className": "text-center"},
        {data: 'zalo_phone', name: 'zalo_phone', "className": "text-center"},
        {data: 'status', name: 'status', "className": "text-center"},
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

$('body').on('click', '.btn-submit', function (e) {
    updateFormFile();
});
