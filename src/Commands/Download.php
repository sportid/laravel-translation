<?php

namespace Vemcogroup\Translation\Commands;

use Exception;
use Illuminate\Console\Command;
use Vemcogroup\Translation\Translation;

class Download extends Command
{
    protected $signature = 'translation:download
                            {--skip-trimming : Whether translation trimming should be skipped}';
    protected $description = 'Download all languages from POEditor';

    public function handle(): void
    {
        try {
            $this->info('⬇️  Preparing to download languages');

            $languages = app(Translation::class)->download($this->option('skip-trimming'));

            $this->info('⬇️  Finished downloading languages: ' . $languages->implode(', '));
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
