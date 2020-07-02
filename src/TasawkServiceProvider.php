<?php

namespace Tasawk\TasawkComponent;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class TasawkServiceProvider extends ServiceProvider {

    protected $Namespace = 'App\Components';
    protected $API_version = 'api/v1/';
    protected $Middlewares = [
        'web',
        'localize' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
        'localizationRedirect' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
        'localeSessionRedirect' => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
        'localeViewPath' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class
    ];

    protected $commands = [
        'Tasawk\TasawkComponent\Console\Commands\FComponent',
        'Tasawk\TasawkComponent\Console\Commands\MComponent',
        'Tasawk\TasawkComponent\Console\Commands\VComponent',
    ];

    public function register() {
        $this->commands($this->commands);
    }

    public function boot() {
        $this->_loadJsonTranslations();
        $this->loadHelpers();
        $this->webArtisanMigration();
        $this->loadApiRoute();
        $this->parseViewConfig();
        $this->loadWebRoutesDashboard();
        $this->loadWebRoutesFrontEnd();

        include __DIR__ . '/Common/Route/Dashboard.php';
        $this->mergeConfig();
        $this->webArtisan();
        if (request()->is('dashboard*')) {
            view()->addNamespace('DCommon', _fixDirSeparator(__DIR__ . '/Common/View/Dashboard'));
        } else {
            view()->addNamespace('FCommon', _fixDirSeparator(__DIR__ . '/Common/View/Front'));
        }
        // php artisan vendor:publish --tag=public_assets --force
        $this->publishes([
            __DIR__.'/assets' => public_path('/assets'),
        ], 'public_assets');
        $this->publishes([
            __DIR__.'/views/admin' => resource_path('views'),
            __DIR__.'/views/email' => resource_path('views'),
            __DIR__.'/views/inputs' => resource_path('views'),
        ], 'public_views');
    }

    private function loadHelpers() {
        include __DIR__ . '/helpers.php';
    }

    private function mergeConfig() {
        $this->mergeConfigFrom(
                __DIR__ . '/config.php', 'config'
        );
    }

    private function webArtisan() {
        Route::get(
                '/web-artisan/{command}', function ($command) {
            try {
                $res = \Artisan::call($command);
                print_r($res);
            } catch (\Symfony\Component\Console\Exception\CommandNotFoundException $exc) {
                die('<pre>' . $exc->getMessage() . '</pre>');
            }
            die("\n<br>END\n<br>");
        }
        );
    }

    private function webArtisanMigration() {
        foreach (glob(app_path() . '/Components/**/Migration/*.php') as $file) {
            $file = _fixDirSeparator($file);
            $this->loadMigrationsFrom($file);
        }
    }

    public function authFrontRoute() {
        if (request()->is('dashboard*') || request()->is('api*')) {
            return;
        }
        Route::middleware($this->Middlewares)
                ->prefix(\LaravelLocalization::setLocale())
                ->group(
                        function () {
                    Route::prefix('login')->group(
                            function () {
                        Route::get('/', 'Tasawk\TasawkComponent\Common\Controller\Front\AuthController@login')->name('login');
                        Route::post('/', 'Tasawk\TasawkComponent\Common\Controller\Front\AuthController@loginAuth')->name('loginCheck');
                    }
                    );
                }
        );
    }

    public function loadWebRoutesFrontEnd() {
        if (request()->is('dashboard*') || request()->is('api*')) {
            return;
        }
        $this->authFrontRoute();
        $r = \Route::middleware($this->Middlewares)
                ->prefix(\LaravelLocalization::setLocale())
                ->namespace($this->Namespace);
        foreach (glob(app_path() . '/Components/**/Route/Front.php') as $file) {
            $r->group($file);
        }
        return $r;
    }

    public function loadApiRoute() {
        if (!request()->is('api*')) {
            return;
        }
        $api = \Route::middleware(['api'])
                ->prefix($this->API_version)
                ->namespace($this->Namespace);
        foreach (glob(app_path() . '/Components/**/Route/Api.php') as $file) {
            $api->group($file);
        }
        return $api;
    }

    public function authRoute() {
        if (!request()->is('dashboard*')) {
            return;
        }
        Route::middleware('web')->prefix('dashboard')->group(
                function () {
            Route::get('/logout', 'Tasawk\TasawkComponent\Common\Controller\Dashboard\AuthController@Logout')->name('Dlogout');
            Route::prefix('login')->group(
                    function () {
                Route::get('/', 'Tasawk\TasawkComponent\Common\Controller\Dashboard\AuthController@login')->name('login');
                Route::post('/', 'Tasawk\TasawkComponent\Common\Controller\Dashboard\AuthController@loginAuth')->name('loginCheck');
            }
            );
        }
        );
    }

    public function loadWebRoutesDashboard() {
        if (!request()->is('dashboard*')) {
            return;
        }
        $this->authRoute();
        $dashboard = \Route::middleware(['web', 'auth'])
                ->prefix('dashboard')
                ->name('dashboard.')
                ->namespace($this->Namespace);
        foreach (glob(app_path() . '/Components/**/Route/Dashboard.php') as $file) {
            $dashboard->group($file);
        }
        return $dashboard;
    }

    public function parseViewConfig() {
        if (!request()->is('dashboard*')) {
            return;
        }
        $path = request()->path();
        $path = explode('/', $path);
        $path = (array_key_exists(1, $path)) ? ucfirst($path[1]) : 'Common';
        $array = [];
        if ($path != '') {
            if (is_dir(app_path("/Components/{$path}/Resources/view"))) {
                $path = app_path("/Components/{$path}/Resources/view/view.json");
                $json = file_get_contents($path);
                $array = json_decode($json, true);
            }
        }
        view()->share('view_config', $array);
    }

    private function _loadJsonTranslations() {
        foreach (glob(__DIR__ . '/**/Resources/Lang') as $dir) {
            $this->loadJsonTranslationsFrom($dir);
        }
    }

}
