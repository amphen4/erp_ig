<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapRootRoutes();

        $this->mapAdminuserRoutes();

        $this->mapFacturacionuserRoutes();

        $this->mapProduccionuserRoutes();

        $this->mapVentasuserRoutes();

        //
    }

    /**
     * Define the "ventasuser" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapVentasuserRoutes()
    {
        Route::group([
            'middleware' => ['web', 'ventasuser', 'auth:ventasuser'],
            'prefix' => 'ventasuser',
            'as' => 'ventasuser.',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/ventasuser.php');
        });
    }

    /**
     * Define the "produccionuser" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapProduccionuserRoutes()
    {
        Route::group([
            'middleware' => ['web', 'produccionuser', 'auth:produccionuser'],
            'prefix' => 'produccionuser',
            'as' => 'produccionuser.',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/produccionuser.php');
        });
    }

    /**
     * Define the "facturacionuser" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapFacturacionuserRoutes()
    {
        Route::group([
            'middleware' => ['web', 'facturacionuser', 'auth:facturacionuser'],
            'prefix' => 'facturacionuser',
            'as' => 'facturacionuser.',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/facturacionuser.php');
        });
    }

    /**
     * Define the "adminuser" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAdminuserRoutes()
    {
        Route::group([
            'middleware' => ['web', 'adminuser', 'auth:adminuser'],
            'prefix' => 'adminuser',
            'as' => 'adminuser.',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/adminuser.php');
        });
    }

    /**
     * Define the "root" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapRootRoutes()
    {
        Route::group([
            'middleware' => ['web', 'root', 'auth:root'],
            'prefix' => 'root',
            'as' => 'root.',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/root.php');
        });
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
