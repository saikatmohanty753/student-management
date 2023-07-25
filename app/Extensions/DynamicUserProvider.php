<?php
// app\Extensions\DynamicUserProvider.php

namespace App\Extensions;

use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Contracts\Auth\UserProvider;
use App\Models\User;
use Auth;

class DynamicUserProvider implements UserProvider
{
    protected $hasher;
    protected $model;

    public function __construct($hasher, $model)
    {
        $this->hasher = $hasher;
        $this->model = $model;

    }

    public function retrieveById($identifier)
    {
        return $this->createModel()->newQuery()->find($identifier);
    }

    public function retrieveByToken($identifier, $token)
    {
        // Not needed for a stateful authentication system.
    }

    public function updateRememberToken(UserContract $user, $token)
    {
        // Not needed for a stateful authentication system.
    }

    public function retrieveByCredentials(array $credentials)
    {


        // Your custom logic here to determine the appropriate model
        // based on the given credentials, for example, using a field like 'user_type'.
        $userType = $credentials['type'] ?? null;

        if ($userType == '1') {
            $creden = array();
            $creden['email'] = $credentials['email'];
            //$creden['password'] = $credentials['password'];
            $creden['is_active'] = $credentials['is_active'];
            $this->model = $model = 'Student'.$credentials['clg_id'].'User';

            return app('App\\Models\\'.$model)->newQuery()->where($creden)->first();
        } else {
            $creden = array();
            $creden['email'] = $credentials['email'];
            //$creden['password'] = $credentials['password'];
            $creden['is_active'] = $credentials['is_active'];
            return app(User::class)->newQuery()->where($creden)->first();
        }
    }

    public function validateCredentials(UserContract $user, array $credentials)
    {
        $plain = $credentials['password'];
        return $this->hasher->check($plain, $user->getAuthPassword());
    }

    protected function createModel()
    {

        if(!empty(session()->get('user')))
        {
            if(session()->get('user')->role_id == 3)
            {
                $this->model = "App\\Models\\Student".session()->get('user')->clg_id."User";
            }
        }
        return app($this->model);
    }
}
