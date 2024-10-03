<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" defer>
  <link rel="stylesheet" href="{{ base_path('public/css/relatorio.css') }}">
  <title>
    Relatório De Livros
  </title>
</head>

<body>

  <div class="divHeader">
    <div class="titleRelatorio">
      Relatório de Livros
    </div>

    <div class="periodoRelatorio">
      <b>Data:</b> {{ date('d/m/Y') }}
    </div>
  </div>

  <hr />

  @foreach($report as $autor => $livros)

  <div>
    <b class="title">Autor:</b> {{ $autor }}<br />
  </div>

  <div>
    <table class="reports">
      <thead>
        <tr>
          <th>Título</th>
          <th>Editora</th>
          <th>Edição</th>
          <th>Ano de Publicação</th>
          <th>Valor</th>
          <th>Assuntos</th>
        </tr>
      </thead>

      @foreach($livros as $livro)
      <tr>
        <td>{{ $livro['livro_titulo'] }}</td>
        <td>{{ $livro['editora'] }}</td>
        <td>{{ $livro['edicao'] }}</td>
        <td>{{ $livro['AnoPublicacao'] }}</td>
        <td>{{ $livro['Preco'] }}</td>
        <td>{{ $livro['assuntos'] }}</td>
      </tr>
      @endforeach
    </table>
  </div>

  <br />

  @endforeach