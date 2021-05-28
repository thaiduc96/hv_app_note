let oTable = dataTables(
    {
        "url": $("#datatable_url").val(),
        "dataType": "json",
        "type": "GET",
        "data": function (d) {
            d.code = $('input[name=search_code]').val();
            d.receiver_phone = $('input[name=search_receiver_phone]').val();
            d.receiver_name = $('input[name=search_receiver_name]').val();
            d.delivery_time = $('input[name=search_delivery_time]').val();
            d.status = $('select[name=search_status]').val();
        },
    },
    [
        {data: 'code', name: 'code', "className": "text-center"},
        {data: 'receiver_info', name: 'receiver_info'},
        {data: 'total', name: 'total'},
        {data: 'delivery_range_time', name: 'delivery_time_from'},
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
