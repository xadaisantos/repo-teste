<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros</title>

</head>
<body>

    <h1>LIVROS</h1>
    <br>
    <div>
        <div>
            <button onclick="window.open('/livros', '_self')">Ver Todos</button>
            <button onclick="window.open('/livros/create', '_self')">Criar Livro</button>
        </div>
        <br>
        <div>
            <div>Titulo:</div>
            <div><input name="titulo" id="titulo" type="text"></div>
        </div>
        <div>
            <div>ISBN:</div>
            <div><input name="isbn" id="isbn" type="text"></div>
        </div>
        <div>
            <div>Nome do Autor:</div>
            <div><input name="nome_autor" id="nome_autor" type="text"></div>
        </div>
        <div>
            <div>Ano de Lancamento:</div>
            <div><input name="ano_lancamento" id="ano_lancamento" type="number"></div>
        </div>
        <br>
        <button onclick="enviar()">Enviar</button>
    </div>
    <script>
        function enviar(){
            let livro = {
                titulo: document.getElementById('titulo').value,
                isbn: document.getElementById('isbn').value,
                nome_autor: document.getElementById('nome_autor').value,
                ano_lancamento: document.getElementById('ano_lancamento').value
            }
            if ( livro.titulo == '' || livro.isbn == '' || livro.nome_autor == '' || livro.ano_lancamento == '' ){
                alert('Preencha todos os campos!')
                return;
            }
            if ( livro.isbn.length > 11 ){
                alert('Limite de 11 caracteres no campo: ISBN')
                return;
            }
            let url = '/livros';
            fetch(url, {
                method: 'post',
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