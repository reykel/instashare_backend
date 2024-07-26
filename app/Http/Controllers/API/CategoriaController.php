<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Resources\CategoriaResource;
use App\Http\Resources\CategoriaListResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\Categoria\CategoriaStoreRequest;
use App\Http\Requests\Categoria\CategoriaUpdateRequest;
use App\Traits\HasToAvoidCacheLeaking;

class CategoriaController extends Controller
{
    use HasToAvoidCacheLeaking;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'categorias' => CategoriaResource::collection(
                Cache::remember('categorias', 86400, function(){
                    return Categoria::all();
                })
            ),
            'message' => 'Retrieved Successfully'
        ], 200 );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriaStoreRequest $request)
    {
        $validated = $request->validated();

        $categoria = Categoria::create($validated);

        return response([
            'categoria' => new CategoriaResource($categoria),
            'message' => 'Created Successfully'
        ], 200 );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        return response([
            'categoria' => new CategoriaResource($categoria),
            'message' => 'Retrieved Successfully'
        ], 200 );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriaUpdateRequest $request, Categoria $categoria)
    {
        $categoria->update($request->all());

        return response([
            'categoria' => new CategoriaResource($categoria),
            'message' => 'Retrieved Successfully'
        ], 200 );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        $this->clearListingCache();
        return response (['message' => 'Deleted Successfully'], 200);
    }

    public function list()
    {
        return response(
            CategoriaListResource::collection(
                Categoria::all()
            ), 200 );
    }
}
