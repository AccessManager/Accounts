<?php

namespace AccessManager\Accounts\Providers;


use Illuminate\Support\ServiceProvider;

class AccountsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom( __DIR__ . "/../Views", "Accounts");
        $this->loadRoutesFrom(__DIR__ . "/../Routes/web.php");
        $this->loadMigrationsFrom(__DIR__ . "/../Database/Migrations");
    }
}