<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
        CREATE OR REPLACE VIEW books_by_author AS
        SELECT
                a.nome AS autor_nome,
                l.titulo AS livro_titulo,
                l.editora,
                l.edicao,
                l.AnoPublicacao ,
                l.Preco ,
                GROUP_CONCAT(asu.descricao SEPARATOR ', ') AS assuntos
            FROM
                Livro_Autor la
            JOIN
                Autor a ON la.Autor_CodAu = a.CodAu
            JOIN
                Livro l ON la.Livro_Codl = l.Codl
            LEFT JOIN
                Livro_Assunto las ON l.Codl = las.Livro_Codl
            LEFT JOIN
                Assunto asu ON las.Assunto_CodAs = asu.CodAs
            GROUP BY
                la.Livro_Codl , a.CodAu
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books_by_author');
    }
};