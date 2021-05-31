@extends('Admin::layouts.default')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> Quản lí đơn hàng</h1>
                <p>{{  empty($model->id) ? "Thêm mới" : "Chi tiết $model->code" }}</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fa fa-home fa-lg"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Quản lí đơn hàng </a></li>
                <li class="breadcrumb-item"><a href="#">{{ empty($model->id) ? "Thêm mới" : "Chi tiết " }}</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <section class="invoice">
                        <div class="row mb-4">
                            <div class="col-6">
                                <h2 class="page-header"><i class="fa fa-globe"></i> #{{ $model->code }}
                                    - {{ $model->receiver_name }}</h2>
                            </div>
                            <div class="col-6">
                                <h5 class="text-right">Ngày
                                    đặt: {{ \App\Helpers\DateHelper::formatDate($model->created_at) }}</h5>
                            </div>
                        </div>
                        <div class="row invoice-info">
                            <div class="col-4">
                                <h5>Thông tin người đặt</h5>
                                <address>
                                    <strong>{{ $model->receiver_name }}</strong><br>
                                    <strong>{{ $model->receiver_address }} </strong> <br>
                                    SĐT: <strong> {{ $model->receiver_phone }}  </strong><br>
                                </address>
                            </div>
                            <div class="col-4">
                                <h5>Thông tin đơn hàng</h5>
                                <address>
                                    Tổng tiền: <strong>{{ number_format($model->total) }}</strong><br>
                                    Số lượng sẩn phẩm: {{ count($model->products) }}<br>
                                    Thời gian giao hàng: <strong>{{ $model->delivery_time_from }}
                                        - {{ $model->delivery_time_to }} </strong> <br>
                                    {{--                                    Trạng thái: <strong> {{ \App\Models\Order::listStatus()[$model->status] }}</strong>--}}
                                    <div class="form-group">
                                        <label class="control-label">Thời gian giao</label>
                                        <input class="form-control" name="delivery_time">
                                    </div>
                                    @include("Admin::layouts.components.form-select",['model' => $model,'list' => \App\Models\Order::listStatus(),$errors,'name' => 'status','label' => 'Trạng thái','isEnum' => true])
                                    <input type="hidden" id="url-update-patch"
                                           data-href="{{ route('admin.orders.updatePatch',$model->id) }}">
                                </address>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Số lượng</th>
                                        <th>Sản phẩm</th>
                                        <th>Đơn giá</th>
                                        <th>Tổng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($model->products as $product)
                                        <tr>
                                            <td>{{ optional($product->pivot)->quantity }}</td>
                                            <td>{{ optional($product->pivot)->product_name }}</td>
                                            <td>{{ number_format(optional($product->pivot)->product_price)  }}</td>
                                            <td>{{ number_format(optional($product->pivot)->total)  }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row d-print-none mt-2">
                            <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print();"
                                                              target="_blank"><i class="fa fa-print"></i> Print</a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/p/product.js') }}"></script>
    <script>
        $('input[name=delivery_time]').daterangepicker({
            autoApply: true,
            timePicker: true,
            timePicker24Hour: true,
            timePickerIncrement: 5,
            timePickerSeconds: false,
            locale: {
                format: 'HH:mm',
                cancelLabel: 'Xoá',
                applyLabel: 'Cập nhật',
            },
            startDate: "{{ $model->delivery_time_from }}",
            endDate: "{{ $model->delivery_time_to }}"
        }, function (start, end, label) {
            const href = $("#url-update-patch").data('href');
            const data = {
                'delivery_time_from' : start.format('HH:mm:SS'),
                'delivery_time_to' : end.format('HH:mm:SS'),
            };
            updatePatch(href,data);
        }).on('show.daterangepicker', function (ev, picker) {
            picker.container.find(".calendar-table").hide();
        });
    </script>
@endpush
