<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
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
        <div class="form">
            <div>Titulo:</div>
            <div><input class="form-control" name="titulo" id="titulo" type="text" value="{{ $livro->titulo }}"></div>
        </div>
        <div>
            <div>ISBN:</div>
            <div><input class="form-control" name="isbn" id="isbn" type="text" value="{{ $livro->isbn }}"></div>
        </div>
        <div>
            <div>Nome do Autor:</div>
            <div><input class="form-control" name="nome_autor" id="nome_autor" type="text" value="{{ $livro->nome_autor }}"></div>
        </div>
        <div>
            <div>Ano de Lancamento:</div>
            <div><input class="form-control" name="ano_lancamento" id="ano_lancamento" type="number" value="{{ $livro->ano_lancamento }}"></div>
        </div>
        <br>
        <button class="btn btn-primary" onclick="enviar({{ $livro->id }})">Enviar</button>
    </div>
    <script>
        function enviar(id){
            let livro = {
                titulo: document.getElementById('titulo').value,
                isbn: document.getElementById('isbn').value,
                nome_autor: document.getElementById('nome_autor').value,
                ano_lancamento: document.getElementById('ano_lancamento').value,
                id: id
            }
            if ( livro.titulo == '' || livro.isbn == '' || livro.nome_autor == '' || livro.ano_lancamento == '' ){
                alert('Preencha todos os campos!')
                return;
            }
            if ( livro.isbn.length > 11 ){
                alert('Limite de 11 caracteres no campo: ISBN')
                return;
            }
            let url = `/livros/${id}`
            fetch(url, {
                method: 'put',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify(livro)
            }).then(res => {
                if (res.ok){
                    return res.text().then(msg => {
                        alert(msg)
                        window.open('/livros', '_self')
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

    </script>
    
</body>
</html>