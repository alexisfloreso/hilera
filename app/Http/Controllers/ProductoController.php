<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\ProductoRepositoryInterface;
use Illuminate\Http\Response;

class ProductoController extends Controller
{

    protected $productoRepository;

    public function __construct(ProductoRepositoryInterface $productoRepository)
    {
        $this->productoRepository = $productoRepository;   
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $productos = $this->productoRepository->getAll();

        return response()->json([
            'success' => true, 
            'data' => $productos,
        ], Response::HTTP_OK);
    }
    

    /** 
     * Crea un nuevo registro para los productos
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function store(Request $request){

        $productoData = $request->validate([
            'nombre' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s]+$/',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|integer|exists:categorias,id',
        ]);

        $producto = $this->productoRepository->create($productoData);


        return response()->json([
            'message' => 'El producto se ha creado correctamente', 
            'data' => $producto
        ], Response::HTTP_CREATED);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $productoData = $request->validate([
            // 'nombre' => 'required|string|alpha_num|max:255',
            'stock' => 'required|integer|min:0',
            // 'category_id' => 'required|integer|exists:categorias,id',
        ]);

        $producto = $this->productoRepository->update($id,$productoData);

        if( $producto ){

            return response()->json([
                'message' => 'El producto se ha actualizado correctamente', 
                'data' => $producto
            ], Response::HTTP_CREATED);

        }

        return response()->json([
            'message' => 'El producto no se ha encontrado'
        ], Response::HTTP_NOT_FOUND);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $productoEliminado = $this->productoRepository->delete($id);

        if( $productoEliminado )
            return response()->noContent();

        return response()->json([
            'message' => 'El producto no se ha encontrado'
        ], Response::HTTP_NOT_FOUND);

    }
}
