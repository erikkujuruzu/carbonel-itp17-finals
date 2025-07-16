<?php

namespace App\Providers;

use App\Models\Booking;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
        // Share bookings data with sidebar component
        View::composer('components.sidebar', function ($view) {
            $bookings = Booking::with('user')->get();
            $view->with('bookings', $bookings);
        });
    }
}
