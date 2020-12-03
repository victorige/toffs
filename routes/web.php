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
    return view('home', ['pagetitle' => 'TOFFS']);
})->name('home');

Route::get('a/{id}', 'invite@done')->name('done');
Route::get('picture/{id}', 'invite@picture')->name('picture');
Route::get('img/{id}.png', 'invite@img')->name('img');
Route::get('p/{id}', 'invite@qrcode')->name('qrcode');

Route::get('list', 'invite@list')->name('list');

Route::get('proimg/{id}', 'invite@proimg')->name('proimg');

Route::post('package', 'invite@package')->name('package');

Route::post('confirm', 'invite@confirm')->name('confirm');

Route::get('/get/invite', function () {
    return view('invite', ['pagetitle' => 'Get Invite']);
})->name('get.invite');

Route::get('/check', function () {
    return view('check', ['pagetitle' => 'Activate Invite']);
})->name('check');

Route::get('/about', function () {
    return view('about', ['pagetitle' => 'About Us']);
})->name('about');

Route::get('/contact', function () {
    return view('contact', ['pagetitle' => 'Contact Us']);
})->name('contact');

Route::get('/xcbdh8count', 'invite@count')->name('count');

Route::post('check/invite', 'invite@check')->name('check.invite');

Route::post('check/activation', 'invite@activation')->name('check.activation');

Route::get('search', function () {
    return view('searchpage', ['pagetitle' => 'Search']);
})->name('search');

Route::post('search/action', 'invite@searchAction')->name('search.action');


Route::get('fetch', 'invite@fetch')->name('fetch');

Route::get('sms', 'invite@sms')->name('sms');
