@extends('Admin::layouts.default')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> Quản lí đơn hàng</h1>
                <p>{{  empty($model->id) ? "Thêm mới" : "Sửa $model->name" }}</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fa fa-home fa-lg"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Quản lí đơn hàng </a></li>
                <li class="breadcrumb-item"><a href="#">{{ empty($model->id) ? "Thêm mới" : "Sửa " }}</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="tile">
                    <div class="tile-body">
                        <form id="data-form" method="{{ empty($model->id) ? "POST" : "PUT"  }}" action="{{ empty($model->id) ? route('admin.orders.store') : route('admin.orders.update',$model->id) }}"
                              data-backpage="{{ route('admin.orders.index') }}">
                            @include("Admin::layouts.components.form-input",['model' => $model,'errors' => $errors,'name' => 'name','label' => 'Tên *','type' => 'text'])
                            @include("Admin::layouts.components.form-input",['model' => $model,'errors' => $errors,'name' => 'price','label' => 'Giá *','type' => 'number'])
                            @include("Admin::layouts.components.form-checkbox-flip",['model' => $model,'errors' => $errors,'name' => 'status','label' => 'Trạng thái'])
                            @include("Admin::layouts.components.form-image",['model' => $model,'errors' => $errors,'name' => 'image','label' => 'Ảnh *'])
                            @include("Admin::layouts.components.form-textarea",['model' => $model,'errors' => $errors,'name' => 'description','label' => 'Miêu tả'])
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
    <script src="{{ asset('assets/js/p/product.js') }}"></script>
@endpush
