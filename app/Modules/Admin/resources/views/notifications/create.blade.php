@extends('Admin::layouts.default')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> Quản lí thông báo</h1>
                <p>{{  empty($model->id) ? "Thêm mới" : "Sửa $model->name" }}</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fa fa-home fa-lg"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('admin.notifications.index') }}">Quản lí thông báo </a></li>
                <li class="breadcrumb-item"><a href="#">{{ empty($model->id) ? "Thêm mới" : "Sửa " }}</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="tile">
                    <div class="tile-body">
                        <form id="data-form" method="{{ empty($model->id) ? "POST" : "PUT"  }}" action="{{ empty($model->id) ? route('admin.notifications.store') : route('admin.notifications.update',$model->id) }}"
                              data-backpage="{{ route('admin.notifications.index') }}">
                            @include("Admin::layouts.components.form-input",['model' => $model,'errors' => $errors,'name' => 'title','label' => 'Tiêu đề *','type' => 'text'])
                            @include("Admin::layouts.components.form-input",['model' => $model,'errors' => $errors,'name' => 'short_body','label' => 'Nội dung rút gọn *','type' => 'text'])
                            @include("Admin::layouts.components.form-checkbox-flip",['errors' => $errors,'name' => 'is_sent','label' => 'Gửi', 'labelOn' => 'Có', 'labelOff' => 'Không'])
                            @include("Admin::layouts.components.form-image",['model' => $model,'errors' => $errors,'name' => 'image','label' => 'Ảnh *'])
                            @include("Admin::layouts.components.form-textarea",['model' => $model,'errors' => $errors,'name' => 'body','label' => 'Nội dung'])
                        </form>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary btn-submit" type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/p/notification.js') }}"></script>
@endpush
