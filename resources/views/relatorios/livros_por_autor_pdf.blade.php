<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Livros por Autor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Relatório de Livros por Autor</h2>

    <table>
        <thead>
            <tr>
                <th>Autor</th>
                <th>Título do Livro</th>
                <th>Editora</th>
                <th>Ano de Publicação</th>
                <th>Assunto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dados as $dado)
                <tr>
                    <td>{{ $dado->autor_nome }}</td>
                    <td>{{ $dado->titulo }}</td>
                    <td>{{ $dado->editora }}</td>
                    <td>{{ $dado->ano_publicacao }}</td>
                    <td>{{ $dado->assunto_descricao }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
