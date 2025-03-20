<?php
namespace App\Providers;

use App\Repositories\CategoriaRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\CategoriaRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CategoriaRepositoryInterface::class, CategoriaRepository::class);
    }
}
