<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', function(){
    if (Auth::user()->role->level == 'manager') {
        # code...
        return redirect('/manager');
    }elseif (Auth::user()->role->level == 'staff') {
        # code...
        return redirect('/staff');

    }else{
        return redirect('/client');

    }
})->middleware('auth')->name('home');



Route::group(['middleware' => 'auth'], function(){
    Route::group(['prefix' => 'manager'], function(){
        Route::get('/', 'DashboardController@manager');
        Route::group(['prefix' => 'staff'], function(){
            Route::post('/', 'StaffController@add');
            Route::patch('/up/{id}', 'StaffController@update');
            Route::get('/{id}', 'StaffController@show');
            Route::post('/destroy/{id}', 'StaffController@destroy');
            Route::get('/', 'StaffController@lists');
        });
        Route::group(['prefix' => 'client'], function(){
            Route::post('/', 'ClientController@add');
            Route::patch('/up/{id}', 'ClientController@update');
            Route::get('/{id}', 'ClientController@show');
            Route::get('/', 'ClientController@lists');
        });
        Route::group(['prefix' => 'report'], function(){
            Route::post('/', 'ReportController@add');
            Route::patch('/up/{id}', 'ReportController@update');
            Route::get('/{id}', 'ReportController@show');
            Route::post('/destroy/{id}', 'ReportController@destroy');
            Route::get('/', 'ReportController@lists');
        });
    });
    Route::group(['prefix' => 'client'], function(){
        Route::get('/', 'DashboardController@client');
        Route::post('/{id}', 'DashboardController@upload');
    });
    Route::group(['prefix' => 'staff'], function(){
        Route::get('/', 'DashboardController@staff');

        Route::group(['prefix' => 'report'], function(){
            Route::get('/', 'StaffReportController@reports');
            Route::post('/message/{id}', 'StaffReportController@updateMessage');
            Route::post('/status/{id}', 'StaffReportController@updateStatus');
            Route::get('/{id}', 'StaffReportController@show');

            Route::group(['prefix' => 'asset'], function(){
                Route::post('/add/{id}', 'StaffAssetController@add');
                Route::post('/update/{id}', 'StaffAssetController@update');
                Route::post('/delete/{id}', 'StaffAssetController@delete');
                Route::get('/{id}', 'StaffAssetController@lists');
            });

            Route::group(['prefix' => 'liability'], function(){
                Route::post('/add/{id}', 'StaffLiabilityController@add');
                Route::post('/update/{id}', 'StaffLiabilityController@update');
                Route::post('/delete/{id}', 'StaffLiabilityController@delete');
                Route::get('/{id}', 'StaffAssetController@lists');
            });
        });

        
    });
});