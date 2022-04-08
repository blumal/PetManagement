<?php

namespace Illuminate\Console\Scheduling;

use Illuminate\Console\Command;
use Illuminate\Console\Events\ScheduledBackgroundTaskFinished;
use Illuminate\Contracts\Events\Dispatcher;

class ScheduleFinishCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'schedule:finish {id} {code=0}';

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
    protected static $defaultName = 'schedule:finish';

    /**
=======
>>>>>>> origin/New-FakeMain
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Handle the completion of a scheduled command';

    /**
     * Indicates whether the command should be shown in the Artisan command list.
     *
     * @var bool
     */
    protected $hidden = true;

    /**
     * Execute the console command.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function handle(Schedule $schedule)
    {
        collect($schedule->events())->filter(function ($value) {
            return $value->mutexName() == $this->argument('id');
        })->each(function ($event) {
<<<<<<< HEAD
            $event->finish($this->laravel, $this->argument('code'));
=======
            $event->callafterCallbacksWithExitCode($this->laravel, $this->argument('code'));
>>>>>>> origin/New-FakeMain

            $this->laravel->make(Dispatcher::class)->dispatch(new ScheduledBackgroundTaskFinished($event));
        });
    }
}
