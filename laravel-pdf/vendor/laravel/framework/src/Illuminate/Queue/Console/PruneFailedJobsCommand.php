<?php

namespace Illuminate\Queue\Console;

<<<<<<< HEAD
use Illuminate\Console\Command;
use Illuminate\Queue\Failed\PrunableFailedJobProvider;
use Illuminate\Support\Carbon;
=======
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Queue\Failed\PrunableFailedJobProvider;
>>>>>>> origin/New-FakeMain

class PruneFailedJobsCommand extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'queue:prune-failed
                {--hours=24 : The number of hours to retain failed jobs data}';

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
    protected static $defaultName = 'queue:prune-failed';

    /**
=======
>>>>>>> origin/New-FakeMain
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prune stale entries from the failed jobs table';

    /**
     * Execute the console command.
     *
     * @return int|null
     */
    public function handle()
    {
        $failer = $this->laravel['queue.failer'];

<<<<<<< HEAD
=======
        $count = 0;

>>>>>>> origin/New-FakeMain
        if ($failer instanceof PrunableFailedJobProvider) {
            $count = $failer->prune(Carbon::now()->subHours($this->option('hours')));
        } else {
            $this->error('The ['.class_basename($failer).'] failed job storage driver does not support pruning.');

            return 1;
        }

        $this->info("{$count} entries deleted!");
    }
}
