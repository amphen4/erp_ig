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
    return view('welcome');
});


Route::group(['prefix' => 'ventasuser'], function () {
  Route::get('/login', 'VentasuserAuth\LoginController@showLoginForm');
  Route::post('/login', 'VentasuserAuth\LoginController@login');
  Route::post('/logout', 'VentasuserAuth\LoginController@logout');

  //Route::get('/register', 'VentasuserAuth\RegisterController@showRegistrationForm');
  //Route::post('/register', 'VentasuserAuth\RegisterController@register');

  Route::post('/password/email', 'VentasuserAuth\ForgotPasswordController@sendResetLinkEmail');
  Route::post('/password/reset', 'VentasuserAuth\ResetPasswordController@reset');
  Route::get('/password/reset', 'VentasuserAuth\ForgotPasswordController@showLinkRequestForm');
  Route::get('/password/reset/{token}', 'VentasuserAuth\ResetPasswordController@showResetForm');

  Route::get('/img-perfil/{id}','VentasPerfilController@mostrarImagenPerfil');

  Route::get('/perfil','VentasPerfilController@mostrarPerfil');
  Route::post('/perfil','VentasPerfilController@guardarPerfil');

  Route::resource('/cotizaciones','VentasCotizacionesController');
  Route::get('/productos.json','VentasProductosController@enviarProductos');

  Route::get('/clientes.json','VentasClientesController@enviarClientes');
  Route::post('/clientes','VentasClientesController@guardarCliente');

  Route::get('/cotizacion/{id}','VentasAjaxController@productosDeCotizacion');

  Route::resource('/ots','VentasOtsController');

  Route::post('/filtrarOts','VentasAjaxController@filtrarOts');

  Route::get('/reporteCotizacion/{id}','VentasAjaxController@cotizacionPdf');
  Route::get('/reporteOt/{id}','VentasAjaxController@otPdf');
});

Route::group(['prefix' => 'produccionuser'], function () {
  Route::get('/login', 'ProduccionuserAuth\LoginController@showLoginForm');
  Route::post('/login', 'ProduccionuserAuth\LoginController@login');
  Route::post('/logout', 'ProduccionuserAuth\LoginController@logout');

  //Route::get('/register', 'ProduccionuserAuth\RegisterController@showRegistrationForm');
  //Route::post('/register', 'ProduccionuserAuth\RegisterController@register');

  Route::post('/password/email', 'ProduccionuserAuth\ForgotPasswordController@sendResetLinkEmail');
  Route::post('/password/reset', 'ProduccionuserAuth\ResetPasswordController@reset');
  Route::get('/password/reset', 'ProduccionuserAuth\ForgotPasswordController@showLinkRequestForm');
  Route::get('/password/reset/{token}', 'ProduccionuserAuth\ResetPasswordController@showResetForm');

  Route::get('/img-perfil/{id}','ProduccionPerfilController@mostrarImagenPerfil');

  Route::get('/perfil','ProduccionPerfilController@mostrarPerfil');
  Route::post('/perfil','ProduccionPerfilController@guardarPerfil');

  Route::resource('/productos','ProduccionProductosController');
  Route::resource('/categorias','ProduccionCategoriasController');
  Route::resource('/marcas','ProduccionMarcasController');
  Route::resource('/inventarios','ProduccionInventariosController');

  Route::resource('/ots','ProduccionOtsController');

  Route::post('/filtrarOts','ProduccionAjaxController@filtrarOts');

  Route::get('/reporteCotizacion/{id}','ProduccionAjaxController@cotizacionPdf');
  Route::get('/reporteOt/{id}','ProduccionAjaxController@otPdf');
});

Route::group(['prefix' => 'facturacionuser'], function () {
  Route::get('/login', 'FacturacionuserAuth\LoginController@showLoginForm');
  Route::post('/login', 'FacturacionuserAuth\LoginController@login');
  Route::post('/logout', 'FacturacionuserAuth\LoginController@logout');

  //Route::get('/register', 'FacturacionuserAuth\RegisterController@showRegistrationForm');
  //Route::post('/register', 'FacturacionuserAuth\RegisterController@register');

  Route::post('/password/email', 'FacturacionuserAuth\ForgotPasswordController@sendResetLinkEmail');
  Route::post('/password/reset', 'FacturacionuserAuth\ResetPasswordController@reset');
  Route::get('/password/reset', 'FacturacionuserAuth\ForgotPasswordController@showLinkRequestForm');
  Route::get('/password/reset/{token}', 'FacturacionuserAuth\ResetPasswordController@showResetForm');

  Route::get('/img-perfil/{id}','FacturacionPerfilController@mostrarImagenPerfil');

  Route::get('/perfil','FacturacionPerfilController@mostrarPerfil');
  Route::post('/perfil','FacturacionPerfilController@guardarPerfil');

  Route::resource('/ots','FacturacionOtsController');

  Route::post('/filtrarOts','FacturacionAjaxController@filtrarOts');

  Route::get('/reporteCotizacion/{id}','FacturacionAjaxController@cotizacionPdf');
  Route::get('/reporteOt/{id}','FacturacionAjaxController@otPdf');

  Route::get('/facturas','FacturacionFacturasController@index');

  Route::post('/filtrarFacturas','FacturacionAjaxController@filtrarFacturas');
});

Route::group(['prefix' => 'adminuser'], function () {
  Route::get('/login', 'AdminuserAuth\LoginController@showLoginForm');
  Route::post('/login', 'AdminuserAuth\LoginController@login');
  Route::post('/logout', 'AdminuserAuth\LoginController@logout');

  //Route::get('/register', 'AdminuserAuth\RegisterController@showRegistrationForm');
  //Route::post('/register', 'AdminuserAuth\RegisterController@register');

  Route::post('/password/email', 'AdminuserAuth\ForgotPasswordController@sendResetLinkEmail');
  Route::post('/password/reset', 'AdminuserAuth\ResetPasswordController@reset');
  Route::get('/password/reset', 'AdminuserAuth\ForgotPasswordController@showLinkRequestForm');
  Route::get('/password/reset/{token}', 'AdminuserAuth\ResetPasswordController@showResetForm');

  Route::get('/img-perfil/{id}','AdminPerfilController@mostrarImagenPerfil');

  Route::get('/users/{tipo}','AdminUsersController@listarUsuarios');
  Route::post('/users/{tipo}','AdminUsersController@nuevoUsuario');
  Route::delete('/users/{tipo}','AdminUsersController@eliminarUsuario');

  Route::get('/perfil','AdminPerfilController@mostrarPerfil');
  Route::post('/perfil','AdminPerfilController@guardarPerfil');

  Route::resource('/productos','AdminProductosController');
  Route::resource('/categorias','AdminCategoriasController');
  Route::resource('/marcas','AdminMarcasController');
  Route::resource('/inventarios','AdminInventariosController');

  Route::get('/eventos','AdminCalendarioController@enviarEventos');
  Route::post('/enviarEvento','AdminCalendarioController@guardarEvento');
  Route::post('/actualizarEvento/{id}','AdminCalendarioController@actualizar');
  Route::post('/eliminarEvento/{id}','AdminCalendarioController@eliminar');

  Route::resource('/clientes','AdminClientesController');
  Route::resource('/ots','AdminOtsController');

  Route::post('/filtrarOts','AdminAjaxController@filtrarOts');

  Route::get('/reporteCotizacion/{id}','AdminAjaxController@cotizacionPdf');
  Route::get('/reporteOt/{id}','AdminAjaxController@otPdf');

  Route::get('/productos.json','AdminAjaxController@enviarProductos');

  Route::resource('/cotizaciones','AdminCotizacionesController');
  Route::resource('/reportes','AdminReportesController');

  Route::get('/descargarReporte/{filename}','AdminAjaxController@descargarReporte');
});

Route::group(['prefix' => 'root'], function () {
  Route::get('/login', 'RootAuth\LoginController@showLoginForm');
  Route::post('/login', 'RootAuth\LoginController@login');
  Route::post('/logout', 'RootAuth\LoginController@logout');

  //Route::get('/register', 'RootAuth\RegisterController@showRegistrationForm');
  //Route::post('/register', 'RootAuth\RegisterController@register');

  Route::post('/password/email', 'RootAuth\ForgotPasswordController@sendResetLinkEmail');
  Route::post('/password/reset', 'RootAuth\ResetPasswordController@reset');
  Route::get('/password/reset', 'RootAuth\ForgotPasswordController@showLinkRequestForm');
  Route::get('/password/reset/{token}', 'RootAuth\ResetPasswordController@showResetForm');

  Route::get('/csv','RootCsvController@index');
  Route::post('/csv','RootCsvController@store');
});
