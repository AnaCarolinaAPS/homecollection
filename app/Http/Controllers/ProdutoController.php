<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\CategoriaProduto;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_items = Produto::all();
        $all_categorias = CategoriaProduto::where('is_active', true)->get();
        return view('admin.produto.index', compact('all_items', 'all_categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validação dos dados do formulário
            $request->validate([
                'nome' => 'required|string|max:255|unique:produtos',
                'descricao' => 'nullable|string',
                'is_active' => 'nullable|boolean',
                'categoria_id' => 'required|exists:categoria_produtos,id',
                // Adicione outras regras de validação conforme necessário
            ]);

            $request->merge([
                'is_active' => $request->has('is_active') ? $request->is_active : true,
            ]);

            // Criação de um novo registro no banco de dados
            Produto::create([
                'nome' => $request->input('nome'),
                'descricao' => $request->input('descricao'),
                'is_active' => $request->input('is_active'),
                'categoria_id' => $request->input('categoria_id'),
                // Adicione outros campos conforme necessário
            ]);

            // Exibir toastr de sucesso
            return redirect()->back()->with('toastr', [
                'type'    => 'success',
                'message' => 'Produto criado com sucesso!',
                'title'   => 'Sucesso',
            ]);
        } catch (\Exception $e) {
            // Exibir toastr de Erro
            return redirect()->back()->with('toastr', [
                'type'    => 'error',
                'message' => 'Ocorreu um erro ao criar o Produto: <br>'. $e->getMessage(),
                'title'   => 'Erro',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        $produtoWith = Produto::with('categoria')->find($produto->id);
        return response()->json($produtoWith);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        try {
            $request->validate([
                'nome' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('produtos')->ignore($produto->id),
                ],
                'descricao' => 'nullable|string',
                'is_active' => 'required|boolean',
                'categoria_id' => 'required|exists:categoria_produtos,id',
            ]);

            // Atualizar os dados
            $produto->update([
                'nome' => $request->input('nome'),
                'descricao' => $request->input('descricao'),
                'is_active' => $request->input('is_active'),
                'categoria_id' => $request->input('categoria_id'),
                // Adicione outros campos conforme necessário
            ]);

            // Exibir toastr de sucesso
            return redirect()->back()->with('toastr', [
                'type'    => 'success',
                'message' => 'Produto atualizado com sucesso!',
                'title'   => 'Sucesso',
            ]);
        } catch (\Exception $e) {
            // Exibir toastr de Erro
            return redirect()->back()->with('toastr', [
                'type'    => 'error',
                'message' => 'Ocorreu um erro ao atualizar o Produto: <br>'. $e->getMessage(),
                'title'   => 'Erro',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        try {
            // Excluir o registro do banco de dados
            $produto->delete();

            // Redirecionar após a exclusão bem-sucedida
            return redirect()->back()->with('toastr', [
                'type'    => 'success',
                'message' => 'Produto excluído com sucesso!',
                'title'   => 'Sucesso',
            ]);
        } catch (\Exception $e) {
            // Exibir toastr de erro se ocorrer uma exceção
            return redirect()->back()->with('toastr', [
                'type'    => 'error',
                'message' => 'Ocorreu um erro ao excluir o Produto: <br>'. $e->getMessage(),
                'title'   => 'Erro',
            ]);
        }
    }
}
