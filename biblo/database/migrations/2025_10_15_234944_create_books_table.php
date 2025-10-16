<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->text('description');
            $table->string('file_path');  // Chemin vers PDF/ePub
            $table->string('niveau_etude')->nullable();  // Niveau pour recherche
            $table->string('module')->nullable();  // Module pour recherche
            $table->text('tutoriel')->nullable();  // Tutoriel associé
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
};