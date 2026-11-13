<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Student extends Model {protected $fillable=['student_number','first_name','last_name','email','phone','course','year','status','gpa','joined','dob','gender','address','guardian','guardian_phone']; protected function casts():array{return ['gpa'=>'decimal:2','joined'=>'date:Y-m-d','dob'=>'date:Y-m-d'];}}
