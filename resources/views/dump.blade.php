<div class="card">
    <div class="flex">
      <div class="flex flex-col mx-5 w-full">
        <div class="card_header">
          <span class="card_time">{{date('H:i:s')}}</span>
        </div>
        @foreach ($dumps as $dump)
        <div class="card_dump">
            {!! $dump !!}
        </div>
        @endforeach
        <div class="card_footer">
          <a class="card_code" onclick="openCode(`{{str_replace('\\','\\\\',$call['file_path'])}}`,{{$call['line']}})">{{$call['file_name']}}:{{$call['line']}}</a>
        </div>
      </div>
    </div>
</div>
