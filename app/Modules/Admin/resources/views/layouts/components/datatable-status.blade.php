
@switch($status)
    @case(STATUS_ACTIVE)
        <span class="badge badge-success">Hiện</span>
        @break
    @case(STATUS_INACTIVE)
        <span class="badge badge-danger">Ẩn</span>
        @break
    @default
    {{ '121' }}
@endswitch
