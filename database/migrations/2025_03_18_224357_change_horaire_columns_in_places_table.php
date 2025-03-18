<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('places', function (Blueprint $table) {
            $table->dropColumn('horaire_ouverture');
            $table->dropColumn('horaire_fermeture');
        });

        Schema::table('places', function (Blueprint $table) {
            $table->time('horaire_ouverture')->nullable();
            $table->time('horaire_fermeture')->nullable();
        });
    }

    public function down()
    {
        Schema::table('places', function (Blueprint $table) {
            $table->dropColumn('horaire_ouverture');
            $table->dropColumn('horaire_fermeture');
        });

        Schema::table('places', function (Blueprint $table) {
            $table->dateTime('horaire_ouverture')->nullable();
            $table->dateTime('horaire_fermeture')->nullable();
        });
    }
};
