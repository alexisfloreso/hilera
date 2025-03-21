<?php
namespace App\Repositories;

use App\Models\Producto;
use App\Repositories\Interfaces\ProductoRepositoryInterface;

class ProductoRepository implements ProductoRepositoryInterface
{

    public function __construct()
    {

    }

    public function getAll()
    {
        return Producto::with('categoria')->get();
    }

    // public function getById($id)
    // {
    //     return $this->model->find($id);
    // }

    public function create(array $producto)
    {
    
        $productoCreado = Producto::create($producto);

        return Producto::with('categoria')->find($productoCreado->id);
        
    }

    public function update($id, array $data)
    {
        $producto = Producto::find($id);
        if ($producto) {
            $producto->update($data);
            return $producto;
        }
         
        return null;
    }

    public function delete($id)
    {
        $producto = Producto::find($id);
        if ($producto) {
            $producto->delete();
            return true;
        }
        return false;
    }
}