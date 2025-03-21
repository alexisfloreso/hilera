<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'stock',
        'category_id'
    ];

    protected $hidden = ['category_id'];

    protected $table = 'productos';

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'category_id');
    }
}
