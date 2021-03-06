@extends('Admin::layouts.default')

@section('content')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-calendar-o"></i> Quản lý thông báo</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fa fa-home fa-lg"></i></a>
                </li>
                <li class="breadcrumb-item"> Quản lý thông báo</li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <form class="row" role="form" id="search-form" method="post">
                            <div class="form-group col-md-2">
                                <label class="control-label">Tiêu đề </label>
                                <input class="form-control search_name" name="search_name" id="search_name">
                            </div>
                            <div class="form-group col-md-3 align-self-end">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-search"></i>Tìm
                                    kiếm
                                </button>
                                <a class="btn btn-outline-success" href="{{ route('admin.notifications.create') }}">
                                    <i class="fa fa-plus" aria-hidden="true"></i>Thêm mới
                                </a>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <br>
                    <div class="tile-body">
                        <div class=" table-responsive">
                            <input type="hidden" id="datatable_url" value="{{ route('admin.notifications.index') }}">
                            <table class="table table-hover table-bordered" id="data-datatables">
                                <thead>
                                <tr>
                                    <th>Tiêu đề</th>
                                    <th>Ảnh</th>
                                    <th>Ngày tạo</th>
                                    <th>Trạng thái gửi</th>
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
    <script src="{{ asset('assets/js/p/notification.js') }}"></script>
@endpush
