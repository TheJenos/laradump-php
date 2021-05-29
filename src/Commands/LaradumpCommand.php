<?php

namespace Thejenos\Laradump\Commands;

use Illuminate\Console\Command;

class LaradumpCommand extends Command
{
    public $signature = 'laradump';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
