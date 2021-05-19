<?php

namespace App\Providers;

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
        $this->registerServices();
        $this->registerRepositories();
    }

    private function registerServices()
    {
        $services = [
            'User',
            'DeviceToken',
            'UserForgotPassword',
            'Config',

        ];
        foreach ($services as $service) {
            $fcd = 'App\\Facades\\' . $service . "Facade";
            $sv  = 'App\\Services\\' . $service . "Service";
            $this->app->singleton($fcd, function () use ($sv) {
                return new $sv();
            });
        }
    }

    private function registerRepositories()
    {
        $repos = [
            'User',
            'DeviceToken',
            'UserForgotPassword',
            'Config',

        ];

        foreach ($repos as $name) {
            $r = 'App\\Repositories\\Facades\\' . $name . 'Repository';
            $c = 'App\\Repositories\\Cache\\' . $name . 'RepositoryCache';
            $e = 'App\\Repositories\\Eloquents\\' . $name . 'RepositoryEloquent';
            $this->app->singleton($r, function () use ($c, $e) {
                return new $c(
                    new $e
                );
            });
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
