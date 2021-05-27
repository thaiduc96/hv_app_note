
@switch($status)
    @case(STATUS_ACTIVE)
        <span class="badge badge-success">Hiện</span>
        @break
    @case(STATUS_INACTIVE)
        <span class="badge badge-danger">Ẩn</span>
        @break
    @case(\App\Models\Order::STATUS_PENDING)
        <span class="badge badge-warning">{{ \App\Models\Order::listStatus()[\App\Models\Order::STATUS_PENDING] }}</span>
        @break
    @case(\App\Models\Order::STATUS_COMPLETE)
        <span class="badge badge-success">{{ \App\Models\Order::listStatus()[\App\Models\Order::STATUS_COMPLETE] }}</span>
        @break
    @case(\App\Models\Order::STATUS_CANCEL)
        <span class="badge badge-danger">{{ \App\Models\Order::listStatus()[\App\Models\Order::STATUS_CANCEL] }}</span>
        @break
    @default
        {{ " " }}
@endswitch
