<?php

Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');


//GENERATED
Route::resource('calificacion', 'CalificacionController');
//For DataTables
Route::get('calificacion/get', 'CalificacionController@get')->name('admin.calificacion.get');