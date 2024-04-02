@extends('laradump::layouts.base')

@section('content')
<div class="card_header">
  <h4 class="card_title">
    {{$message}}
    @isset($badge)
    <x-laradump-badge :badge="$badge" />
    @endisset
  </h4>
  <span class="card_time">{{date('H:i:s')}}</span>
</div>
<div class="card_query">
  {!! $context !!}
</div>
<div class="card_footer justify-end">
  <x-laradump-call-path :calledBy="$call" />
</div>
@endsection