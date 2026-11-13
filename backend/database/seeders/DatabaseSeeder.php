<?php
namespace Database\Seeders;
use App\Models\User; use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder {public function run():void{$password=env('ADMIN_PASSWORD');if(!$password||strlen($password)<12)throw new \RuntimeException('Set ADMIN_PASSWORD to a unique password of at least 12 characters in .env before seeding.');User::updateOrCreate(['email'=>env('ADMIN_EMAIL','admin@northstar.edu')],['name'=>env('ADMIN_NAME','Alex Rivera'),'password'=>$password,'department'=>'Student Affairs']);}}
