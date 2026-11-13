<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ActivityLog extends Model {protected $fillable=['admin_id','action','detail','kind','metadata']; protected function casts():array{return ['metadata'=>'array'];}}
