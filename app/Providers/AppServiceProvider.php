<?php

namespace App\Providers;

use App\Models\SiteOption;
use Illuminate\Support\Facades\Blade;
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
        //
        view()->composer('*', function ($view) {
            $SiteOption = SiteOption::all();
            $view->with('SiteOption', $SiteOption);
        });
        Blade::directive('excerpt', function ($text) {
            return "<?php echo Str::limit($text, 120); ?>";
        });
    }
}
