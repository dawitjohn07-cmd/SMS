<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller; use App\Models\Student; use App\Models\ActivityLog;
class DashboardController extends Controller {public function __invoke(){$courses=Student::query()->select('course')->get()->groupBy('course')->map(fn($rows)=>$rows->count())->sortDesc();return ['total'=>Student::count(),'active'=>Student::where('status','Active')->count(),'inactive'=>Student::where('status','Inactive')->count(),'on_leave'=>Student::where('status','On leave')->count(),'recent'=>Student::latest()->limit(5)->get(),'activities'=>ActivityLog::latest()->limit(5)->get(),'courses'=>$courses];}}
