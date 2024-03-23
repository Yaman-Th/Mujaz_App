<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\student;
use App\Models\teacher;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignIdFor(student::class);
            $table->string('student_name');
            $table->foreignIdFor(teacher::class);
            $table->string('teacher_name');
            $table->json('pages')->nullable();
            $table->json('ayat')->nullable();
            $table->float('amount');
            $table->json('mistakes')->nullable();
            $table->integer('taps_num');
            $table->float('mark');
            $table->time('duration');
            $table->string('notes');
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
