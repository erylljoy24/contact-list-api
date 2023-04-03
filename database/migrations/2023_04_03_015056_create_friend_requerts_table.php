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
        Schema::create('friend_requerts', function (Blueprint $table) {
            $table->id();
            $table->Integer('requestor_id')->unsigned()->default(0);
            $table->Integer('requestee_id')->unsigned()->default(0);
            $table->tinyInteger('is_approved')->unsigned()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('friend_requerts');
    }
};
