<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'produto_id',
        'quantidade',
        'vencimento',
        'data_movimento',
        'descricao_produto',
    ];

    // Relação com o Produto 
    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}
