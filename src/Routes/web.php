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
Route::get('/membership-types', 'MembershipController@getIndex', true)->name('mbsp_membership');
Route::get('/membership-types/make-default/{id}', 'MembershipController@makeDefault')->name('mbsp_type_make_active');
Route::get('/manage-membership-types', 'MembershipController@getNewMembership', true)->name('mbsp_new_membership');
Route::get('/manage-membership-types/{id?}', 'MembershipController@getNewMembership', true)->name('mbsp_new_membership');
Route::post('/manage-membership-types/{id?}', 'MembershipController@postNewMembership')->name('mbsp_membership_save');
Route::group(['prefix' => 'plans'], function () {
    Route::get('/', 'IndexConroller@getPlans', true)->name('mbsp_plans');
    Route::get('/create', 'PlansController@createPlans', true)->name('mbsp_plans_create');
    Route::get('/edit/{id}', 'PlansController@editPlans', true)->name('mbsp_plans_edit');
    Route::post('/create', 'PlansController@saveCreatePlan')->name('mbsp_plans_create_save');
    Route::post('/edit/{id}', 'PlansController@saveEditPlan')->name('mbsp_plans_edit_save');
});
Route::get('/payments', 'IndexConroller@getPayments', true)->name('mbsp_payments');
Route::group(['prefix' => 'datatable'], function () {

    Route::get('get-plans', 'DataTablesConroller@getPlans')->name('mbsp_plans_lists');
    Route::get('get-mb-types', 'DataTablesConroller@getMbTypes')->name('mbsp_mb_types_lists');
    Route::get('get-mb-members', 'DataTablesConroller@getMembers')->name('mbsp_members_lists');
    Route::get('get-mb-statuses', 'DataTablesConroller@getStatuses')->name('mbsp_statuses');
});
Route::group(['prefix' => 'stripe'], function () {
    Route::get('/', 'StripeController@getIndex', true)->name('mbsp_stripe');
});
Route::group(['prefix' => 'members'], function () {
    Route::get('/', 'MemberController@getIndex', true)->name('mbsp_stripe');
    Route::get('/optimize', 'MemberController@getoptimize');
    Route::get('/edit/{id}', 'MemberController@getEdit', true)->name('mbsp_edit_member');
    Route::post('/edit/{id?}', 'MemberController@postEdit');
});
Route::group(['prefix' => 'settings'], function () {
    Route::get('/', 'SettingsController@getSettings', true)->name('mbsp_settings');
    Route::group(['prefix' => 'membership-status'], function () {
        Route::get('/', 'SettingsController@getMembershipTypes', true)->name('mbsp_settings_mb_types');
        Route::get('/create', 'SettingsController@getCreateStatus', true)->name('mbsp_settings_status_create');
        Route::post('/create', 'SettingsController@postCreateStatus');
        Route::get('/edit/{id}', 'SettingsController@getEditStatus', true)->name('mbsp_settings_status_edit');
        Route::get('/delete/{id}', 'SettingsController@getDeleteStatus')->name('mbsp_settings_status_del');
        Route::post('/edit/{id}', 'SettingsController@postEditStatus');
    });
});

