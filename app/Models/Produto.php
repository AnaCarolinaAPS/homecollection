<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'descricao',
        'is_active',
        'categoria_id',
    ];

    // Relação com a categoria 
    public function categoria()
    {
        return $this->belongsTo(CategoriaProduto::class, 'categoria_id');
    }
}
