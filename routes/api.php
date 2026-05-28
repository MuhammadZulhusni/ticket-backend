<?php

use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

// apiResource auto-creates all 5 RESTful endpoints
Route::apiResource('tickets', TicketController::class);