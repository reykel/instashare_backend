<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Resources\ProductoResource;
use App\Http\Resources\ProductoListResource;
use App\Http\Resources\PreciosResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\Producto\ProductoStoreRequest;
use App\Http\Requests\Producto\ProductoUpdateRequest;
use App\Traits\HasToAvoidCacheLeaking;

class ProductosController extends Controller
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
            'productos' => ProductoResource::collection(
                Cache::remember('productos', 86400, function(){
                    return Producto::all();
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
    public function store(ProductoStoreRequest $request)
    {
        $validated = $request->validated();

        $producto = Producto::create($validated);

        return response([
            'producto' => new ProductoResource($producto),
            'message' => 'Created Successfully'
        ], 200 );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CEO  $ceo
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        return response([
            'producto' => new ProductoResource($producto),
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
    public function update(ProductoUpdateRequest $request, Producto $producto)
    {
        $producto->update($request->all());

        return response([
            'producto' => new ProductoResource($producto),
            'message' => 'Retrieved Successfully'
        ], 200 );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        $this->clearListingCache();
        return response (['message' => 'Deleted Successfully'], 200);
    }

    public function list()
    {
        return response(
            ProductoListResource::collection(
                Producto::all()
            ), 200 );
    }

    public function precios($id)
    {
        $precios = Producto::find($id);
        return response($precios->precio, 200 );
    }
}
