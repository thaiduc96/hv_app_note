
<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <textarea rows="10" class="form-control {{ $name }} {{ !empty($summernote) ? "summernote" : "" }}" rows="8" id="{{ $name }}" name="{{ $name }}">{!! old($name, !empty($model) ? $model->$name : null) !!}</textarea>
    @if ($errors->has($name))
        @foreach ($errors->get($name) as $error)
            <span class="error"> {!! $error !!} </span>
        @endforeach
    @endif
</div>
