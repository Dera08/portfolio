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
        Schema::create('experiences', function (Blueprint $table) {
           $table->id('id_experience');
           $table->string('entreprise');
           $table->string('poste_ou_diplome');
           $table->date('date_fin')->nullable();
           $table->text('description');
           $table->date('date_debut');
           $table->timestamps(); 
         $table->foreignId('user_id')->constrained('users')->onDelete('cascade');   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
