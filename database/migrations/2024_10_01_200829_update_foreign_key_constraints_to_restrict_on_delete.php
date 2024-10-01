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
        Schema::table('Livro_Autor', function (Blueprint $table) {
            $table->dropForeign(['Livro_Codl']);
            $table->dropForeign(['Autor_CodAu']);

            $table->foreign('Livro_Codl')
                ->references('Codl')
                ->on('Livro')
                ->cascadeOnDelete();

            $table->foreign('Autor_CodAu')
                ->references('CodAu')
                ->on('Autor')
                ->restrictOnDelete();
        });

        Schema::table('Livro_Assunto', function (Blueprint $table) {
            $table->dropForeign(['Livro_Codl']);
            $table->dropForeign(['Assunto_CodAs']);

            $table->foreign('Livro_Codl')
                ->references('Codl')
                ->on('Livro')
                ->cascadeOnDelete();

            $table->foreign('Assunto_CodAs')
                ->references('CodAs')
                ->on('Assunto')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Livro_Autor', function (Blueprint $table) {
            $table->dropForeign(['Livro_Codl']);
            $table->dropForeign(['Autor_CodAu']);

            $table->foreign('Livro_Codl')
                ->references('Codl')
                ->on('Livro')
                ->cascadeOnDelete();

            $table->foreign('Autor_CodAu')
                ->references('CodAu')
                ->on('Autor')
                ->cascadeOnDelete();
        });

        Schema::table('Livro_Assunto', function (Blueprint $table) {
            $table->dropForeign(['Livro_Codl']);
            $table->dropForeign(['Assunto_CodAs']);

            $table->foreign('Livro_Codl')
                ->references('Codl')
                ->on('Livro')
                ->cascadeOnDelete();

            $table->foreign('Assunto_CodAs')
                ->references('CodAs')
                ->on('Assunto')
                ->cascadeOnDelete();
        });
    }
};