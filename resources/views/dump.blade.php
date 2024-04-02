@extends('laradump::layouts.base')

@section('content')
<div class="card_header">
  <span class="card_time">{{date('H:i:s')}}</span>
</div>
@foreach ($dumps as $dump)
<div class="card_dump">
  {!! $dump !!}
</div>
@endforeach
<div class="card_footer">
  <x-laradump-call-path :calledBy="$call" />
</div>
@endsection