<?php

use App\Models\User;
use App\Models\LocationObject;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(LocationObject::class);
            $table->float('score', 2, 1);
            $table->string('comment');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
