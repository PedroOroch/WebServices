<html>
    <head>
        <title>
            Lista de Clientes
        </title>
    </head>
    <body>
        <table border="1px">
            <td>id</td>
            <td>nome</td>
            <td>idade</td>
            @foreach($clientes as $cliente)
            <tr>
                <td>{{$cliente -> id}}</td>
                <td>{{$cliente -> nome}}</td>
                <td>{{$cliente -> idade}}</td>
            </tr>
            @endforeach
        </table>
    </body>
</html>