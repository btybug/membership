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
Route::get('/manage-membership-types', 'MembershipController@getNewMembership', true)->name('mbsp_new_membership');
Route::get('/manage-membership-types/{id?}', 'MembershipController@getNewMembership', true)->name('mbsp_new_membership');
Route::post('/manage-membership-types/{id?}', 'MembershipController@postNewMembership')->name('mbsp_membership_save');
Route::get('/plans', 'IndexConroller@getPlans', true)->name('mbsp_plans');
Route::get('/plans/create', 'PlansController@createPlans', true)->name('mbsp_plans_create');
Route::get('/plans/edit/{id}', 'PlansController@editPlans', true)->name('mbsp_plans_edit');
Route::post('/plans/create', 'PlansController@saveCreatePlan')->name('mbsp_plans_create_save');
Route::post('/plans/edit/{id}', 'PlansController@saveEditPlan')->name('mbsp_plans_edit_save');
Route::get('/payments', 'IndexConroller@getPayments', true)->name('mbsp_payments');
Route::group(['prefix' => 'datatable'], function () {

    Route::get('get-plans', 'DataTablesConroller@getPlans')->name('mbsp_plans_lists');
    Route::get('get-mb-types', 'DataTablesConroller@getMbTypes')->name('mbsp_mb_types_lists');
});
Route::group(['prefix' => 'stripe'], function () {
    Route::get('/', 'StripeController@getIndex',true)->name('mbsp_stripe');
});
Route::get('/settings', 'IndexConroller@getSettings', true)->name('mbsp_settings');
