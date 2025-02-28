<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Footer;
use App\Models\Header;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Pagination\Paginator;
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
        // header
        View::composer('frontend.modules.common.partials.header', function ($view) {
            $view->with('header', Header::first());
        });
        // footer
        View::composer('frontend.modules.common.partials.footer', function ($view) {
            $view->with('footer', Footer::first());
        });

        // page pass
        View::share('page', Page::first());
        View::share('section', PageSection::first());

        Paginator::useBootstrapFive();

        $categories = Category::with('subcategories')->where('status', 1)->latest()->get();
        view()->share(['categories'=> 'categories']);

        // global seo
        View::composer('*', function ($view) {
            $data = $view->getData();
            if (!isset($data['seo'])) {
                $view->with('seo', new \App\Models\PageSeoSetting());
            }
        });
    }
}
