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
        Schema::create('Livro_Autor', function (Blueprint $table) {
            $table->string('Livro_Codl');
            $table->string('Autor_CodAu');

            $table->foreign('Livro_Codl')
                ->references('Codl')
                ->on('Livro')
                ->cascadeOnDelete();

            $table->foreign('Autor_CodAu')
                ->references('CodAu')
                ->on('Autor')
                ->cascadeOnDelete();

            $table->index('Livro_Codl')->name('Livro_Autor_FKIndex1');
            $table->index('Autor_CodAu')->name('Livro_Autor_FKIndex2');

            $table->primary(['Livro_Codl', 'Autor_CodAu']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Livro_Autor');
    }
};