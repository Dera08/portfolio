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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id('id_contact');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('email_expediteur')->nullable();
            $table-> string('sujet');
             $table->text('message');
            $table->date('date_envoie')->nullable();
            $table->string('notification')->nullable();
            $table->boolean('lu')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
