<?php

namespace Illuminate\Foundation\Console;

use Illuminate\Console\Command;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;
<<<<<<< HEAD
=======
use Illuminate\Support\Str;
>>>>>>> origin/New-FakeMain

class EventGenerateCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'event:generate';

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
    protected static $defaultName = 'event:generate';

    /**
=======
>>>>>>> origin/New-FakeMain
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the missing events and listeners based on registration';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $providers = $this->laravel->getProviders(EventServiceProvider::class);

        foreach ($providers as $provider) {
            foreach ($provider->listens() as $event => $listeners) {
                $this->makeEventAndListeners($event, $listeners);
            }
        }

<<<<<<< HEAD
        $this->info('Events and listeners generated successfully.');
=======
        $this->info('Events and listeners generated successfully!');
>>>>>>> origin/New-FakeMain
    }

    /**
     * Make the event and listeners for the given event.
     *
     * @param  string  $event
     * @param  array  $listeners
     * @return void
     */
    protected function makeEventAndListeners($event, $listeners)
    {
<<<<<<< HEAD
        if (! str_contains($event, '\\')) {
=======
        if (! Str::contains($event, '\\')) {
>>>>>>> origin/New-FakeMain
            return;
        }

        $this->callSilent('make:event', ['name' => $event]);

        $this->makeListeners($event, $listeners);
    }

    /**
     * Make the listeners for the given event.
     *
     * @param  string  $event
     * @param  array  $listeners
     * @return void
     */
    protected function makeListeners($event, $listeners)
    {
        foreach ($listeners as $listener) {
            $listener = preg_replace('/@.+$/', '', $listener);

            $this->callSilent('make:listener', array_filter(
                ['name' => $listener, '--event' => $event]
            ));
        }
    }
}
