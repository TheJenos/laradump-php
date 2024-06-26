@extends('laradump::layouts.base')

@section('content')
<div class="card_header">
  <h4 class="card_title">Query Execution</h4>
  <span class="card_time">{{date('H:i:s')}}</span>
</div>
<div class="card_query">
  {!! $query !!}
</div>
<div class="card_footer flex justify-between">
  <div><span>{{ $time }}μs on ({{ $connectionName }})</span></div>
  <x-laradump-call-path :calledBy="$call" />
</div>
@endsection