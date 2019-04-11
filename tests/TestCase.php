<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function createUser($attributes = []) : User
    {
        return factory(User::class)
            ->create($attributes);
    }
}
