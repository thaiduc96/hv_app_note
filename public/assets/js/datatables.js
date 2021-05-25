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
