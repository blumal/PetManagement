<?php

namespace Illuminate\Foundation\Providers;

use Illuminate\Auth\Console\ClearResetsCommand;
use Illuminate\Cache\Console\CacheTableCommand;
use Illuminate\Cache\Console\ClearCommand as CacheClearCommand;
use Illuminate\Cache\Console\ForgetCommand as CacheForgetCommand;
use Illuminate\Console\Scheduling\ScheduleClearCacheCommand;
use Illuminate\Console\Scheduling\ScheduleFinishCommand;
use Illuminate\Console\Scheduling\ScheduleListCommand;
use Illuminate\Console\Scheduling\ScheduleRunCommand;
use Illuminate\Console\Scheduling\ScheduleTestCommand;
use Illuminate\Console\Scheduling\ScheduleWorkCommand;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Database\Console\DbCommand;
use Illuminate\Database\Console\DumpCommand;
use Illuminate\Database\Console\Factories\FactoryMakeCommand;
use Illuminate\Database\Console\PruneCommand;
use Illuminate\Database\Console\Seeds\SeedCommand;
use Illuminate\Database\Console\Seeds\SeederMakeCommand;
use Illuminate\Database\Console\WipeCommand;
use Illuminate\Foundation\Console\CastMakeCommand;
use Illuminate\Foundation\Console\ChannelMakeCommand;
use Illuminate\Foundation\Console\ClearCompiledCommand;
use Illuminate\Foundation\Console\ComponentMakeCommand;
use Illuminate\Foundation\Console\ConfigCacheCommand;
use Illuminate\Foundation\Console\ConfigClearCommand;
use Illuminate\Foundation\Console\ConsoleMakeCommand;
use Illuminate\Foundation\Console\DownCommand;
use Illuminate\Foundation\Console\EnvironmentCommand;
use Illuminate\Foundation\Console\EventCacheCommand;
use Illuminate\Foundation\Console\EventClearCommand;
use Illuminate\Foundation\Console\EventGenerateCommand;
use Illuminate\Foundation\Console\EventListCommand;
use Illuminate\Foundation\Console\EventMakeCommand;
use Illuminate\Foundation\Console\ExceptionMakeCommand;
use Illuminate\Foundation\Console\JobMakeCommand;
use Illuminate\Foundation\Console\KeyGenerateCommand;
use Illuminate\Foundation\Console\ListenerMakeCommand;
use Illuminate\Foundation\Console\MailMakeCommand;
use Illuminate\Foundation\Console\ModelMakeCommand;
use Illuminate\Foundation\Console\NotificationMakeCommand;
use Illuminate\Foundation\Console\ObserverMakeCommand;
use Illuminate\Foundation\Console\OptimizeClearCommand;
use Illuminate\Foundation\Console\OptimizeCommand;
use Illuminate\Foundation\Console\PackageDiscoverCommand;
use Illuminate\Foundation\Console\PolicyMakeCommand;
use Illuminate\Foundation\Console\ProviderMakeCommand;
use Illuminate\Foundation\Console\RequestMakeCommand;
use Illuminate\Foundation\Console\ResourceMakeCommand;
use Illuminate\Foundation\Console\RouteCacheCommand;
use Illuminate\Foundation\Console\RouteClearCommand;
use Illuminate\Foundation\Console\RouteListCommand;
use Illuminate\Foundation\Console\RuleMakeCommand;
<<<<<<< HEAD
use Illuminate\Foundation\Console\ScopeMakeCommand;
=======
>>>>>>> origin/New-FakeMain
use Illuminate\Foundation\Console\ServeCommand;
use Illuminate\Foundation\Console\StorageLinkCommand;
use Illuminate\Foundation\Console\StubPublishCommand;
use Illuminate\Foundation\Console\TestMakeCommand;
use Illuminate\Foundation\Console\UpCommand;
use Illuminate\Foundation\Console\VendorPublishCommand;
use Illuminate\Foundation\Console\ViewCacheCommand;
use Illuminate\Foundation\Console\ViewClearCommand;
use Illuminate\Notifications\Console\NotificationTableCommand;
use Illuminate\Queue\Console\BatchesTableCommand;
use Illuminate\Queue\Console\ClearCommand as QueueClearCommand;
use Illuminate\Queue\Console\FailedTableCommand;
use Illuminate\Queue\Console\FlushFailedCommand as FlushFailedQueueCommand;
use Illuminate\Queue\Console\ForgetFailedCommand as ForgetFailedQueueCommand;
use Illuminate\Queue\Console\ListenCommand as QueueListenCommand;
use Illuminate\Queue\Console\ListFailedCommand as ListFailedQueueCommand;
use Illuminate\Queue\Console\MonitorCommand as QueueMonitorCommand;
<<<<<<< HEAD
use Illuminate\Queue\Console\PruneBatchesCommand as QueuePruneBatchesCommand;
use Illuminate\Queue\Console\PruneFailedJobsCommand as QueuePruneFailedJobsCommand;
=======
use Illuminate\Queue\Console\PruneBatchesCommand as PruneBatchesQueueCommand;
use Illuminate\Queue\Console\PruneFailedJobsCommand;
>>>>>>> origin/New-FakeMain
use Illuminate\Queue\Console\RestartCommand as QueueRestartCommand;
use Illuminate\Queue\Console\RetryBatchCommand as QueueRetryBatchCommand;
use Illuminate\Queue\Console\RetryCommand as QueueRetryCommand;
use Illuminate\Queue\Console\TableCommand;
use Illuminate\Queue\Console\WorkCommand as QueueWorkCommand;
use Illuminate\Routing\Console\ControllerMakeCommand;
use Illuminate\Routing\Console\MiddlewareMakeCommand;
use Illuminate\Session\Console\SessionTableCommand;
use Illuminate\Support\ServiceProvider;

class ArtisanServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
<<<<<<< HEAD
        'CacheClear' => CacheClearCommand::class,
        'CacheForget' => CacheForgetCommand::class,
        'ClearCompiled' => ClearCompiledCommand::class,
        'ClearResets' => ClearResetsCommand::class,
        'ConfigCache' => ConfigCacheCommand::class,
        'ConfigClear' => ConfigClearCommand::class,
        'Db' => DbCommand::class,
        'DbPrune' => PruneCommand::class,
        'DbWipe' => WipeCommand::class,
        'Down' => DownCommand::class,
        'Environment' => EnvironmentCommand::class,
        'EventCache' => EventCacheCommand::class,
        'EventClear' => EventClearCommand::class,
        'EventList' => EventListCommand::class,
        'KeyGenerate' => KeyGenerateCommand::class,
        'Optimize' => OptimizeCommand::class,
        'OptimizeClear' => OptimizeClearCommand::class,
        'PackageDiscover' => PackageDiscoverCommand::class,
        'QueueClear' => QueueClearCommand::class,
        'QueueFailed' => ListFailedQueueCommand::class,
        'QueueFlush' => FlushFailedQueueCommand::class,
        'QueueForget' => ForgetFailedQueueCommand::class,
        'QueueListen' => QueueListenCommand::class,
        'QueueMonitor' => QueueMonitorCommand::class,
        'QueuePruneBatches' => QueuePruneBatchesCommand::class,
        'QueuePruneFailedJobs' => QueuePruneFailedJobsCommand::class,
        'QueueRestart' => QueueRestartCommand::class,
        'QueueRetry' => QueueRetryCommand::class,
        'QueueRetryBatch' => QueueRetryBatchCommand::class,
        'QueueWork' => QueueWorkCommand::class,
        'RouteCache' => RouteCacheCommand::class,
        'RouteClear' => RouteClearCommand::class,
        'RouteList' => RouteListCommand::class,
        'SchemaDump' => DumpCommand::class,
        'Seed' => SeedCommand::class,
=======
        'CacheClear' => 'command.cache.clear',
        'CacheForget' => 'command.cache.forget',
        'ClearCompiled' => 'command.clear-compiled',
        'ClearResets' => 'command.auth.resets.clear',
        'ConfigCache' => 'command.config.cache',
        'ConfigClear' => 'command.config.clear',
        'Db' => DbCommand::class,
        'DbPrune' => 'command.db.prune',
        'DbWipe' => 'command.db.wipe',
        'Down' => 'command.down',
        'Environment' => 'command.environment',
        'EventCache' => 'command.event.cache',
        'EventClear' => 'command.event.clear',
        'EventList' => 'command.event.list',
        'KeyGenerate' => 'command.key.generate',
        'Optimize' => 'command.optimize',
        'OptimizeClear' => 'command.optimize.clear',
        'PackageDiscover' => 'command.package.discover',
        'QueueClear' => 'command.queue.clear',
        'QueueFailed' => 'command.queue.failed',
        'QueueFlush' => 'command.queue.flush',
        'QueueForget' => 'command.queue.forget',
        'QueueListen' => 'command.queue.listen',
        'QueueMonitor' => 'command.queue.monitor',
        'QueuePruneBatches' => 'command.queue.prune-batches',
        'QueuePruneFailedJobs' => 'command.queue.prune-failed-jobs',
        'QueueRestart' => 'command.queue.restart',
        'QueueRetry' => 'command.queue.retry',
        'QueueRetryBatch' => 'command.queue.retry-batch',
        'QueueWork' => 'command.queue.work',
        'RouteCache' => 'command.route.cache',
        'RouteClear' => 'command.route.clear',
        'RouteList' => 'command.route.list',
        'SchemaDump' => 'command.schema.dump',
        'Seed' => 'command.seed',
>>>>>>> origin/New-FakeMain
        'ScheduleFinish' => ScheduleFinishCommand::class,
        'ScheduleList' => ScheduleListCommand::class,
        'ScheduleRun' => ScheduleRunCommand::class,
        'ScheduleClearCache' => ScheduleClearCacheCommand::class,
        'ScheduleTest' => ScheduleTestCommand::class,
        'ScheduleWork' => ScheduleWorkCommand::class,
<<<<<<< HEAD
        'StorageLink' => StorageLinkCommand::class,
        'Up' => UpCommand::class,
        'ViewCache' => ViewCacheCommand::class,
        'ViewClear' => ViewClearCommand::class,
=======
        'StorageLink' => 'command.storage.link',
        'Up' => 'command.up',
        'ViewCache' => 'command.view.cache',
        'ViewClear' => 'command.view.clear',
>>>>>>> origin/New-FakeMain
    ];

    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $devCommands = [
<<<<<<< HEAD
        'CacheTable' => CacheTableCommand::class,
        'CastMake' => CastMakeCommand::class,
        'ChannelMake' => ChannelMakeCommand::class,
        'ComponentMake' => ComponentMakeCommand::class,
        'ConsoleMake' => ConsoleMakeCommand::class,
        'ControllerMake' => ControllerMakeCommand::class,
        'EventGenerate' => EventGenerateCommand::class,
        'EventMake' => EventMakeCommand::class,
        'ExceptionMake' => ExceptionMakeCommand::class,
        'FactoryMake' => FactoryMakeCommand::class,
        'JobMake' => JobMakeCommand::class,
        'ListenerMake' => ListenerMakeCommand::class,
        'MailMake' => MailMakeCommand::class,
        'MiddlewareMake' => MiddlewareMakeCommand::class,
        'ModelMake' => ModelMakeCommand::class,
        'NotificationMake' => NotificationMakeCommand::class,
        'NotificationTable' => NotificationTableCommand::class,
        'ObserverMake' => ObserverMakeCommand::class,
        'PolicyMake' => PolicyMakeCommand::class,
        'ProviderMake' => ProviderMakeCommand::class,
        'QueueFailedTable' => FailedTableCommand::class,
        'QueueTable' => TableCommand::class,
        'QueueBatchesTable' => BatchesTableCommand::class,
        'RequestMake' => RequestMakeCommand::class,
        'ResourceMake' => ResourceMakeCommand::class,
        'RuleMake' => RuleMakeCommand::class,
        'ScopeMake' => ScopeMakeCommand::class,
        'SeederMake' => SeederMakeCommand::class,
        'SessionTable' => SessionTableCommand::class,
        'Serve' => ServeCommand::class,
        'StubPublish' => StubPublishCommand::class,
        'TestMake' => TestMakeCommand::class,
        'VendorPublish' => VendorPublishCommand::class,
=======
        'CacheTable' => 'command.cache.table',
        'CastMake' => 'command.cast.make',
        'ChannelMake' => 'command.channel.make',
        'ComponentMake' => 'command.component.make',
        'ConsoleMake' => 'command.console.make',
        'ControllerMake' => 'command.controller.make',
        'EventGenerate' => 'command.event.generate',
        'EventMake' => 'command.event.make',
        'ExceptionMake' => 'command.exception.make',
        'FactoryMake' => 'command.factory.make',
        'JobMake' => 'command.job.make',
        'ListenerMake' => 'command.listener.make',
        'MailMake' => 'command.mail.make',
        'MiddlewareMake' => 'command.middleware.make',
        'ModelMake' => 'command.model.make',
        'NotificationMake' => 'command.notification.make',
        'NotificationTable' => 'command.notification.table',
        'ObserverMake' => 'command.observer.make',
        'PolicyMake' => 'command.policy.make',
        'ProviderMake' => 'command.provider.make',
        'QueueFailedTable' => 'command.queue.failed-table',
        'QueueTable' => 'command.queue.table',
        'QueueBatchesTable' => 'command.queue.batches-table',
        'RequestMake' => 'command.request.make',
        'ResourceMake' => 'command.resource.make',
        'RuleMake' => 'command.rule.make',
        'SeederMake' => 'command.seeder.make',
        'SessionTable' => 'command.session.table',
        'Serve' => 'command.serve',
        'StubPublish' => 'command.stub.publish',
        'TestMake' => 'command.test.make',
        'VendorPublish' => 'command.vendor.publish',
>>>>>>> origin/New-FakeMain
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands(array_merge(
            $this->commands, $this->devCommands
        ));
    }

    /**
     * Register the given commands.
     *
     * @param  array  $commands
     * @return void
     */
    protected function registerCommands(array $commands)
    {
        foreach (array_keys($commands) as $command) {
            $this->{"register{$command}Command"}();
        }

        $this->commands(array_values($commands));
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerCacheClearCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(CacheClearCommand::class, function ($app) {
=======
        $this->app->singleton('command.cache.clear', function ($app) {
>>>>>>> origin/New-FakeMain
            return new CacheClearCommand($app['cache'], $app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerCacheForgetCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(CacheForgetCommand::class, function ($app) {
=======
        $this->app->singleton('command.cache.forget', function ($app) {
>>>>>>> origin/New-FakeMain
            return new CacheForgetCommand($app['cache']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerCacheTableCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(CacheTableCommand::class, function ($app) {
=======
        $this->app->singleton('command.cache.table', function ($app) {
>>>>>>> origin/New-FakeMain
            return new CacheTableCommand($app['files'], $app['composer']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerCastMakeCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(CastMakeCommand::class, function ($app) {
=======
        $this->app->singleton('command.cast.make', function ($app) {
>>>>>>> origin/New-FakeMain
            return new CastMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerChannelMakeCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(ChannelMakeCommand::class, function ($app) {
=======
        $this->app->singleton('command.channel.make', function ($app) {
>>>>>>> origin/New-FakeMain
            return new ChannelMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerClearCompiledCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(ClearCompiledCommand::class);
=======
        $this->app->singleton('command.clear-compiled', function () {
            return new ClearCompiledCommand;
        });
>>>>>>> origin/New-FakeMain
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerClearResetsCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(ClearResetsCommand::class);
=======
        $this->app->singleton('command.auth.resets.clear', function () {
            return new ClearResetsCommand;
        });
>>>>>>> origin/New-FakeMain
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerComponentMakeCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(ComponentMakeCommand::class, function ($app) {
=======
        $this->app->singleton('command.component.make', function ($app) {
>>>>>>> origin/New-FakeMain
            return new ComponentMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerConfigCacheCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(ConfigCacheCommand::class, function ($app) {
=======
        $this->app->singleton('command.config.cache', function ($app) {
>>>>>>> origin/New-FakeMain
            return new ConfigCacheCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerConfigClearCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(ConfigClearCommand::class, function ($app) {
=======
        $this->app->singleton('command.config.clear', function ($app) {
>>>>>>> origin/New-FakeMain
            return new ConfigClearCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerConsoleMakeCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(ConsoleMakeCommand::class, function ($app) {
=======
        $this->app->singleton('command.console.make', function ($app) {
>>>>>>> origin/New-FakeMain
            return new ConsoleMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerControllerMakeCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(ControllerMakeCommand::class, function ($app) {
=======
        $this->app->singleton('command.controller.make', function ($app) {
>>>>>>> origin/New-FakeMain
            return new ControllerMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerDbCommand()
    {
        $this->app->singleton(DbCommand::class);
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerDbPruneCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(PruneCommand::class);
=======
        $this->app->singleton('command.db.prune', function ($app) {
            return new PruneCommand($app['events']);
        });
>>>>>>> origin/New-FakeMain
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerDbWipeCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(WipeCommand::class);
=======
        $this->app->singleton('command.db.wipe', function () {
            return new WipeCommand;
        });
>>>>>>> origin/New-FakeMain
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerEventGenerateCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(EventGenerateCommand::class);
=======
        $this->app->singleton('command.event.generate', function () {
            return new EventGenerateCommand;
        });
>>>>>>> origin/New-FakeMain
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerEventMakeCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(EventMakeCommand::class, function ($app) {
=======
        $this->app->singleton('command.event.make', function ($app) {
>>>>>>> origin/New-FakeMain
            return new EventMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerExceptionMakeCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(ExceptionMakeCommand::class, function ($app) {
=======
        $this->app->singleton('command.exception.make', function ($app) {
>>>>>>> origin/New-FakeMain
            return new ExceptionMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerFactoryMakeCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(FactoryMakeCommand::class, function ($app) {
=======
        $this->app->singleton('command.factory.make', function ($app) {
>>>>>>> origin/New-FakeMain
            return new FactoryMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerDownCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(DownCommand::class);
=======
        $this->app->singleton('command.down', function () {
            return new DownCommand;
        });
>>>>>>> origin/New-FakeMain
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerEnvironmentCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(EnvironmentCommand::class);
=======
        $this->app->singleton('command.environment', function () {
            return new EnvironmentCommand;
        });
>>>>>>> origin/New-FakeMain
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerEventCacheCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(EventCacheCommand::class);
=======
        $this->app->singleton('command.event.cache', function () {
            return new EventCacheCommand;
        });
>>>>>>> origin/New-FakeMain
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerEventClearCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(EventClearCommand::class, function ($app) {
=======
        $this->app->singleton('command.event.clear', function ($app) {
>>>>>>> origin/New-FakeMain
            return new EventClearCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerEventListCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(EventListCommand::class);
=======
        $this->app->singleton('command.event.list', function () {
            return new EventListCommand;
        });
>>>>>>> origin/New-FakeMain
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerJobMakeCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(JobMakeCommand::class, function ($app) {
=======
        $this->app->singleton('command.job.make', function ($app) {
>>>>>>> origin/New-FakeMain
            return new JobMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerKeyGenerateCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(KeyGenerateCommand::class);
=======
        $this->app->singleton('command.key.generate', function () {
            return new KeyGenerateCommand;
        });
>>>>>>> origin/New-FakeMain
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerListenerMakeCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(ListenerMakeCommand::class, function ($app) {
=======
        $this->app->singleton('command.listener.make', function ($app) {
>>>>>>> origin/New-FakeMain
            return new ListenerMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerMailMakeCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(MailMakeCommand::class, function ($app) {
=======
        $this->app->singleton('command.mail.make', function ($app) {
>>>>>>> origin/New-FakeMain
            return new MailMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerMiddlewareMakeCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(MiddlewareMakeCommand::class, function ($app) {
=======
        $this->app->singleton('command.middleware.make', function ($app) {
>>>>>>> origin/New-FakeMain
            return new MiddlewareMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerModelMakeCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(ModelMakeCommand::class, function ($app) {
=======
        $this->app->singleton('command.model.make', function ($app) {
>>>>>>> origin/New-FakeMain
            return new ModelMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerNotificationMakeCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(NotificationMakeCommand::class, function ($app) {
=======
        $this->app->singleton('command.notification.make', function ($app) {
>>>>>>> origin/New-FakeMain
            return new NotificationMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerNotificationTableCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(NotificationTableCommand::class, function ($app) {
=======
        $this->app->singleton('command.notification.table', function ($app) {
>>>>>>> origin/New-FakeMain
            return new NotificationTableCommand($app['files'], $app['composer']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerOptimizeCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(OptimizeCommand::class);
=======
        $this->app->singleton('command.optimize', function () {
            return new OptimizeCommand;
        });
>>>>>>> origin/New-FakeMain
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerObserverMakeCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(ObserverMakeCommand::class, function ($app) {
=======
        $this->app->singleton('command.observer.make', function ($app) {
>>>>>>> origin/New-FakeMain
            return new ObserverMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerOptimizeClearCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(OptimizeClearCommand::class);
=======
        $this->app->singleton('command.optimize.clear', function () {
            return new OptimizeClearCommand;
        });
>>>>>>> origin/New-FakeMain
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerPackageDiscoverCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(PackageDiscoverCommand::class);
=======
        $this->app->singleton('command.package.discover', function () {
            return new PackageDiscoverCommand;
        });
>>>>>>> origin/New-FakeMain
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerPolicyMakeCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(PolicyMakeCommand::class, function ($app) {
=======
        $this->app->singleton('command.policy.make', function ($app) {
>>>>>>> origin/New-FakeMain
            return new PolicyMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerProviderMakeCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(ProviderMakeCommand::class, function ($app) {
=======
        $this->app->singleton('command.provider.make', function ($app) {
>>>>>>> origin/New-FakeMain
            return new ProviderMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerQueueFailedCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(ListFailedQueueCommand::class);
=======
        $this->app->singleton('command.queue.failed', function () {
            return new ListFailedQueueCommand;
        });
>>>>>>> origin/New-FakeMain
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerQueueForgetCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(ForgetFailedQueueCommand::class);
=======
        $this->app->singleton('command.queue.forget', function () {
            return new ForgetFailedQueueCommand;
        });
>>>>>>> origin/New-FakeMain
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerQueueFlushCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(FlushFailedQueueCommand::class);
=======
        $this->app->singleton('command.queue.flush', function () {
            return new FlushFailedQueueCommand;
        });
>>>>>>> origin/New-FakeMain
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerQueueListenCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(QueueListenCommand::class, function ($app) {
=======
        $this->app->singleton('command.queue.listen', function ($app) {
>>>>>>> origin/New-FakeMain
            return new QueueListenCommand($app['queue.listener']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerQueueMonitorCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(QueueMonitorCommand::class, function ($app) {
=======
        $this->app->singleton('command.queue.monitor', function ($app) {
>>>>>>> origin/New-FakeMain
            return new QueueMonitorCommand($app['queue'], $app['events']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerQueuePruneBatchesCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(QueuePruneBatchesCommand::class, function () {
            return new QueuePruneBatchesCommand;
=======
        $this->app->singleton('command.queue.prune-batches', function () {
            return new PruneBatchesQueueCommand;
>>>>>>> origin/New-FakeMain
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerQueuePruneFailedJobsCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(QueuePruneFailedJobsCommand::class, function () {
            return new QueuePruneFailedJobsCommand;
=======
        $this->app->singleton('command.queue.prune-failed-jobs', function () {
            return new PruneFailedJobsCommand;
>>>>>>> origin/New-FakeMain
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerQueueRestartCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(QueueRestartCommand::class, function ($app) {
=======
        $this->app->singleton('command.queue.restart', function ($app) {
>>>>>>> origin/New-FakeMain
            return new QueueRestartCommand($app['cache.store']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerQueueRetryCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(QueueRetryCommand::class);
=======
        $this->app->singleton('command.queue.retry', function () {
            return new QueueRetryCommand;
        });
>>>>>>> origin/New-FakeMain
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerQueueRetryBatchCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(QueueRetryBatchCommand::class);
=======
        $this->app->singleton('command.queue.retry-batch', function () {
            return new QueueRetryBatchCommand;
        });
>>>>>>> origin/New-FakeMain
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerQueueWorkCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(QueueWorkCommand::class, function ($app) {
=======
        $this->app->singleton('command.queue.work', function ($app) {
>>>>>>> origin/New-FakeMain
            return new QueueWorkCommand($app['queue.worker'], $app['cache.store']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerQueueClearCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(QueueClearCommand::class);
=======
        $this->app->singleton('command.queue.clear', function () {
            return new QueueClearCommand;
        });
>>>>>>> origin/New-FakeMain
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerQueueFailedTableCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(FailedTableCommand::class, function ($app) {
=======
        $this->app->singleton('command.queue.failed-table', function ($app) {
>>>>>>> origin/New-FakeMain
            return new FailedTableCommand($app['files'], $app['composer']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerQueueTableCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(TableCommand::class, function ($app) {
=======
        $this->app->singleton('command.queue.table', function ($app) {
>>>>>>> origin/New-FakeMain
            return new TableCommand($app['files'], $app['composer']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerQueueBatchesTableCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(BatchesTableCommand::class, function ($app) {
=======
        $this->app->singleton('command.queue.batches-table', function ($app) {
>>>>>>> origin/New-FakeMain
            return new BatchesTableCommand($app['files'], $app['composer']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerRequestMakeCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(RequestMakeCommand::class, function ($app) {
=======
        $this->app->singleton('command.request.make', function ($app) {
>>>>>>> origin/New-FakeMain
            return new RequestMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerResourceMakeCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(ResourceMakeCommand::class, function ($app) {
=======
        $this->app->singleton('command.resource.make', function ($app) {
>>>>>>> origin/New-FakeMain
            return new ResourceMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerRuleMakeCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(RuleMakeCommand::class, function ($app) {
=======
        $this->app->singleton('command.rule.make', function ($app) {
>>>>>>> origin/New-FakeMain
            return new RuleMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
<<<<<<< HEAD
    protected function registerScopeMakeCommand()
    {
        $this->app->singleton(ScopeMakeCommand::class, function ($app) {
            return new ScopeMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerSeederMakeCommand()
    {
        $this->app->singleton(SeederMakeCommand::class, function ($app) {
=======
    protected function registerSeederMakeCommand()
    {
        $this->app->singleton('command.seeder.make', function ($app) {
>>>>>>> origin/New-FakeMain
            return new SeederMakeCommand($app['files'], $app['composer']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerSessionTableCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(SessionTableCommand::class, function ($app) {
=======
        $this->app->singleton('command.session.table', function ($app) {
>>>>>>> origin/New-FakeMain
            return new SessionTableCommand($app['files'], $app['composer']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerStorageLinkCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(StorageLinkCommand::class);
=======
        $this->app->singleton('command.storage.link', function () {
            return new StorageLinkCommand;
        });
>>>>>>> origin/New-FakeMain
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerRouteCacheCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(RouteCacheCommand::class, function ($app) {
=======
        $this->app->singleton('command.route.cache', function ($app) {
>>>>>>> origin/New-FakeMain
            return new RouteCacheCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerRouteClearCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(RouteClearCommand::class, function ($app) {
=======
        $this->app->singleton('command.route.clear', function ($app) {
>>>>>>> origin/New-FakeMain
            return new RouteClearCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerRouteListCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(RouteListCommand::class, function ($app) {
=======
        $this->app->singleton('command.route.list', function ($app) {
>>>>>>> origin/New-FakeMain
            return new RouteListCommand($app['router']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerSchemaDumpCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(DumpCommand::class);
=======
        $this->app->singleton('command.schema.dump', function () {
            return new DumpCommand;
        });
>>>>>>> origin/New-FakeMain
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerSeedCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(SeedCommand::class, function ($app) {
=======
        $this->app->singleton('command.seed', function ($app) {
>>>>>>> origin/New-FakeMain
            return new SeedCommand($app['db']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerScheduleClearCacheCommand()
    {
        $this->app->singleton(ScheduleClearCacheCommand::class);
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerScheduleFinishCommand()
    {
        $this->app->singleton(ScheduleFinishCommand::class);
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerScheduleListCommand()
    {
        $this->app->singleton(ScheduleListCommand::class);
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerScheduleRunCommand()
    {
        $this->app->singleton(ScheduleRunCommand::class);
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerScheduleTestCommand()
    {
        $this->app->singleton(ScheduleTestCommand::class);
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerScheduleWorkCommand()
    {
        $this->app->singleton(ScheduleWorkCommand::class);
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerServeCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(ServeCommand::class);
=======
        $this->app->singleton('command.serve', function () {
            return new ServeCommand;
        });
>>>>>>> origin/New-FakeMain
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerStubPublishCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(StubPublishCommand::class);
=======
        $this->app->singleton('command.stub.publish', function () {
            return new StubPublishCommand;
        });
>>>>>>> origin/New-FakeMain
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerTestMakeCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(TestMakeCommand::class, function ($app) {
=======
        $this->app->singleton('command.test.make', function ($app) {
>>>>>>> origin/New-FakeMain
            return new TestMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerUpCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(UpCommand::class);
=======
        $this->app->singleton('command.up', function () {
            return new UpCommand;
        });
>>>>>>> origin/New-FakeMain
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerVendorPublishCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(VendorPublishCommand::class, function ($app) {
=======
        $this->app->singleton('command.vendor.publish', function ($app) {
>>>>>>> origin/New-FakeMain
            return new VendorPublishCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerViewCacheCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(ViewCacheCommand::class);
=======
        $this->app->singleton('command.view.cache', function () {
            return new ViewCacheCommand;
        });
>>>>>>> origin/New-FakeMain
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerViewClearCommand()
    {
<<<<<<< HEAD
        $this->app->singleton(ViewClearCommand::class, function ($app) {
=======
        $this->app->singleton('command.view.clear', function ($app) {
>>>>>>> origin/New-FakeMain
            return new ViewClearCommand($app['files']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array_merge(array_values($this->commands), array_values($this->devCommands));
    }
}
