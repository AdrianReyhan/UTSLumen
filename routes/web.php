<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(
    ['prefix' => 'api'],
    function () use ($router) {
        $router->get('/anggota/all', 'AnggotaController@index');
        $router->get('/anggota/{id}', 'AnggotaController@show');
        $router->post('/anggota', 'AnggotaController@store');
        $router->put('/anggota/{id}', 'AnggotaController@update');
        $router->delete('/anggota/{id}', 'AnggotaController@destroy');

        $router->get('/peminjaman/all', 'PeminjamanController@index'); // Menampilkan semua peminjaman
        $router->get('/peminjaman/{id}', 'PeminjamanController@show'); // Menampilkan peminjaman berdasarkan ID
        $router->post('/peminjaman', 'PeminjamanController@store'); // Menambah peminjaman baru
        $router->put('/peminjaman/{id}', 'PeminjamanController@update'); // Mengupdate peminjaman berdasarkan ID
        $router->delete('/peminjaman/{id}', 'PeminjamanController@destroy');

        $router->get('/pembayaran/all', 'PembayaranController@index');  // Menampilkan semua pembayaran
        $router->get('/pembayaran/{id}', 'PembayaranController@show'); // Menampilkan pembayaran berdasarkan ID
        $router->post('/pembayaran', 'PembayaranController@store'); // Menambah pembayaran baru
        $router->put('/pembayaran/{id}', 'PembayaranController@update'); // Mengupdate pembayaran berdasarkan ID
        $router->delete('/pembayaran/{id}', 'PembayaranController@destroy');
    }
);
