<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaProduto extends Model
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
        // 'hex_color',
        // 'parent_id',
    ];

    // // Relação com a categoria “pai”
    // public function parent()
    // {
    //     return $this->belongsTo(Category::class, 'parent_id');
    // }

    // // Relação com as subcategorias
    // public function children()
    // {
    //     return $this->hasMany(Category::class, 'parent_id');
    // }
}
