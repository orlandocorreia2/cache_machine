<?php

namespace App\Providers;

use App\Domain\CacheMachine;
use App\Domain\CacheMachineInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bindInterfaces();
    }

    /**
     *
     */
    private function bindInterfaces()
    {
        app()->bind(CacheMachineInterface::class, CacheMachine::class);
    }
}

