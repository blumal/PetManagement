<?php

namespace Illuminate\Queue\Console;

use Illuminate\Console\Command;

class ForgetFailedCommand extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'queue:forget {id : The ID of the failed job}';

    /**
<<<<<<< HEAD
     * The name of the console command.
     *
     * This name is used to identify the command during lazy loading.
     *
     * @var string|null
     *
     * @deprecated
     */
    protected static $defaultName = 'queue:forget';

    /**
=======
>>>>>>> origin/New-FakeMain
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a failed queue job';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->laravel['queue.failer']->forget($this->argument('id'))) {
<<<<<<< HEAD
            $this->info('Failed job deleted successfully.');
=======
            $this->info('Failed job deleted successfully!');
>>>>>>> origin/New-FakeMain
        } else {
            $this->error('No failed job matches the given ID.');
        }
    }
}
