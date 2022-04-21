<?php

use App\Http\Controllers\Admin\ReportController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->group(function(){

    //Module reports
    Route::get('/reports', 'Admin\ReportController@getHome')->name('reports');
});
