<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <input accept="image/*" autocomplete="off" type="file"
           class="form-control {{ $name }} {{ $errors->has($name) ? 'has-error' : ''}}" name="{{ $name }}" id="{{ $name }}">
    @if(!empty($model))
        <img class="{{$name}}-in-form {{$name}}-show image-form" src="{{ asset($model->$name) }}" >
    @endif
    @error($name)
    <span class="invalid-feedback" role="alert">
       <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
