<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar</title>
</head>
<body>
    <div>
        <p>Resultado do Processamento</p>
        <p>
            <b>
                Código de retorno: {{ $categorias->status }}
            </b>
        </p>
        <p>
            <b>
                Mensagem: {{ $categorias->mensagem }}
            </b>
        </p>
    </div>
   <table>
        <tr>
            <th>Id</th>
            <th>Nome</th>
        </tr>
        @foreach($categorias->categorias as $categoria)
        <tr>
            <td>{{ $categoria->id }}</td>
            <td>{{ $categoria->nome_da_categoria }}</td>
        </tr>
        @endforeach
   </table>
</body>
</html>