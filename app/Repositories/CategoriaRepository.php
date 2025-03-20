<?php
namespace App\Repositories;

use App\DTO\UserDTO;
use App\Models\Categoria;
use App\Repositories\Interfaces\CategoriaRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CategoriaRepository implements CategoriaRepositoryInterface
{

    public function __construct()
    {

    }

    public function getAll()
    {
        return Categoria::all();
    }

    // public function getById($id)
    // {
    //     return $this->model->find($id);
    // }

    public function create(array $categoria)
    {
    
        return Categoria::create($categoria);
    }

//     public function update($id, array $data)
//     {
//         $article = $this->model->find($id);
//         if ($article) {
//             $article->update($data);
//             return $article;
//         }
//         return null;
//     }

//     public function delete($id)
//     {
//         $article = $this->model->find($id);
//         if ($article) {
//             $article->delete();
//             return true;
//         }
//         return false;
//     }
}