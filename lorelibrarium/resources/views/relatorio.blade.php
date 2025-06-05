<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Relatório de Livros</title>
  <style>
    body { font-family: Arial, sans-serif; font-size: 14px; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { border: 1px solid #ccc; padding: 5px; text-align: left; }
    th { background-color: #f2f2f2; }
    h1 { text-align: center; margin-bottom: 20px; }
  </style>
</head>
<body>
  <h1>Relatório de Livros</h1>
  <table>
    <thead>
      <tr>
        <th>Título</th>
        <th>Editora</th>
        <th>Edição</th>
        <th>Publicação</th>
        <th>Assuntos</th>
        <th>Autores</th>
        <th>Preço</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($data as $linha)
        <tr>
          <td>{{ $linha->Titulo }}</td>
          <td>{{ $linha->Editora }}</td>
          <td>{{ $linha->Edicao }}</td>
          <td>{{ $linha->AnoPublicacao }}</td>
          <td>{{ $linha->assuntos }}</td>
          <td>{{ $linha->autores }}</td>
          <td>{{ $linha->Preco }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>
