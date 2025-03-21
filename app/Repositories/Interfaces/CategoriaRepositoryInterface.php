<?php

namespace App\Repositories\Interfaces;

interface CategoriaRepositoryInterface
{
    public function getAll();
    public function create(array $data);
}