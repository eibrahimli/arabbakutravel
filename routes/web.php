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

Route::get('/lang/{lang}',['as' => 'lang.switch', 'uses' => "LanguageController@switchLang"]);

Route::group(['prefix' => 'admin','middleware' => 'onlyAdmin'], function () {
  // Ayarlar rotaları başlanğıc

    Route::get('/','HomeController@index');
    Route::get('/index', 'HomeController@index');
    Route::get('/settings', 'HomeController@edit');
    Route::patch('/settings/{setting}', 'HomeController@update');

  // Ayarlar rotaları bitişi

  // Index ayarlarrotaları başlanğıcı
    Route::patch('/site/{site}', 'SiteAyarController@update');

  // İndex ayarlar rotaları bitişi

  // İstifadəçilərin rotaları başlanğıc

    Route::get('/users','UserController@index');
    Route::get('/users/create', 'UserController@create');
    Route::post('/users/', 'UserController@store');
    Route::get('/users/{user}/edit', 'UserController@edit');
    Route::patch('/users/{user}', 'UserController@update');
    Route::get('/users/{user}', 'UserController@destroy');

  // İstifadəçilərin rotaları bitiş

  // Turların rotaları başlanğıc
    Route::get('/turlar', 'TurController@index');
    Route::get('/turlar/create', 'TurController@create');
    Route::post('/turlar', 'TurController@store');
    Route::get('/turlar/{tur}/edit', 'TurController@edit');
    Route::patch('/turlar/{tur}', 'TurController@update');
    Route::get('/turlar/{tur}', 'TurController@destroy');
    Route::get('/kateqoriyalar', 'CategorieController@index');
    Route::get('/kateqoriyalar/create' , 'CategorieController@create');
    Route::post('/kateqoriyalar', 'CategorieController@store');
    Route::get('/kateqoriyalar/{categorie}/edit', 'CategorieController@edit');
    Route::patch('/kateqoriyalar/{categorie}', 'CategorieController@update');
    Route::get('/kateqoriyalar/{categorie}', 'CategorieController@destroy');

  // Turların rotaları bitiş

  // Turların rotaları başlanğıc
    Route::get('/sifarisler/turaktivsifarisler', 'SifarisController@turIndex');
    Route::get('/sifarisler/turdeaktivsifarisler', 'SifarisController@turNotActiveIndex');
    Route::get('/sifaris/active/{sifaris}', 'SifarisController@turSifarisActive');
    Route::get('/sifaris/sil/{sifaris}','SifarisController@turSifarisSil');

  // Turların rotaları bitiş

  // Otel rotalarının başlanğıcı

    Route::get('/oteller', 'OtelController@index');
    Route::get('/oteller/create', 'OtelController@create')->name('otel.create');
    Route::post('/oteller', 'OtelController@store');
    Route::get('/oteller/{otel}/edit', 'OtelController@edit')->name('otel.edit');
    Route::patch('/oteller/{otel}', 'OtelController@update');
    Route::get('/oteller/{otel}', 'OtelController@destroy');
    Route::get('/oteller/qaleriya/{otel}', 'OtelController@show');
    Route::get('/oteller/qaleriya/sil/{id}', 'OtelController@showDelete');

  // Otel rotalarının bitişi

  // Transfer rotalarının başlanğıcı

    Route::get('/transferler', 'TransferController@index');
    Route::get('/transferler/create', 'TransferController@create');
    Route::post('/transferler', 'TransferController@store');
    Route::get('/transferler/{transfer}/edit', 'TransferController@edit');
    Route::patch('/transferler/{transfer}', 'TransferController@update');
    Route::get('/transferler/{transfer}', 'TransferController@destroy');

  // Transfer rotalarının bitişi

  // Restoran rotalarının başlanğıcı

    Route::get('/restoranlar', 'RestoranController@index');
    Route::get('/restoranlar/create', 'RestoranController@create');
    Route::post('/restoranlar', 'RestoranController@store');
    Route::get('/restoranlar/{restoran}/edit', 'RestoranController@edit');
    Route::patch('/restoranlar/{restoran}', 'RestoranController@update');
    Route::get('/restoranlar/{restoran}', 'RestoranController@destroy');

  // Restoran rotalarının bitişi

  // Səhifə rotalarının başlanğıcı

  Route::get('/sehifeler/aboutus', 'PageController@edit');
  Route::patch('/sehifeler/aboutus/{sehife}', 'PageController@update');

  // Səhifə rotalarının bitişi

  // Dreamtour rotalarının başlanğıcı

  Route::get('dreamtur/activedreamtours', 'DreamtourController@activedreamtours')->name('activedreamtours');
  Route::get('dreamtur/deactivedreamtours', 'DreamtourController@deactivedreamtours')->name('deactivedreamtours');
  Route::get('dreamtur/{dreamtur}','DreamtourController@active')->name('dreamtouractive');
  Route::get('dreamtur/{dreamtur}/delete','DreamtourController@delete')->name('delete');
  Route::get('dreamtur/{dreamtur}/show', 'DreamtourController@show')->name('dreamtourshow');
  Route::patch('dreamtur/{dreamtur}','DreamtourController@update')->name('dreamtourupdate');

  // Dreamtour rotalarının bitişi
});

Auth::routes();

Route::get('/', 'SiteController@index');
Route::get('/index', 'SiteController@index');
Route::get('/turlar', 'SiteController@turIndex');
Route::get('/tur/{tur}-{slug}', 'SiteController@showTur');
Route::get('/oteller', 'SiteController@otelIndex');
Route::get('/otel/{otel}-{slug}', 'SiteController@showOtel');
Route::get('/transferler', 'SiteController@transferIndex');
Route::get('/transfer/{transfer}-{slug}', 'SiteController@showTransfer');
Route::get('/restoranlar', 'SiteController@restoranIndex');
Route::get('/restoran/{restoran}-{slug}', 'SiteController@showRestoran');
Route::get('/aboutus', 'SiteController@showAboutus');
Route::get('/contact', function (){
  return view('frontend.contact');
});
Route::post('/contact', 'SiteController@create');
Route::get('/kateqoriyalar/{kateqoriya}', 'SiteController@getKateqoriya');
Route::post('/sifaris/{id}', 'SifarisController@turCreate');
Route::post('/transfersifaris/{user}', 'SifarisController@transferCreate');
Route::get('/profile/{user}/transfers', 'SiteController@getUserTransfersBookings');
Route::get('/tursifaris/sil/{tursifaris}', 'SiteController@turSifarisSil');
Route::get('/transfersifaris/sil/{transfersifaris}', 'SiteController@transferSifarisSil');
Route::post('/turaxtar', 'AxtarController@turAxtar');
Route::post('/otelaxtar', 'AxtarController@otelAxtar');
Route::post('/restoranaxtar', 'AxtarController@restoranAxtar');
Route::get('/profile/{user}', 'SiteController@getUser')->middleware('auth');
Route::patch('/profile/changem/{user}', 'SiteController@changeEmail')->middleware('auth');
Route::patch('/profile/changep/{user}', 'SiteController@changeP')->middleware('auth');
Route::patch('/editprofile/{user}', 'SiteController@updateProfile')->middleware('auth');
Route::get('dreamtour', 'DreamtourIndexController@index');
Route::post('/dreamtour', 'DreamtourIndexController@create')->name('dreamtour');

