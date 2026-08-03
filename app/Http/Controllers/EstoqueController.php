<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use Illuminate\Http\Request;
use App\Models\Produto;

class EstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_items = Produto::where('is_active', true)->get();
        return view('admin.estoque.index', compact('all_items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validação dos dados do formulário
            $request->validate([
                'produto_id' => 'required|exists:produtos,id',
                'quantidade' => 'required|numeric',
                'vencimento' => 'nullable|date',
                'data_movimento' => 'required|date',
                // Adicione outras regras de validação conforme necessário
            ]);

            // Criação de um novo registro no banco de dados
            Estoque::create([
                'produto_id' => $request->input('produto_id'),
                'quantidade' => $request->input('quantidade'),
                'vencimento' => $request->input('vencimento'),
                'data_movimento' => $request->input('data_movimento'),
                // Adicione outros campos conforme necessário
            ]);

            // Exibir toastr de sucesso
            return redirect()->back()->with('toastr', [
                'type'    => 'success',
                'message' => 'Estoque criado com sucesso!',
                'title'   => 'Sucesso',
            ]);
        } catch (\Exception $e) {
            // Exibir toastr de Erro
            return redirect()->back()->with('toastr', [
                'type'    => 'error',
                'message' => 'Ocorreu um erro ao criar o Estoque: <br>'. $e->getMessage(),
                'title'   => 'Erro',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function showEstoque($id)
    {
        try {
            $produto = Produto::findOrFail($id);
            // Retornar a view com os detalhes
            return view('admin.estoque.show', compact('produto'));
        } catch (\Exception $e) {
            // Exibir uma mensagem de erro ou redirecionar para uma página de erro
            return redirect()->route('admin.estoque.index')->with('toastr', [
                'type'    => 'error',
                'message' => 'Ocorreu um erro ao exibir os detalhes do Estoque de Produto: <br>'. $e->getMessage(),
                'title'   => 'Erro',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Estoque $estoque)
    {
        // $estoqueWith = Produto::with('categoria')->find($produto->id);
        return response()->json($estoque);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estoque $estoque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estoque $estoque)
    {
        try {
            $request->validate([
                // 'produto_id' => 'required|exists:produtos,id',
                'quantidade' => 'required|numeric',
                'data_movimento' => 'required|date',
                'vencimento' => 'nullable|date',
            ]);

            // Atualizar os dados
            $estoque->update([
                // 'produto_id' => $request->input('produto_id'),
                'quantidade' => $request->input('quantidade'),
                'vencimento' => $request->input('vencimento'),
                'data_movimento' => $request->input('data_movimento'),
                // Adicione outros campos conforme necessário
            ]);

            // Exibir toastr de sucesso
            return redirect()->back()->with('toastr', [
                'type'    => 'success',
                'message' => 'Estoque atualizado com sucesso!',
                'title'   => 'Sucesso',
            ]);
        } catch (\Exception $e) {
            // Exibir toastr de Erro
            return redirect()->back()->with('toastr', [
                'type'    => 'error',
                'message' => 'Ocorreu um erro ao atualizar o Estoque: <br>'. $e->getMessage(),
                'title'   => 'Erro',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estoque $estoque)
    {
        try {
            // Excluir o registro do banco de dados
            $estoque->delete();

            // Redirecionar após a exclusão bem-sucedida
            return redirect()->back()->with('toastr', [
                'type'    => 'success',
                'message' => 'Movimento excluído com sucesso!',
                'title'   => 'Sucesso',
            ]);
        } catch (\Exception $e) {
            // Exibir toastr de erro se ocorrer uma exceção
            return redirect()->back()->with('toastr', [
                'type'    => 'error',
                'message' => 'Ocorreu um erro ao excluir o Movimento: <br>'. $e->getMessage(),
                'title'   => 'Erro',
            ]);
        }
    }
}
