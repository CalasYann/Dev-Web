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
    Schema::table('places', function (Blueprint $table) {
        $table->integer('affluence')->nullable(); // ou tout autre type que tu préfères
    });
}

public function down()
{
    Schema::table('places', function (Blueprint $table) {
        $table->dropColumn('affluence');
    });
}

};
