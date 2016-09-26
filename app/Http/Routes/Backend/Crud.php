<?php 

//GENERATED

//For DataTables
Route::get('calificacion/get', 'CalificacionController@get')->name('admin.calificacion.get');
//Resource
Route::resource('calificacion', 'CalificacionController');


//For DataTables
Route::get('chequeo/get', 'ChequeoController@get')->name('admin.chequeo.get');
//Resource
Route::resource('chequeo', 'ChequeoController');



//For DataTables
Route::get('etapa/get', 'EtapaController@get')->name('admin.etapa.get');
//Resource
Route::resource('etapa', 'EtapaController');