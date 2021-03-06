@extends('Admin::layouts.default')

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-calendar-o"></i> Quản lýđơn hàng</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fa fa-home fa-lg"></i></a>
                </li>
                <li class="breadcrumb-item"> Quản lýđơn hàng</li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <form class="row" role="form" id="search-form" method="post">
                            <div class="form-group col-md-2">
                                <label class="control-label">Mã đơn hàng</label>
                                <input class="form-control" name="search_code">
                            </div>
                            <div class="form-group col-md-2">
                                <label class="control-label">Thời gian giao</label>
                                <input class="form-control" name="search_delivery_time">
                            </div>
                            <div class="form-group col-md-2">
                                <label class="control-label">Tên người nhận</label>
                                <input class="form-control " name="search_receiver_name">
                            </div>
                            <div class="form-group col-md-2">
                                <label class="control-label">SĐT người nhận</label>
                                <input class="form-control " name="search_receiver_phone">
                            </div>
                            <div class="form-group col-md-2">
                                <label class="control-label">Trạng thái</label>
                                <select class="form-control" name="search_status">
                                    <option value="">Tất cả</option>
                                    @foreach(\App\Models\Order::listStatus() as $key =>  $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3 align-self-end">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-search"></i>Tìm
                                    kiếm
                                </button>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <br>
                    <div class="tile-body">
                        <div class=" table-responsive">
                            <input type="hidden" id="datatable_url" value="{{ route('admin.orders.index') }}">
                            <table class="table table-hover table-bordered" id="data-datatables">
                                <thead>
                                <tr>
                                    <th>Mã</th>
                                    <th>Thông tin người đặt</th>
                                    <th>Số tiền</th>
                                    <th>Thời gian giao</th>
                                    <th>Trạng thái</th>
                                    <th>Tác vụ</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/p/order.js') }}"></script>.
    <script>

        $('input[name=search_delivery_time]').daterangepicker({
            autoApply: true,
            timePicker: true,
            timePicker24Hour: true,
            timePickerIncrement: 5,
            timePickerSeconds: false,
            locale: {
                format: 'HH:mm',
                cancelLabel: 'Xoá',
                applyLabel: 'Chọn',
            }
        }).on('show.daterangepicker', function (ev, picker) {
            picker.container.find(".calendar-table").hide();
        }).on('cancel.daterangepicker', function (ev, picker) {
            $('input[name=search_delivery_time]').val('');
        });
    </script>
@endpush
