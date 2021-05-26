<p><b>{{ $label }}</b></p>
<div class="toggle-flip">
    <label>
        <input type="checkbox" name="{{ $name }}" id="{{ $name }}"><span class="flip-indecator"
                                                                         data-toggle-on="{{ $labelOn ?? 'Hiện'  }}"
                                                                         data-toggle-off="{{ $labelOff ?? 'Ẩn'  }}"></span>
    </label>
</div>
@error($name)
<span class="invalid-feedback" role="alert">
       <strong>{{ $message }}</strong>
    </span>
@enderror
