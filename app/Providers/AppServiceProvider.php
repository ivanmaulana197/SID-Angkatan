<?php

namespace App\Providers;

use App\Http\View\Composers\DataComposer;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Str;

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
        Paginator::useBootstrap();
        View::composer('*', DataComposer::class);
        Blade::directive('slug', function ($value) {
            return "<?php echo Str::slug($value); ?>";
        });
    }
}
