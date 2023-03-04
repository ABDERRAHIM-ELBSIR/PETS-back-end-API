<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('marquee', function(){
//     // echo  File::get('\storage\app\public\images\cover\mgJwyRljO5Fl9Ms44csGnc1VBbCncOVybvRk4EvX.png');
//     // $url=Storage::disk('local')->get('/storage/mgJwyRljO5Fl9Ms44csGnc1VBbCncOVybvRk4EvX.png');
//     // $url=Storage::download('/storage/mgJwyRljO5Fl9Ms44csGnc1VBbCncOVybvRk4EvX.png');
//     // $url = Storage::url('public/mgJwyRljO5Fl9Ms44csGnc1VBbCncOVybvRk4EvX.png');
//     // <img src="{{ $url }}" alt="Example Image">
//     // echo $url;
//     return view('img_test');

// });