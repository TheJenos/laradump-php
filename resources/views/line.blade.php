@extends('laradump::layouts.base')

@section('content')
<div class="card_header flex flex-wrap items-center gap-2">
  <h4 class="card_title">
    {{$title}}
    @isset($badge)
    <x-laradump-badge :badge="$badge" />
    @endisset
  </h4>
  <div>on</div>
  <x-laradump-call-path :calledBy="$call" />
  <span class="card_time">{{date('H:i:s')}}</span>
</div>
@endsection