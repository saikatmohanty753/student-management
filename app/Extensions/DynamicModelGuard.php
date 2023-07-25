<?php
// app/Extensions/DynamicModelGuard.php

namespace App\Extensions;

use Illuminate\Auth\SessionGuard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Auth;

class DynamicModelGuard extends SessionGuard
{
    /**
     * Set the user provider for the guard.
     *
     * @param  \Illuminate\Contracts\Auth\UserProvider  $provider
     * @return $this
     */
    public function setProvider(UserProvider $provider)
    {
        $this->userProvider = $provider;

        return $this;
    }

    /**
     * Get the user provider used by the guard.
     *
     * @return \Illuminate\Contracts\Auth\UserProvider
     */
    public function getProvider()
    {
        return $this->userProvider;
    }
}
