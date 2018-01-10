<?php
/**
 * Copyright (c) 2017.
 * *
 *  * Created by PhpStorm.
 *  * User: Edo
 *  * Date: 10/3/2016
 *  * Time: 10:44 PM
 *
 */

namespace BtyBugHook\Membership\Providers;

use Btybug\btybug\Models\Routes;
use Illuminate\Support\ServiceProvider;


class ModuleServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../views', 'forms');
        $this->loadViewsFrom(__DIR__ . '/../views', 'forms');

        \Eventy::action('admin.menus', [
            "title" => "Membership",
            "custom-link" => "#",
            "icon" => "fa fa-users",
            "is_core" => "yes",
            "children" => [
                [
                    "title" => "Membership Types",
                    "custom-link" => "/admin/membership/groups",
                    "icon" => "fa fa-angle-right",
                    "is_core" => "yes"
                ], [
                    "title" => "Plans",
                    "custom-link" => "/admin/membership/plans",
                    "icon" => "fa fa-angle-right",
                    "is_core" => "yes"
                ], [
                    "title" => "Payments",
                    "custom-link" => "/admin/membership/payments",
                    "icon" => "fa fa-angle-right",
                    "is_core" => "yes"
                ], [
                    "title" => "Settings",
                    "custom-link" => "/admin/membership/settings",
                    "icon" => "fa fa-cog",
                    "is_core" => "yes"
                ]
            ]]);
        Routes::registerPages('sahak.avatar/membership');
    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

    }

}

