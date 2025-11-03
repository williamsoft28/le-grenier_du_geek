<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('forum_categories', function (Blueprint $table) {
        $table->string('slug')->unique()->after('title'); // Ajoute une colonne slug après title
    });
}

public function down()
{
    Schema::table('forum_categories', function (Blueprint $table) {
        $table->dropColumn('slug');
    });
}

};
