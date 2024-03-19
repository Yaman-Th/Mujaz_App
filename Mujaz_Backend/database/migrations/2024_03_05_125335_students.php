<?php

use App\Models\User;
use App\Models\teacher;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(true);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(teacher::class)->nullable();
            $table->string('teacher_name')->nullable();
            $table->integer('phone')->nullable();
            $table->date('starting_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
