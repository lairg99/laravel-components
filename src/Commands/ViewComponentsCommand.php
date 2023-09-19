<?php

namespace Lairg\ViewComponents\Commands;

use Illuminate\Console\Command;

class ViewComponentsCommand extends Command
{
    public $signature = 'laravel-components';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
