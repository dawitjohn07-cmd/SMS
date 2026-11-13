<?php
use Illuminate\Support\Facades\Route;
Route::get('/', fn () => response()->json(['application'=>'Northstar Student Management API','health'=>'/up']));
