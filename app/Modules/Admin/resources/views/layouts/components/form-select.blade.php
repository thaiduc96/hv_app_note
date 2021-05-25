<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <select class="form-control select2  {{ $name }}" name="{{ $name }}" id="{{ $name }}">
        @foreach ($list as $item)
            <option value="{{ $item->id }}"
                {{ old($name, !empty($model) ? (($model->$name == $item->id ) ? "selected" : "") : ""   ) }}
            >
                {{ $item->name }}
            </option>
        @endforeach
    </select>
    {!! $errors->first($name, '<p  style="color:red;" class="help-block mb-0">:message</p>') !!}
</div>
