<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arquivo = Storage::disk('local')->exists('registros.json');
        if ($arquivo) {
            $arquivo = file_get_contents(storage_path('app/registros.json'));
            $json = json_decode($arquivo);
            return view('site.index', ['contatos' => $json]);
        }
        return view('site.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('site.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:60',
            'email' => 'required|max:60',
        ]);
        $this->prepareFilds($request);
        return redirect()->route('home')->with('created', 'Registro cadastrado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $arquivo = file_get_contents(storage_path('app/registros.json'));
        $array = json_decode($arquivo, true);
        $collection = collect($array)->whereIn('id', $id);
        $keyed = $collection->mapWithKeys(function ($item) {
            return ['id' => $item['id'], 'name' => $item['name'], 'email' => $item['email']];
        });
        $contato = (object)$keyed->all();
        return view('site.edit', compact('contato'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $arquivo = file_get_contents(storage_path('app/registros.json'));
        $array = collect(json_decode($arquivo, true));
        $input = $array->map(function ($registro, $key) use ($request, $id) {
            if ($registro['id'] == $id) {
                $registro['id'] = $request->id;
                $registro['name'] = $request->name;
                $registro['email'] = $request->email;
            }
            return $registro;
        });
        $dados_json = json_encode($input);
        Storage::put('registros.json', $dados_json);
        return redirect()->back()->with('updated', 'Registro atualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $arquivo = file_get_contents(storage_path('app/registros.json'));
        $array = json_decode($arquivo, true);
        $collection = collect($array);
        $filtered = $collection->whereNotIn('id', $id);
        $dados_json = json_encode($filtered->all());
        Storage::put('registros.json', $dados_json);
        return redirect()->back()->with('removed', 'Registro removido');
    }

    private function prepareFilds(Request $request)
    {
        if (!Storage::disk('local')->exists('registros.json')) {
            $array = [];
            $collection = collect($array)->push([
                'id' => 1,
                'name' => $request->name,
                'email' => $request->email,
            ]);
            $dados_json = json_encode($collection);
            Storage::put('registros.json', $dados_json);
        } else {
            $arquivo = file_get_contents(storage_path('app/registros.json'));
            $novoArray = json_decode($arquivo, true);
            $ordem = array_column($novoArray, 'id');
            $id = array_pop($ordem) + 1;
            $collection = collect($novoArray)->push([
                'id' => $id,
                'name' => $request->name,
                'email' => $request->email,
            ]);
            $dados_json = json_encode($collection);
            Storage::put('registros.json', $dados_json);
        }
    }
}
