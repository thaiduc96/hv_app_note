@if(!empty($order->delivery_time_from))
    {{ $order->delivery_time_from }} ->   {{ $order->delivery_time_to }}
@else
    Tất cả thời gian trong ngày
@endif
