<?php

namespace Friparia\Admin;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Foundation\AliasLoader;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $router->middlewareGroup('admin', [
            \Friparia\Admin\Middleware::class,
        ]);
        $this->loadViewsFrom(__DIR__.'/../views', 'admin');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $config = $this->app['config']['auth'];
        $config["providers"]['users']['model'] = "\\Friparia\\Admin\\Models\\User";
        $this->app['config']->set('auth', $config);
        $this->commands([
            MigrateCommand::class,
            CreateAdminUserCommand::class,
            SetupCommand::class,
        ]);
    }
}
