<div class="card">
    <div class="flex">
      <div class="flex flex-col mx-5 w-full">
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
          <a class="card_code" onclick="openCode(`{{str_replace('\\','\\\\',$call['file_path'])}}`,{{$call['line']}})">{{$call['file_name']}}:{{$call['line']}}</a>
        </div>
      </div>
    </div>
</div>
