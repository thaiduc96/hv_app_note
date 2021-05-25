@extends('Admin::layouts.default')

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-calendar-o"></i> Quản lý sản phẩm</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fa fa-home fa-lg"></i></a>
                </li>
                <li class="breadcrumb-item"> Quản lý sản phẩm</li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-outline-success" href="{{ route('admin.products.create') }}">
                                <i class="fa fa-plus" aria-hidden="true"></i>Thêm mới
                            </a>
                        </div>
                    </div>
                    <br>
                    <div class="tile-body">
                        <div class=" table-responsive">
                            <input type="hidden" id="datatable_url" value="{{ route('admin.products.index') }}">
                            <table class="table table-hover table-bordered" id="data-datatables">
                                <thead>
                                <tr>
                                    <th>Tên</th>
                                    <th>Giá</th>
                                    <th>Ảnh</th>
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
    <script src="{{ asset('assets/js/p/product.js') }}"></script>
@endpush
