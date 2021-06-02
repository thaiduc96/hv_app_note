@extends('Admin::layouts.default')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> Quản lí sản phẩm</h1>
                <p>{{  empty($model->id) ? "Thêm mới" : "Sửa $model->name" }}</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fa fa-home fa-lg"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Quản lí sản phẩm </a></li>
                <li class="breadcrumb-item"><a href="#">{{ empty($model->id) ? "Thêm mới" : "Sửa " }}</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="tile">
                    <div class="tile-body">
                        <form id="data-form" method="{{ empty($model->id) ? "POST" : "PUT"  }}" action="{{ empty($model->id) ? route('admin.products.store') : route('admin.products.update',$model->id) }}"
                              data-backpage="{{ route('admin.products.index') }}">
                            @include("Admin::layouts.components.form-input",['model' => $model,'errors' => $errors,'name' => 'name','label' => 'Tên *','type' => 'text'])
                            @include("Admin::layouts.components.form-input",['model' => $model,'errors' => $errors,'name' => 'price','label' => 'Giá *','type' => 'number'])
                            @include("Admin::layouts.components.form-checkbox-flip",['model' => $model,'errors' => $errors,'name' => 'status','label' => 'Trạng thái'])
                            @include("Admin::layouts.components.form-image",['model' => $model,'errors' => $errors,'name' => 'image','label' => 'Ảnh *'])
                            @include("Admin::layouts.components.form-textarea",['model' => $model,'errors' => $errors,'name' => 'description','label' => 'Miêu tả'])

                            <input type="hidden" id="productImages" name="productImages">

                        </form>
                        <div class="col-md-12">
                            <div class="tile">
                                <div class="tile-body">
                                    <input type="hidden" id="url-delete-image" data-href="{{ url('admin/product-images') }}">

                                    @if(!empty($model->id))
                                        <input type="hidden" id="url-get-image" value="{{ route('admin.productImages.index',['product_id' => $model->id]) }}">
                                    @endif
                                    <form id="myDropzone" class="text-center dropzone" method="POST" enctype="multipart/form-data" action="{{ route('admin.productImages.uploadImage') }}">
                                        @csrf
                                        <div class="dz-message"><h5 class="text-info">Kéo thả hoặc click để upload ảnh</h5></div>
                                    </form>
                                </div>
                            </div>
                            @include('Admin::layouts.components.dropzone.preview')
                        </div>
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
    <script src="{{ asset('assets/js/dropzone-config.js') }}"></script>
    <script src="{{ asset('assets/js/p/product.js') }}"></script>
@endpush
