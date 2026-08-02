<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CategoriaProduto;

class CategoriaProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Adiciona Categorias
        CategoriaProduto::insert([
            [
                'nome' => 'Mercearia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Bebidas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Padaria e Doces',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Proteínas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Hortifruti',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Higiene',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Limpeza',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Pets',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Cosméticos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
