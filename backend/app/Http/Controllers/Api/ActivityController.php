<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller; use App\Models\ActivityLog;
class ActivityController extends Controller {public function index(){return ActivityLog::latest()->paginate(100);}}
