<div class="form-group">
    <label for="{{ $name }}" class="control-label">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}"
           class="form-control {{ $name }}   @error($name) is-invalid @enderror"
           placeholder="{{ $placeholder ?? '' }}"
           id="{{ $name }}"
           autofocus
           {{ isset($required) ? 'required' : '' }}
           value="{{ old($name, ($type != 'password') ? !empty($model) ? $model->$name : ($type == 'number' ? 0 : null) : null ) }}">
    @error($name)
    <span class="invalid-feedback" role="alert">
       <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

