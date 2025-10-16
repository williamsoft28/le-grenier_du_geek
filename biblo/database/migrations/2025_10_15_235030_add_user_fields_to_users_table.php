<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->after('name');  // Prénom
            $table->string('last_name')->after('first_name');  // Nom
            $table->string('filiere')->nullable();  // Filière
            $table->string('niveau_etude')->nullable();  // Niveau d'étude
            $table->string('universite')->nullable();  // Université
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name', 'filiere', 'niveau_etude', 'universite']);
        });
    }
};