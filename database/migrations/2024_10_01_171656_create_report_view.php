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
            CREATE VIEW report_view AS
                SELECT
                    l.Codl AS Codigo,
                    l.Titulo,
                    l.Editora,
                    l.Edicao,
                    l.AnoPublicacao,
                    l.Preco,
                    (SELECT GROUP_CONCAT(a.Nome SEPARATOR ', ')
                    FROM Livro_Autor la
                    INNER JOIN Autor a ON a.CodAu = la.Autor_CodAu
                    WHERE la.Livro_Codl = l.Codl
                    ) AS autores,
                    (SELECT GROUP_CONCAT(ass.Descricao SEPARATOR ', ')
                    FROM Livro_Assunto ls
                    INNER JOIN Assunto ass ON ass.CodAs = ls.Assunto_CodAs
                    WHERE ls.Livro_Codl = l.Codl
                    ) AS assuntos
                FROM
                    Livro l
                GROUP BY
                    l.Codl, l.Titulo, l.Editora, l.Edicao, l.AnoPublicacao, l.Preco;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW report_view");
    }
};