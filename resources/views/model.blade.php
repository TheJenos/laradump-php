@extends('laradump::layouts.base')

@section('content')
<div class="card_header">
  <h4 class="card_title">{{get_class($model)}}</h4>
  <span class="card_time">{{date('H:i:s')}}</span>
</div>
<div class="card_dump">
  {!! $dump !!}
</div>
@if(count($model->getRelations()) > 0)
<span class="card_header_title">Relations</span>
<div class="card_dump">
  {!! $relation !!}
</div>
@endif
<div class="card_footer">
  <x-laradump-call-path :calledBy="$call" />
</div>
@endsection