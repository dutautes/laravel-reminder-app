<?php

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
        Schema::create('user_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('action'); // create_reminder, delete_reminder, login, dll
            $table->string('description')->nullable(); // keterangan
            $table->string('ref_type')->nullable(); // referensi tipe aktifiti
            $table->unsignedBigInteger('ref_id')->nullable(); // id dari reminder mana atau projek mana
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_activities');
    }
};
