<?php

namespace Illuminate\Queue\Console;

<<<<<<< HEAD
=======
use Carbon\Carbon;
>>>>>>> origin/New-FakeMain
use Illuminate\Bus\BatchRepository;
use Illuminate\Bus\DatabaseBatchRepository;
use Illuminate\Bus\PrunableBatchRepository;
use Illuminate\Console\Command;
<<<<<<< HEAD
use Illuminate\Support\Carbon;
=======
>>>>>>> origin/New-FakeMain

class PruneBatchesCommand extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'queue:prune-batches
                {--hours=24 : The number of hours to retain batch data}
                {--unfinished= : The number of hours to retain unfinished batch data }';

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
    protected static $defaultName = 'queue:prune-batches';

    /**
=======
>>>>>>> origin/New-FakeMain
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prune stale entries from the batches database';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $repository = $this->laravel[BatchRepository::class];

        $count = 0;

        if ($repository instanceof PrunableBatchRepository) {
            $count = $repository->prune(Carbon::now()->subHours($this->option('hours')));
        }

        $this->info("{$count} entries deleted!");

<<<<<<< HEAD
        if ($this->option('unfinished')) {
=======
        if ($unfinished = $this->option('unfinished')) {
>>>>>>> origin/New-FakeMain
            $count = 0;

            if ($repository instanceof DatabaseBatchRepository) {
                $count = $repository->pruneUnfinished(Carbon::now()->subHours($this->option('unfinished')));
            }

            $this->info("{$count} unfinished entries deleted!");
        }
    }
}
