<?php
namespace App\Providers;

use App\Repositories\CategoriaRepository;
use App\Repositories\ProductoRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\CategoriaRepositoryInterface;
use App\Repositories\Interfaces\ProductoRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CategoriaRepositoryInterface::class, CategoriaRepository::class);
        $this->app->bind(ProductoRepositoryInterface::class, ProductoRepository::class);
    }
}
