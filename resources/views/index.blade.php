<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Livros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        .uppercase { text-transform: uppercase; }
        table {
            border-collapse: collapse;
        }
        table td, table tr, table th {
            border: 1px solid black;
            padding: 5px 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>LIVROS</h1>
        <br>
        <div>
            <button class="btn btn-info" onclick="window.open('/livros', '_self')">Ver Todos</button>
            <button class="btn btn-info" onclick="window.open('/livros/create', '_self')">Criar Livro</button>
        </div>
        <br>
        <table class="table table-hover uppercase">
            <thead>
                <tr>
                    <th>titulo</th>
                    <th>isbn</th>
                    <th>nome do autor</th>
                    <th>lancamento</th>
                    <th>opções</th>
                </tr>
            </thead>
            <tbody>
                @forelse($livros as $l)
                <tr>
                    <td>{{ $l->titulo }}</td>
                    <td>{{ $l->isbn }}</td>
                    <td>{{ $l->nome_autor }}</td>
                    <td>{{ $l->ano_lancamento }}</td>
                    <td>
                        <button class="uppercase btn btn-warning" onclick="editar({{ $l->id }})">editar</button>
                        <button class="uppercase btn btn-danger" onclick="excluir({{ $l->id }})">deletar</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">Nada</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        function excluir(id){
            if (!confirm('Tem certeza que deseja excluir o livro?')){
                return;
            }
            let url = `/livros/${id}`
            fetch(url, {
                method: 'delete',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            }).then(res => {
                if (res.ok){
                    return res.text().then(msg => {
                        alert(msg)
                        location.reload()
                    });
                } else {
                    return res.text().then(msg => {
                        throw new Exception(msg);
                    });
                }
            }).catch(err => {
                alert(err)
            })
        }

        function editar(id){
            window.open(`/livros/${id}/edit`, '_self')
        }
    </script>

</body>
</html>