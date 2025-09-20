<?php

// app()->view('/', 'index');

app()->get('/', function() {
    if(auth()->user()) return response()->redirect('/dashboard');
    return response()->redirect('/auth/login');
});

app()->registerMiddleware('guest', function(){
    if(!auth()->user()) {
        if(request()->getPath() !== '/auth/login' && request()->getPath() !== '/auth/register') {
            return response()->redirect('/auth/login');
        }
    }
});

app()->group("/auth", ["middleware" => "guest", function() {
    app()->get('/login', 'AuthsController@login');
    app()->post('/login', 'AuthsController@authenticate');
    app()->get('/register', 'AuthsController@register');
    app()->get('/logout', 'AuthsController@logout');
}]);

app()->group('/dashboard', ["middleware" => "guest", function(){
    app()->get('/', 'DashboardController@index');
    app()->get('/stats', 'DashboardController@getStats');
}]);
app()->get('/profile', ["middleware" => "guest",'ProfileController@index']);

app()->group('/resellers', ["middleware" => "guest", function() {
    app()->get('/', 'ResellersController@manage');
    app()->get('/create', 'ResellersController@create');
    app()->post('/create', 'ResellersController@store');
    app()->post('/delete', 'ResellersController@destroy');
    app()->get('/edit/{resellerId}', 'ResellersController@edit');
    app()->post('/edit/{resellerId}', 'ResellersController@update');
    app()->get('/data-tables', 'ResellersController@dataTables');
}]);

// app()->group('/devices', ["middleware" => "guest", function() {
//     app()->get("/", "DevicesController@manage");
//     app()->post("/info", "DevicesController@info");
//     app()->get('/activate', 'DevicesController@create');
//     app()->post('/activate', 'DevicesController@store');
//     app()->post('/delete', 'DevicesController@destroy');
//     app()->post('/update', 'DevicesController@update');
// }]);

app()->group('/devices', ["middleware" => "guest", function() {
    app()->get("/", "DevicesController@info");
    app()->get('/info', 'DevicesController@info');
    app()->post("/info", "DevicesController@postInfo");
}]);

app()->group("/playlists", ["middleware" => "guest", function() {
    app()->get('/add', 'PlaylistsController@create');
    app()->post('/add', 'PlaylistsController@store');
    app()->post('/add/xtreamcodes', 'PlaylistsController@storeXtreamCodes');
    app()->post('/add/url', 'PlaylistsController@storeUrl');
    app()->get('/edit/{playlistId}', 'PlaylistsController@show');
    app()->post('/edit/{playlistId}', 'PlaylistsController@update');
    app()->get('/delete/{playlistId}', 'PlaylistsController@destroy');
    app()->post('/device/info', 'PlaylistsController@deviceInfo');
}]);

app()->group('/activation', ["middleware" => "guest", function(){
    app()->get('/', 'ActivationsController@index');
    app()->post('/device/info', 'ActivationsController@deviceInfo');
    app()->post('/device/activate', 'ActivationsController@activateDevice');
}]);