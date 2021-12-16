<?php

namespace Shawnveltman\Texthelpers\Commands;

use Illuminate\Console\Command;

class TexthelpersCommand extends Command
{
    public $signature = 'texthelpers';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
