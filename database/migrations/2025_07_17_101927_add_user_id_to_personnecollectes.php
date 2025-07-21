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
        Schema::table('personne_collectes', function (Blueprint $table) {
            Schema::table('personne_collectes', function (Blueprint $table) {
                // 1. Ajout de la colonne
                $table->unsignedBigInteger('user_id')->nullable()->after('id');

                // 2. Création de la contrainte de clé étrangère
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personne_collectes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
