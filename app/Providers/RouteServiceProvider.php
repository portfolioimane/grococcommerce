<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

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

        //
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

        // general route
        Route::middleware(['web', 'code'])
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
            
          // user profile  route
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/user.php'));

         // cart  route
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/cart.php'));

        // payment related route
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/payment.php'));


        // product route
      /*  Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/product.php'));

        // offer route

        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/offers.php'));

        // settings  route don't apply code middleware here
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/settings.php'));

        // admin  route
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin.php'));

        // order  route
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/order.php'));


        // customer  route
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/customer.php'));

        // Report  route
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/report.php'));

      

       
    }
    */

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    }
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
