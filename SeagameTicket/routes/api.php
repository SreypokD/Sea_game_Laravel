<?php

use App\Http\Controllers\Event_detailController as ControllersEvent_detailController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\StadiumController;
use App\Http\Controllers\TicketController;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('events' ,EventController::class);

Route::resource('event_details' , ControllersEvent_detailController::class);

Route::get('/buyticket/{id}' ,[TicketController::class , 'buyTicket']);
Route::resource('tickets' ,TicketController::class);

Route::resource('stadiums' , StadiumController::class);


