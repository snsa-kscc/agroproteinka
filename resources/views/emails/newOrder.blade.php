@component('mail::message')
# Nova narudžba

**Tvrtka:** {{ $orderData['company'] }}<br>
**Adresa utovarnog mjesta:** {{ $orderData['address'] }}<br>
**Kontakt osoba:** {{ $orderData['contactPerson'] }}<br>
**Kontakt telefon:** {{ $orderData['contactPhone'] }}<br>
**Napomena:**<br>
{!! nl2br(strip_tags($orderData['note']), '<br>') !!}

@endcomponent
