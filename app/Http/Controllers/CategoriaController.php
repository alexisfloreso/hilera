<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\CategoriaRepositoryInterface;
use Illuminate\Http\Response;

class CategoriaController extends Controller
{

    protected $categoriaRepository;

    public function __construct(CategoriaRepositoryInterface $categoriaRepository)
    {
        $this->categoriaRepository = $categoriaRepository;   
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = $this->categoriaRepository->getAll();


        return response()->json([
            'status' => Response::HTTP_OK,
            'success' => true, 
            'data' => $categorias
        ], Response::HTTP_OK);
    }
    
    /** 
     * Crea un nuevo registro para las categorias
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function store(Request $request){

        $categoriaData = $request->validate([
            'nombre' => 'required|string|alpha|max:255'
        ]);

        $categoria = $this->categoriaRepository->create($categoriaData);


        return response()->json([
            'status' => Response::HTTP_CREATED,
            'message' => 'La categoría se ha creado correctamente', 
            'data' => $categoria
        ], Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(['msg'=>'ok']);
    }
 
}
