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
    Schema::create('projets', function (Blueprint $table) {
        $table->id('id_projet');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->string('titre');
        $table->text('description');
        $table->string('image')->nullable();
        $table->string('lien_demo')->nullable();
        $table->string('lien_github')->nullable();
        $table->timestamps();
        $table->date('date_realisation');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projets');
    }
};
