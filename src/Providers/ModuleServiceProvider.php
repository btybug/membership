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
use BtyBugHook\Membership\Services\BlogService;
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
            'model' => User::class,
            'key' => 'pk_test_zr3Wfst8jb4GrKU8BcLEUkh9',
            'secret' => 'sk_test_5hlaHU2ovKmWpyK33i7sZxxx',
        ]);
        $this->loadTranslationsFrom(__DIR__ . '/../views', 'mbshp');
        $this->loadViewsFrom(__DIR__ . '/../views', 'mbshp');

        BlogService::getActive();


        \Eventy::action('admin.menus', [
            "title" => "Products",
            "custom-link" => "#",
            "icon" => "fa-product-hunt",
            "is_core" => "yes",
            "children" => [
//                [
//                    "title" => "Membership Types",
//                    "custom-link" => "/admin/membership/membership-types",
//                    "icon" => "fa fa-angle-right",
//                    "is_core" => "yes"
//                ], [
//                    "title" => "Members",
//                    "custom-link" => "/admin/membership/members",
//                    "icon" => "fa fa-angle-right",
//                    "is_core" => "yes"
//                ],
                [
                    "title" => " Products Settings",
                    "custom-link" => "/admin/membership/settings",
                    "icon" => "fa fa-angle-right",
                    "is_core" => "yes"
                ],
//                [
//                    "title" => "Mobiles",
//                    "custom-link" => "/admin/membership/plans",
//                    "icon" => "fa fa-angle-right",
//                    "is_core" => "yes"
//                ],
//                [
//                    "title" => "Cars",
//                    "custom-link" => "/admin/membership/cars",
//                    "icon" => "fa fa-angle-right",
//                    "is_core" => "yes"
//                ]
            ]]);
        $tubs = [
            'mb_settings' => [
                [
                    'title' => 'General',
                    'url' => '/admin/membership/settings',
                    'icon' => 'fa fa-cub'
                ], [
                    'title' => 'Options',
                    'url' => '/admin/membership/settings/membership-options',
                    'icon' => 'fa fa-cub'
                ], [
                    'title' => 'Blogs',
                    'url' => '/admin/membership/blogs',
                    'icon' => 'fa fa-cub'
                ]
            ],
            'create_product' => [
                [
                    'title' => 'General',
                    'url' => '/admin/membership/plans/create',
                    'icon' => 'fa fa-cub'
                ]
            ],
            'edit_product' => [
                [
                    'title' => 'General',
                    'url' => '/admin/membership/plans/edit/{id}',
                    'icon' => 'fa fa-cub'
                ]
            ], 'cars_pages' => [
                [
                    'title' => 'General',
                    'url' => '/admin/membership/cars/settings',
                ], [
                    'title' => 'Form List',
                    'url' => '/admin/membership/cars/form-list',
                ], [
                    'title' => 'Options',
                    'url' => '/admin/membership/cars/options',
                    'icon' => 'fa fa-cub'
                ], [
                    'title' => 'Order Button',
                    'url' => '/admin/membership/cars/order-button',
                    'icon' => 'fa fa-cub'
                ]
            ]
        ];

        //   \Config::set('painter.PAINTERSPATHS',array_merge( \Config::get('painter.PAINTERSPATHS'),['app'.DS.'Plugins'.DS.'vendor'.DS.'sahak.avatar'.DS.'membership'.DS.'src'.DS.'Gears']));
        \Eventy::action('my.tab', $tubs);
        Routes::registerPages('sahak.avatar/membership');

        \Eventy::action('shortcode.except.url', [
            'admin/membership/cars/form-list'
        ]);
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

