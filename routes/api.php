<?php

use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;

Route::resource('guests', GuestController::class)->except([
    'create', 'edit',
]);


Route::get('/', function () {
    //\Illuminate\Support\Facades\Log::channel('telegram')->info('test');
    return response()->json(['test' => 'test']);
});
