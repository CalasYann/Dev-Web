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
        Schema::create('object_cos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->enum('status', ['en marche', 'éteint', 'Maintenance'])->default('éteint');
            $table->string('location');
            $table->float('consommation_par_heure')->default(0);
            $table->integer('temps_total_allume')->default(0);
            $table->integer('temps_depuis_dernier_allumage')->default(0);
            $table->timestamp('last_status_changed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('object_cos');
    }
};
