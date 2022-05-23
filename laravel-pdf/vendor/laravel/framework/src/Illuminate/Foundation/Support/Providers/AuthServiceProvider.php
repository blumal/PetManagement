<?php

namespace Illuminate\Foundation\Support\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
<<<<<<< HEAD
     * @var array<class-string, class-string>
=======
     * @var array
>>>>>>> origin/New-FakeMain
     */
    protected $policies = [];

    /**
     * Register the application's policies.
     *
     * @return void
     */
    public function registerPolicies()
    {
<<<<<<< HEAD
        foreach ($this->policies() as $model => $policy) {
            Gate::policy($model, $policy);
=======
        foreach ($this->policies() as $key => $value) {
            Gate::policy($key, $value);
>>>>>>> origin/New-FakeMain
        }
    }

    /**
     * Get the policies defined on the provider.
     *
<<<<<<< HEAD
     * @return array<class-string, class-string>
=======
     * @return array
>>>>>>> origin/New-FakeMain
     */
    public function policies()
    {
        return $this->policies;
    }
}
