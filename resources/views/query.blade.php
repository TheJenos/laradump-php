<div class="card">
    <div class="flex">
      <div class="flex flex-col mx-5 w-full">
        <div class="card_header">
          <h4 class="card_title">Query Excucation</h4>
          <span class="card_time">{{date('H:i:s')}}</span>
        </div>
        <div class="card_query">
            {{ $query }}
        </div>
        <div class="card_footer">
          <span>{{ $time }}μs on ({{ $connectionName }})</span>
          <a class="card_code" onclick="openCode(`{{str_replace('\\','\\\\',$call['file_path'])}}`,{{$call['line']}})">{{$call['file_name']}}:{{$call['line']}}</a>
        </div>
      </div>
    </div>
</div>
