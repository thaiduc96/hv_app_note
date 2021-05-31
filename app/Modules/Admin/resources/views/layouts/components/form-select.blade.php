<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <select class="form-control select2  {{ $name }}" name="{{ $name }}" id="{{ $name }}">
        @foreach ($list as $key => $item)
            <option value="{{ !empty($isEnum) ? $key : $item->id }}" {{ old($name, !empty($model) ? (($model->$name == (!empty($isEnum) ? $key : $item->id) ) ? "selected" : "") : ""   ) }}>
                {{ !empty($isEnum) ? $item : $item->name }}
            </option>
        @endforeach
    </select>
    {!! $errors->first($name, '<p  style="color:red;" class="help-block mb-0">:message</p>') !!}
</div>
