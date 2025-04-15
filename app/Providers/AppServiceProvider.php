<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\ServiceProvider;
use App\Models\Notification;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
{
    View::composer('*', function ($view) {
        if (Auth::check()) {
            $notifCount = Notification::where('nrp', Auth::user()->nrp)
                                      ->where('is_read', false)
                                      ->count();
        } else {
            $notifCount = 0;
        }
        $view->with('notifCount', $notifCount);
    });
}
}
