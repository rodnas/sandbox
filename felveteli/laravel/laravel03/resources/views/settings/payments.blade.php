@extends("main")

@section("content")
<h6>Tranzakciók</h6>
<hr />

<div class="alert alert-info">
    <p class="mb-0">
        A tranzakciók feldolgozása körülbelül 1-5 percet vesz igénybe. <a href="/payments">Oldal frissítése</a>
    </p>
</div>

<div class="tab-content">
    <div class="tab-pane show active" id="my-favs">
        <div class="ui-block">
            <ul class="notification-list friend-requests">
            @foreach($payments as $payment)
            <li>
                <div class="notification-event">
                    <strong>{{ $payment->name }}</strong><br />
                    <small>Dátum: {{ $payment->created_at }}</small><br />
                    <small>Azonosító: {{ $payment->id }}</small>
                </div>
                <span class="notification-icon mt-2">
                    {{ number_format($payment->price, 0, ' ', ' ') }} Ft

                    @if($payment->status == "P")
                    <span class="btn btn-gold mb-0" style="margin-left: 10px">
                        Folyamatban
                    </span>
                    @elseif($payment->status == "S")
                    <span class="btn btn-green mb-0" style="margin-left: 10px">
                        Befejezve
                    </span>
                    @elseif($payment->status == "C")
                    <span class="btn btn-black mb-0" style="margin-left: 10px">
                        Megszakítva
                    </span>
                    @elseif($payment->status == "D")
                    <span class="btn btn-black mb-0" style="margin-left: 10px">
                        Elutasítva
                    </span>
                    @else
                    <span class="btn btn-black mb-0" style="margin-left: 10px">
                        Hiba
                    </span>
                    @endif
                </span>
            </li>
            @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
