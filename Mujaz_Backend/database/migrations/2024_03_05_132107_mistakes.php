<?php

use App\Models\session;
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
        Schema::create('mistakes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(session::class)->default('0');
            $table->string('type');
            $table->integer('ayah_num')->nullable(true);
            $table->string('word')->nullable(true);
            $table->integer('mark');
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
