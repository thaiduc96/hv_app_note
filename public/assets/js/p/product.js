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
        {data: 'name', name: 'name', "className": "text-center"},
        {data: 'price', name: 'price', "className": "text-center"},
        {data: 'image', name: 'image', "className": "text-center"},
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
$("#data-datatables_filter").hide();
$('#search-form').on('submit', function (e) {
    oTable.draw();
    e.preventDefault();
});

showImage('image');

$('body').on('click', '.btn-submit', function (e) {
    updateFormFile();
});
