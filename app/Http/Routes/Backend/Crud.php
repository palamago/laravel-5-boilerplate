<?php 

//GENERATED

//For DataTables
Route::get('calificacion/get', 'CalificacionController@get')->name('admin.calificacion.get');
//Resource
Route::resource('calificacion', 'CalificacionController');