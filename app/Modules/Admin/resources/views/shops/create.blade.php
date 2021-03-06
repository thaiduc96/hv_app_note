@extends('Admin::layouts.default')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> Quản lí địa chỉ</h1>
                <p>{{  empty($model->id) ? "Thêm mới" : "Sửa $model->name" }}</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fa fa-home fa-lg"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('admin.shops.index') }}">Quản lí địa chỉ </a></li>
                <li class="breadcrumb-item"><a href="#">{{ empty($model->id) ? "Thêm mới" : "Sửa " }}</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="tile">
                    <div class="tile-body">
                        <form id="data-form" method="{{ empty($model->id) ? "POST" : "PUT"  }}" action="{{ empty($model->id) ? route('admin.shops.store') : route('admin.shops.update',$model->id) }}"
                              data-backpage="{{ route('admin.shops.index') }}">
                            @include("Admin::layouts.components.form-input",['model' => $model,'errors' => $errors,'name' => 'address','label' => 'Địa chỉ *','type' => 'text'])
                            @include("Admin::layouts.components.form-input",['model' => $model,'errors' => $errors,'name' => 'zalo_phone','label' => 'SĐT Zalo *','type' => 'text'])
                            <div class="row">
                                <div class="col-md-6">
                                    @include("Admin::layouts.components.form-input",['model' => $model,'errors' => $errors,'name' => 'latitude','label' => 'Vĩ độ *','type' => 'number'])
                                </div>
                                <div class="col-md-6">
                                    @include("Admin::layouts.components.form-input",['model' => $model,'errors' => $errors,'name' => 'longitude','label' => 'Kinh độ *','type' => 'number'])
                                </div>
                            </div>
                            @include("Admin::layouts.components.form-checkbox-flip",['model' => $model,'errors' => $errors,'name' => 'status','label' => 'Trạng thái'])
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
    <script src="{{ asset('assets/js/p/shop.js') }}"></script>
@endpush
