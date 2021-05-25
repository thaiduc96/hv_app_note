<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <select class="form-control select2  {{ $name }}" name="{{$name}}[]" id="{{ $name }}" multiple>
        @foreach ($list as $item)
            <option value="{{ $item->id }}"
            >
                {{ $item->name }}
            </option>
        @endforeach
    </select>
    {!! $errors->first($name, '<p  style="color:red;" class="help-block mb-0">:message</p>') !!}
</div>
@if(!empty($selectedIds))
<input type="hidden" id="selectedIds{{$name}}" value="{{ json_encode($selectedIds) }}">

@endif
