@extends('laradump::layouts.base')

@section('content')
<div class="card_header">
  <h4 class="card_title">{{$subject}}</h4>
  <span class="card_time">{{date('H:i:s')}}</span>
</div>
@isset($from['address'])
<span class="card_header_title">From : {{$from['address']}}</span>
@endisset
@isset($to['address'])
<span class="card_header_title">To : {{$to['address']}}</span>
@endisset
@isset($cc['address'])
<span class="card_header_title">CC : {{$cc['address']}}</span>
@endisset
@isset($bcc['address'])
<span class="card_header_title">BCC : {{$bcc['address']}}</span>
@endisset
<div class="card_mail">
  {!! $html !!}
</div>
<div class="card_footer">
  <span class="class">{{$mailable_class}}</span>
  <x-laradump-call-path :calledBy="$call" />
</div>
@endsection