<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//Route::get('/catalogo', function () {
//    return view('catalogo');
//});
//Route::get('/, WelcomeController@index');

//Route::get('/catalogo', 'CatalogoController@index' );

//Route::get('/inventario', 'InventarioController@index' );

//Route::get('/ventas', 'VentasController@index' );




/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => ['web']], function () {
    Route::auth();
  
    Route::get('/', 'WelcomeController@index');

    Route::resource('/compra', 'CompraController' );
    Route::resource('/venta', 'VentaController' );
  
    Route::get('/DetalleCompra/show/{id}', 'DetalleCompraController@show' );
    Route::get('/DetalleCompra/add/{id}', 'DetalleCompraController@add' );
    Route::get('/DetalleCompra/add', 'DetalleCompraController@create' );
    Route::get('/DetalleCompra/destroy/{id}', 'DetalleCompraController@destroy' );
  
  
    Route::resource('/venta', 'VentaController' );
    Route::get('/DetalleVenta/show/{id}', 'DetalleVentaController@show' );
    Route::get('/DetalleVenta/add/{id}', 'DetalleVentaController@add' );
    Route::get('/DetalleVenta/drop/{id}', 'DetalleVentaController@drop' );

  
  
    Route::resource('/medicamento/presentacion', 'PresentacionController');
    Route::resource('/medicamento', 'MedicamentoController');
    
    
});
