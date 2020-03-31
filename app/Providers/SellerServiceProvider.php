<?php

namespace App\Providers;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use JeroenNoten\LaravelAdminLte\Console\AdminLteInstallCommand;
use JeroenNoten\LaravelAdminLte\Console\AdminLtePluginCommand;
use JeroenNoten\LaravelAdminLte\Console\AdminLteStatusCommand;
use JeroenNoten\LaravelAdminLte\Console\AdminLteUpdateCommand;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use App\Http\ViewComposers\SellerComposer;

class SellerServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->app->singleton(AdminLte::class, function (Container $app) {
            return new AdminLte(
                $app['config']['seller.filters'],
                $app['events'],
                $app
            );
        });
    }

    public function boot(
        Factory $view,
        Dispatcher $events,
        Repository $config
    ) {
        $this->loadViews();

        $this->loadTranslations();

        $this->loadConfig();

        $this->registerCommands();

        $this->registerViewComposers($view);

        static::registerMenu($events, $config);
    }

    private function loadViews()
    {

        $viewsPath = $this->packagePath('resources/views');
        $this->loadViewsFrom($viewsPath, 'seller');
    }

    private function loadTranslations()
    {
        $translationsPath = $this->packagePath('resources/lang');
        $this->loadTranslationsFrom($translationsPath, 'seller');
    }

    private function loadConfig()
    {
        $configPath = $this->packagePath('config/seller.php');
        $this->mergeConfigFrom($configPath, 'seller');
    }

    private function packagePath($path)
    {
        return __DIR__."../../../$path";
    }

    private function registerCommands()
    {
        $this->commands(AdminLteInstallCommand::class);
        $this->commands(AdminLteStatusCommand::class);
        $this->commands(AdminLteUpdateCommand::class);
        $this->commands(AdminLtePluginCommand::class);
    }

    private function registerViewComposers(Factory $view)
    {
            $view->composer('seller::page', SellerComposer::class);
    }

    public static function registerMenu(Dispatcher $events, Repository $config)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) use ($config) {
            $menu = $config->get('seller.menu');
            call_user_func_array([$event->menu, 'add'], $menu);
        });
    }
}
