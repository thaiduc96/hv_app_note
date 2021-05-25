
@isset($edit)
    <a type="button" href="{{$edit}}" class="btn btn-primary mb-10 fa fa-edit btn-sm btn-rounded-20"></a>
@endisset

@isset($recovery)
    <button type="button" data-href="{{$recovery}}" data-message="Bạn chắc chắn muốn khôi phục dữ liệu này?"
            class="btn btn-warning mb-10 fa fa-undo btn-sm btn-rounded-20 restore_data"></button>
@endisset
@isset($delete)
    <button data-href="{{$delete}}" data-message="{{$specialMsg ?? ''}}"
            class="btn btn-danger mb-10 fa fa-trash btn-sm btn-rounded-20 delete_data"></button>
@endisset
@isset($view)
    <a type="button" href="{{$view}}" class="btn btn-cyan mb-10 fa fa-eye btn-sm btn-rounded-20"></a>
@endisset
