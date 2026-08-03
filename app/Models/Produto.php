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

    // Relação com Estoque
    public function movimentos_estoque()
    {
        return $this->hasMany(Estoque::class, 'produto_id');
    }

    //Para resgatar as quantidades
    public function quantidade_em_estoque()
    {
        return $this->movimentos_estoque->sum('quantidade');
    }
}
