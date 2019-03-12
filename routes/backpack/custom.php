<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    CRUD::resource('user', 'UserCrudController');
    CRUD::resource('category', 'CategoryCrudController');
    CRUD::resource('post', 'PostCrudController');
    CRUD::resource('comment', 'CommentCrudController');
    CRUD::resource('subscriber', 'SubscriberCrudController');
//    CRUD::resource('report', 'ReportController');
    $actions = '^(views|comments)$';
    Route::get('report/{action}', 'ReportController@index')
        ->where(['action'=>$actions])
        ->name('admin.report');
    Route::get('/generate/{action}', 'ReportController@generateReport')
        ->where(['action'=>$actions])
        ->name('reports.generate_report');
    Route::post('/download/{action}/{file}', 'ReportController@downloadReport')
        ->where(['action'=>$actions])
        ->name('reports.download');
    Route::post('/delete/{action}/{file}', 'ReportController@deleteReport')
        ->where(['action'=>$actions])
        ->name('reports.delete');

}); // this should be the absolute last line of this file
