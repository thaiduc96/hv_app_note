
<div class="animated-checkbox">
    <label>
        <input class="form-check-input  {{ $name }}" type="checkbox" name="{{ $name }}" id="{{ $name }}"
            {{ (!empty($model->$name ) OR !empty($checked)) ? "checked" : "" }}>
        <span class="label-text">{{ $label }}</span>
    </label>
</div>
@error($name)
<span class="invalid-feedback" role="alert">
       <strong>{{ $message }}</strong>
    </span>
@enderror
