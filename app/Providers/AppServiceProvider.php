<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Services\SlackNotificationServiceInterface;
use App\Services\SlackNotificationService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
         $this->app->singleton(
            SlackNotificationServiceInterface::class,
            SlackNotificationService::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
     
    public function boot()
    {
        
        
        \URL::forceScheme('https');
        $this->app['request']->server->set('HTTPS','on');
        
         Collection::macro('paginate', function ($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            return new LengthAwarePaginator(
                $this->forPage($page, $perPage)->values(),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
    }
    
}
