<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProduto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoriaProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_categories = CategoriaProduto::all();
        return view('admin.categoriaProduto.index', compact('all_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validação dos dados do formulário
            $request->validate([
                'nome' => 'required|string|max:255|unique:categoria_produtos',
                'descricao' => 'nullable|string',
                'is_active' => 'nullable|boolean',
                // Adicione outras regras de validação conforme necessário
            ]);

            $request->merge([
                'is_active' => $request->has('is_active') ? $request->is_active : true,
            ]);

            // Criação de um novo registro no banco de dados
            CategoriaProduto::create([
                'nome' => $request->input('nome'),
                'descricao' => $request->input('descricao'),
                'is_active' => $request->input('is_active'),
                // Adicione outros campos conforme necessário
            ]);

            // Exibir toastr de sucesso
            return redirect()->back()->with('toastr', [
                'type'    => 'success',
                'message' => 'Categoria criada com sucesso!',
                'title'   => 'Sucesso',
            ]);
        } catch (\Exception $e) {
            // Exibir toastr de Erro
            return redirect()->back()->with('toastr', [
                'type'    => 'error',
                'message' => 'Ocorreu um erro ao criar a Categoria: <br>'. $e->getMessage(),
                'title'   => 'Erro',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoriaProduto $categoriaProduto)
    {
        return response()->json($categoriaProduto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoriaProduto $categoriaProduto)
    {
        try {
            $request->validate([
                'nome' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('categoria_produtos')->ignore($categoriaProduto->id),
                ],
                'descricao' => 'nullable|string',
                'is_active' => 'required|boolean',
            ]);

            // Atualizar os dados
            $categoriaProduto->update([
                'nome' => $request->input('nome'),
                'descricao' => $request->input('descricao'),
                'is_active' => $request->input('is_active'),
                // Adicione outros campos conforme necessário
            ]);

            // Exibir toastr de sucesso
            return redirect()->back()->with('toastr', [
                'type'    => 'success',
                'message' => 'Categoria atualizada com sucesso!',
                'title'   => 'Sucesso',
            ]);
        } catch (\Exception $e) {
            // Exibir toastr de Erro
            return redirect()->back()->with('toastr', [
                'type'    => 'error',
                'message' => 'Ocorreu um erro ao atualizar a Categoria: <br>'. $e->getMessage(),
                'title'   => 'Erro',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoriaProduto $categoriaProduto)
    {
        try {
            // Excluir o registro do banco de dados
            $categoriaProduto->delete();

            // Redirecionar após a exclusão bem-sucedida
            return redirect()->back()->with('toastr', [
                'type'    => 'success',
                'message' => 'Categoria excluída com sucesso!',
                'title'   => 'Sucesso',
            ]);
        } catch (\Exception $e) {
            // Exibir toastr de erro se ocorrer uma exceção
            return redirect()->back()->with('toastr', [
                'type'    => 'error',
                'message' => 'Ocorreu um erro ao excluir a Categoria: <br>'. $e->getMessage(),
                'title'   => 'Erro',
            ]);
        }
    }
}
