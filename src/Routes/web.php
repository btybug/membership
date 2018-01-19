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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
//Routes
Route::get('/', 'IndexConroller@getIndex', true)->name('mbsp_groups');
Route::group(['prefix' => 'blogs'], function () {
    Route::get('/', 'BlogController@getIndex', true)->name('mbsp_blog');
    Route::post('/create', 'BlogController@postCreate', true)->name('mbsp_blog_create');
    Route::get('/edit/{id}', 'BlogController@getEdit', true)->name('mbsp_blog_edit');
    Route::get('/delete/{id}', 'BlogController@getDelete')->name('mbsp_blog_delete');
    Route::get('/activate/{id}', 'BlogController@getActivate')->name('mbsp_blog_make_active');
    Route::get('/deactivate/{id}', 'BlogController@getDeactivate')->name('mbsp_blog_deactivate');
});

Route::group(['prefix' => 'settings'], function () {
    Route::get('/', 'SettingsController@getSettings', true)->name('mbsp_settings');
    Route::post('/save-pricing-page', 'SettingsController@postSavePricingPage')->name('mbsp_settings_save_pricing_page');
});

//Route::get('/membership-types', 'MembershipController@getIndex', true)->name('mbsp_membership');
//Route::get('/membership-types/make-default/{id}', 'MembershipController@makeDefault')->name('mbsp_type_make_active');
//Route::get('/manage-membership-types', 'MembershipController@getNewMembership', true)->name('mbsp_new_membership');
//Route::get('/manage-membership-types/{id?}', 'MembershipController@getNewMembership', true)->name('mbsp_new_membership');
//Route::post('/manage-membership-types/{id?}', 'MembershipController@postNewMembership')->name('mbsp_membership_save');
Route::group(['prefix' => 'plans'], function () {
    Route::get('/', 'IndexConroller@getPlans', true)->name('mbsp_plans');
    Route::get('/create', 'PlansController@createPlans', true)->name('mbsp_plans_create');
    Route::get('/edit/{id}', 'PlansController@editPlans', true)->name('mbsp_plans_edit');
    Route::get('/edit/{id}/price', 'PlansController@editPlansPrice', true)->name('mbsp_plans_edit_price');
    Route::post('/create', 'PlansController@saveCreatePlan')->name('mbsp_plans_create_save');
    Route::post('/edit/{id}', 'PlansController@saveEditPlan')->name('mbsp_plans_edit_save');
});
Route::group(['prefix' => 'datatable'], function () {

    Route::get('get-plans', 'DataTablesConroller@getPlans')->name('mbsp_plans_lists');
    Route::get('get-mb-types', 'DataTablesConroller@getMbTypes')->name('mbsp_mb_types_lists');
    Route::get('get-mb-members', 'DataTablesConroller@getMembers')->name('mbsp_members_lists');
    Route::get('get-mb-statuses', 'DataTablesConroller@getStatuses')->name('mbsp_statuses');
    Route::get('get-mb-blogs', 'DataTablesConroller@getBlogs')->name('mbsp_blogs');
    Route::get('get-mb-blogs-archive', 'DataTablesConroller@getBlogsArchive')->name('mbsp_blogs_archive');
});
Route::group(['prefix' => 'stripe'], function () {
    Route::get('/', 'StripeController@getIndex', true)->name('mbsp_stripe');
});
//Route::group(['prefix' => 'members'], function () {
//    Route::get('/', 'MemberController@getIndex', true)->name('mbsp_stripe');
//    Route::get('/optimize', 'MemberController@getoptimize');
//    Route::get('/edit/{id}', 'MemberController@getEdit', true)->name('mbsp_edit_member');
//    Route::post('/edit/{id?}', 'MemberController@postEdit');
//});

//cars Blog
Route::group(['prefix' => 'cars'], function () {
    Route::get('/', 'CarsController@getIndex', true);
    Route::get('/posts', 'CarsController@getPosts', true);
    Route::get('/posts-data', 'CarsController@carsData')->name('carsData');
    Route::get('/create-data', 'CarsController@createPosts');
    Route::get('/new-post', 'CarsController@getNewPost', true);
//Route::post('/new-post', 'IndexConroller@postNewPost');
    Route::post('/get-fields', 'CarsController@getFieldsByTable');
    Route::get('/settings', 'CarsController@getSettings', true);
    Route::post('/render-fields', 'CarsController@postRenderField');
    Route::post('/save-form', 'CarsController@postSaverForm');

    Route::group(['prefix' => 'edit-post'], function () {
        Route::get('/', 'CarsController@getEditPost', true);
        Route::get('/{param}', 'CarsController@getEditPost', true);
        Route::post('/{param}', 'CarsController@postEditPos');
    });

    Route::group(['prefix' => 'form-list'], function () {
        Route::get('/', 'CarsController@getList', true);
        Route::get('/create', 'CarsController@getFormBulder', true)->name("form_builder_cars");

        Route::group(['prefix' => 'edit-form'], function () {
            Route::get('/', 'CarsController@getEditFormBulder', true);
            Route::get('/{id}', 'CarsController@getEditFormBulder', true)->name("form_edit_cars_builder_cars");
        });

        Route::post('/create', 'CarsController@postFormBulder')->name('add_or_update_form_builder_cars');

        Route::group(['prefix' => 'settings'], function () {
            Route::get('/', 'CarsController@getFormSettings', true);
            Route::get('/{id}', 'CarsController@getFormSettings', true)->name("form_settings_cars");
            Route::post('/{id}', 'CarsController@postFormSettings', true)->name("post_form_settings_cars");
        });
        Route::group(['prefix' => 'view'], function () {
            Route::get('/', 'CarsController@getMyFormsView', true);
            Route::get('/{id}', 'CarsController@getMyFormsView', true)->name("form_view_cars");
        });
        Route::group(['prefix' => 'edit'], function () {
            Route::get('/', 'MyFormController@getMyFormsEdit', true);
            Route::get('/{id}', 'MyFormController@getMyFormsEdit', true)->name("form_edit_cars");
        });
        Route::post('/form-fields', 'CarsController@postFormFieldsSettings');
    });
    Route::post('/settings', 'CarsController@postSettings');
    Route::post('/render-unit', 'CarsController@unitRenderWithFields');

    Route::post('append-post-scroll-paginator', 'CarsController@appendPostScrollPaginator')->name('append_cars_scroll_paginator');
    Route::post('search', 'CarsController@search')->name('search_cars');
    Route::post('findpage', 'CarsController@findPage')->name('find_page_cars');
});

Route::group(['prefix' => 'products-settings'], function () {
    Route::get('/', 'ProductSettingsController@getIndex', true)->name('mbsp_product_settings');

});

Route::group(['prefix' => '{slug}'], function () {
    Route::get('/', 'BlogCommonController@getIndex', true);
    Route::get('/posts', 'BlogCommonController@getPosts', true);
    Route::get('/posts-data', 'BlogCommonController@postsData')->name('mbsp_posts_data');
    Route::get('/create-data', 'BlogCommonController@createPosts');
    Route::get('/new-post', 'BlogCommonController@getNewPost', true);
//Route::post('/new-post', 'IndexConroller@postNewPost');
    Route::post('/get-fields', 'BlogCommonController@getFieldsByTable');
    Route::get('/settings', 'BlogCommonController@getSettings', true)->name('mbsp_settings_blog');
    Route::get('/options', 'BlogCommonController@getOptions', true)->name('mbsp_settings_blog_options');
    Route::post('/options', 'BlogCommonController@postOptions')->name('mbsp_settings_mb_save_options');
    Route::get('/order-button', 'BlogCommonController@getOrderButton', true)->name('mbsp_order_button');
    Route::post('/order-button', 'BlogCommonController@postOrderButton', true)->name('mbsp_save_order_button');
    Route::post('/render-fields', 'BlogCommonController@postRenderField')->name('mbsp_render_fields');
    Route::post('/save-form', 'BlogCommonController@postSaverForm')->name('mbsp_save_form');

    Route::group(['prefix' => 'edit-post'], function () {
        Route::get('/', 'BlogCommonController@getEditPost', true);
        Route::get('/{param}', 'BlogCommonController@getEditPost', true);
        Route::post('/{param}', 'BlogCommonController@postEditPos');
    });

    Route::group(['prefix' => 'form-list'], function () {
        Route::get('/', 'BlogCommonController@getList', true)->name('blog_form_list');
        Route::get('/create', 'BlogCommonController@getFormBulder', true)->name("form_builder_posts");

        Route::group(['prefix' => 'edit-form'], function () {
            Route::get('/', 'BlogCommonController@getEditFormBulder', true);
            Route::get('/{id}', 'BlogCommonController@getEditFormBulder', true)->name("form_edit_blog_builder");
        });

        Route::post('/create', 'BlogCommonController@postFormBulder')->name('add_or_update_form_builder_blog');

        Route::group(['prefix' => 'settings'], function () {
            Route::get('/', 'BlogCommonController@getFormSettings', true);
            Route::get('/{id}', 'BlogCommonController@getFormSettings', true)->name("form_settings_blog");
            Route::post('/{id}', 'BlogCommonController@postFormSettings', true)->name("post_form_settings_blog");
        });
        Route::group(['prefix' => 'view'], function () {
            Route::get('/', 'BlogCommonController@getMyFormsView', true);
            Route::get('/{id}', 'BlogCommonController@getMyFormsView', true)->name("form_view_blog");
        });
        Route::group(['prefix' => 'edit'], function () {
            Route::get('/', 'BlogCommonController@getMyFormsEdit', true);
            Route::get('/{id}', 'BlogCommonController@getMyFormsEdit', true)->name("form_edit_blog");
        });
        Route::post('/form-fields', 'BlogCommonController@postFormFieldsSettings');
    });

    Route::post('/settings', 'BlogCommonController@postSettings')->name('post_settings_save');
    Route::post('/render-unit', 'BlogCommonController@unitRenderWithFields');

    Route::post('append-post-scroll-paginator', 'BlogCommonController@appendPostScrollPaginator')->name('append_cars_scroll_paginator');
    Route::post('search', 'BlogCommonController@search')->name('search_cars');
    Route::post('findpage', 'BlogCommonController@findPage')->name('find_page_cars');
});
