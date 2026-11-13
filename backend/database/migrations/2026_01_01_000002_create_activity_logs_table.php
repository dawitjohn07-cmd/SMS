<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration {public function up():void{Schema::create('activity_logs',function(Blueprint $t){$t->id();$t->foreignId('admin_id')->nullable()->constrained('users')->nullOnDelete();$t->string('action');$t->text('detail');$t->enum('kind',['add','edit','delete','security']);$t->json('metadata')->nullable();$t->timestamps();$t->index('created_at');});}public function down():void{Schema::dropIfExists('activity_logs');}};
