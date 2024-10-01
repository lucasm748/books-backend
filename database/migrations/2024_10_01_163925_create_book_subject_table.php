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
        Schema::create('Livro_Assunto', function (Blueprint $table) {
            $table->string('Livro_Codl');
            $table->string('Assunto_CodAs');

            $table->foreign('Livro_Codl')
                ->references('Codl')
                ->on('Livro')
                ->cascadeOnDelete();

            $table->foreign('Assunto_CodAs')
                ->references('CodAs')
                ->on('Assunto')
                ->cascadeOnDelete();

            $table->index('Livro_Codl')->name('Livro_Assunto_FKIndex1');
            $table->index('Assunto_CodAs')->name('Livro_Assunto_FKIndex2');

            $table->primary(['Livro_Codl', 'Assunto_CodAs']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Livro_Assunto');
    }
};