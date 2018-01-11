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
use BtyBugHook\Membership\Models\User;
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
        \Config::set('services.stripe', [
            'model'  => User::class,
            'key' =>'pk_test_zr3Wfst8jb4GrKU8BcLEUkh9',
            'secret' => 'sk_test_5hlaHU2ovKmWpyK33i7sZxxx',
        ]);
        $this->loadTranslationsFrom(__DIR__ . '/../views', 'mbshp');
        $this->loadViewsFrom(__DIR__ . '/../views', 'mbshp');

        \Eventy::action('admin.menus', [
            "title" => "Membership",
            "custom-link" => "#",
            "icon" => "fa fa-users",
            "is_core" => "yes",
            "children" => [
                [
                    "title" => "Membership Types",
                    "custom-link" => "/admin/membership/membership-types",
                    "icon" => "fa fa-angle-right",
                    "is_core" => "yes"
                ], [
                    "title" => "Members",
                    "custom-link" => "/admin/membership/members",
                    "icon" => "fa fa-angle-right",
                    "is_core" => "yes"
                ],[
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
        $tubs = [
            'mb_settings' => [
                [
                    'title' => 'General',
                    'url' => '/admin/membership/settings',
                    'icon' => 'fa fa-cub'
                ],
                [
                    'title' => 'Membership Status',
                    'url' => '/admin/membership/settings/membership-status',
                    'icon' => 'fa fa-cub'
                ],
            ]
        ];

        \Eventy::action('my.tab', $tubs);
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

