<div >
    @if(!empty($link))
        <a href="{{ $link }}" target="_blank">
            @endif
            @if(!empty($name))
                <h5 style="text-transform: uppercase"><strong>{{$name}}</strong></h5>
            @endif
            @if(!empty($phone))
                <h6 style="text-transform: uppercase">{{$phone}}</h6>
            @endif
            @if(!empty($address))
                <h6 style="text-transform: uppercase">{{$address}}</h6>
            @endif
            @if(!empty($link))
        </a>
    @endif
</div>

