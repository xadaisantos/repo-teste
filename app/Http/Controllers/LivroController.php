<?php

namespace App\Http\Controllers;

use App\Livro;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $livros = Livro::get();
        $params = compact('livros');
        return view('index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $livro = $request->all();
            if ( empty($livro['titulo']) || empty($livro['isbn']) || empty($livro['nome_autor']) || empty($livro['ano_lancamento']) ){
                throw new \Exception('Preencha todos os campos!');
            }
            $livro = Livro::create($request->all());
            if ( !$livro ){
                throw new \Exception('Ocorreu um erro na criação do livro.');
            } else {
                return response('Livro salvo com sucesso.', 200);
            }
        } catch (\Exception $ex) {
            return response($ex->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function show(Livro $livro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            if ( !Livro::where('id', $id)->exists() ){
                throw new \Exception('Livro selecionado não existe.');
            }
            $livro = Livro::find($id);
            $params = compact('livro');
            return view('edit', $params);
        } catch (\Exception $ex) {
            return response($ex->getMessage(), 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            if ( !Livro::where('id', $id)->exists() ){
                throw new \Exception('Livro selecionado não existe.');
            }
            $livro = $request->all();
            if ( empty($livro['titulo']) || empty($livro['isbn']) || empty($livro['nome_autor']) || empty($livro['ano_lancamento']) ){
                throw new \Exception('Preencha todos os campos!');
            }
            if ( !Livro::where('id', $id)->first()->update($livro) ){
                throw new \Exception('Ocorreu um erro ao tentar editar o livro.');
            }
            return response('Livro editado com sucesso.', 200);
        } catch (\Exception $ex) {
            return response($ex->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if ( !Livro::where('id', $id)->exists() ){
                throw new \Exception('Livro selecionado não existe.');
            }
            if ( !Livro::where('id', $id)->first()->delete() ){
                throw new \Exception('Ocorreu um erro ao tentar excluir o livro.');
            }
            return response('Livro excluído com sucesso.', 200);

        } catch (\Exception $ex) {
            return response($ex->getMessage(), 400);
        }
    }
}
