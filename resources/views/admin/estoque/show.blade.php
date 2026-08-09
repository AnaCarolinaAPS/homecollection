
@extends('layouts.master')
@section('titulo', 'Estoques | HomeController')

@section('admin')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Estoques</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('estoque.index'); }}">Estoques</a></li>
                            <li class="breadcrumb-item active">{{ $produto->nome; }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Estoques de {{ $produto->nome; }} - {{ $produto->quantidade_em_estoque(); }} Unidades Disponíveis</h4>
                        <button type="button" class="btn btn-success waves-effect waves-light mb-2" data-bs-toggle="modal" data-bs-target="#novoModal">
                            <i class="fas fa-plus"></i> Movimento
                        </button>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered dt-responsive nowrap datatable-default" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Movimento</th>
                                        <th>Quantidade</th>
                                        <th>Vencimento</th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                    @foreach ($produto->movimentos_estoque->sortByDesc('data_movimento')  as $item)
                                    <tr class="abrirModal" data-item-id="{{ $item->id; }}" data-bs-toggle="modal" data-bs-target="#detalhesModal">
                                        <td><h6 class="mb-0">{{ $item->id }}</h6></td>
                                        <td>{{ \Carbon\Carbon::parse($item->data_movimento)->format('d/m/Y') }}</td>
                                        <td>{{ $item->quantidade }}</td>
                                        <td>
                                            {{ $item->vencimento ? \Carbon\Carbon::parse($item->vencimento)->format('d/m/Y') : 'Sem Data Definida' }}
                                        </td>
                                    </tr>
                                    @endforeach
                                     <!-- end -->
                                </tbody><!-- end tbody -->
                            </table> <!-- end table -->
                        </div>
                    </div><!-- end card -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>

    {{-- Modal para NOVOS ITEMS! --}}
    <div class="modal fade" tabindex="-1" aria-labelledby="ModalNovo" aria-hidden="true" style="display: none;" id="novoModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Novo Registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="form-horizontal mt-3" method="POST" action="{{ route('estoque.store') }}">
                    @csrf
                    <div class="modal-body">
                        {{-- ADICIONAR MAIS TARDE OUTROS Atributos --}}
                        <div class="row">
                            <input type="hidden" name="produto_id" value="{{ $produto->id }}">
                            <div class="col">
                                <div class="form-group">
                                    <label for="produto_id">Produto</label>
                                    <input type="text" class="form-control" id="produto" placeholder="Nome do Produto" maxlength="255" value="{{$produto->nome}}" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="nome">Quantidade</label>
                                    <input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="Quantidade do Produto" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="data">Data Movimento</label>
                                    <input class="form-control" type="date" value="{{ \Carbon\Carbon::today()->format('Y-m-d') ; }}" id="data" name="data_movimento">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Adicionar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <!-- Detalhes dos Itens -->
    <div class="modal fade" tabindex="-1" aria-labelledby="detalhesModal" aria-hidden="true" style="display: none;" id="detalhesModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModal">Estoque de {{$produto->nome}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="form-horizontal mt-3" method="POST" id="formAtualizacao" action="">
                    @csrf
                    @method('PUT') <!-- Método HTTP para update -->
                    <div class="modal-body">
                        <input type="hidden" name="id" value="" id="did">                        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="data">Data Movimento</label>
                                    <input class="form-control" type="date" id="ddatamovimento" name="data_movimento">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="nome">Quantidade</label>
                                    <input type="number" class="form-control" id="dquantidade" name="quantidade" placeholder="Quantidade do Produto" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="data">Data Vencimento</label>
                                    <input class="form-control" type="date" id="ddatavencimento" name="vencimento">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- Botão de Exclusão -->
                        <button type="button" class="btn btn-danger ml-auto" data-bs-toggle="modal" data-bs-target="#confirmDelModal">
                            Excluir
                        </button>
                        <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light" form="formAtualizacao">Atualizar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <!-- Modal de Confirmação -->
    <div class="modal fade" id="confirmDelModal" tabindex="-1" role="dialog" aria-labelledby="confirmDelModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmação de Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja excluir este registro?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Fechar</button>
                    <!-- Adicionar o botão de exclusão no modal -->
                    <form method="post" action="" id="formDeleteModal">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page-content -->

<script>
    // JavaScript para abrir o modal ao clicar na linha da tabela
    document.querySelectorAll('.abrirModal').forEach(item => {
        item.addEventListener('click', event => {
            const itemId = event.currentTarget.dataset.itemId;
            const url = "{{ route('estoque.show', ':id') }}".replace(':id', itemId);
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // document.getElementById('tituloModal').innerText = data.produto.nome;
                    document.getElementById('did').value = data.id;
                    document.getElementById('dquantidade').value = data.quantidade;
                    document.getElementById('ddatamovimento').value = data.data_movimento;
                    document.getElementById('ddatavencimento').value = data.vencimento;

                    var formAtualizacao = document.getElementById('formAtualizacao');
                    formAtualizacao.setAttribute('action', "{{ route('estoque.update', ['estoque' => ':id']) }}".replace(':id', data.id));

                    var formDelete = document.getElementById('formDeleteModal');
                    formDelete.setAttribute('action', "{{ route('estoque.destroy', ['estoque' => ':id']) }}".replace(':id', data.id));
                })
                .catch(error => console.error('Erro:', error));
        });
    });
</script>
@endsection
