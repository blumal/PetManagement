<?php

namespace Illuminate\Contracts\Auth;

interface PasswordBrokerFactory
{
    /**
     * Get a password broker instance by name.
     *
     * @param  string|null  $name
<<<<<<< HEAD
     * @return \Illuminate\Contracts\Auth\PasswordBroker
=======
     * @return mixed
>>>>>>> origin/New-FakeMain
     */
    public function broker($name = null);
}
