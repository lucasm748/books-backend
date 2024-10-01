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
        Schema::table('authors', function (Blueprint $table) {
            $table->renameColumn('id', 'CodAu');
            $table->renameColumn('name', 'Nome');

            $table->string('Nome', 40)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('authors', function (Blueprint $table) {
            $table->renameColumn('CodAu', 'id');
            $table->renameColumn('Nome', 'name');

            $table->string('name', 255)->change();
        });
    }
};