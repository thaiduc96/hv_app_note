@component('mail::message')
    <div id="mailmillieu">
        <div>
            <div style="padding:8px"></div>
        </div>
        <div>
            <table cellpadding="0" cellspacing="0" width="800">
                <tbody>
                <tr>
                    <td style="padding:10px 10px 10px 12px;border:1px solid #0b78bf;">
                        Mã code reset lại password : {{$code}}
                </tr>
                </tbody>
            </table>
        </div>
    </div>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
