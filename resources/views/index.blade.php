<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Livros</title>

</head>
<body>

    <h1>LIVROS</h1>
    <br>
    <div>
        <button onclick="window.open('/livros', '_self')">Ver Todos</button>
        <button onclick="window.open('/livros/create', '_self')">Criar Livro</button>
    </div>
    <br>
    <table>
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
                    <button onclick="editar({{ $l->id }})">editar</button>
                    <button onclick="excluir({{ $l->id }})">deletar</button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">Nada</td>
            </tr>
            @endforelse
        </tbody>
    </table>

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