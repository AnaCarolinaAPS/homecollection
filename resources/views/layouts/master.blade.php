<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('titulo', 'Controle de Gastos')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Controle de Gastos" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

        <!-- MetisMenu -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.7/metisMenu.min.css">

        <!-- Simplebar -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@5.3.6/dist/simplebar.min.css">

        <!-- Remix Icons -->
        <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">

        <!-- Node-waves para efeito de onde (ripple) -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.css">
        
        <!-- DataTables -->
        <link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.dataTables.min.css">

        {{-- TOASTR --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        {{-- Selectpicker --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

        <!-- Bootstrap Css -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <!-- Icons Css -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])     
    </head>

    <body data-topbar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">

            @include('layouts.body.header')

            <!-- ========== Left Sidebar Start ========== -->
            @include('layouts.body.sidebar')
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                @yield('admin')

                @include('layouts.body.footer')

            </div>
            <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->

        <!-- jQuery (PRECISA vir primeiro se usar plugins antigos) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <!-- Bootstrap 5 (SEM Bootstrap 4) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

        <!-- MetisMenu -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.7/metisMenu.min.js"></script>

        <!-- Simplebar -->
        <script src="https://cdn.jsdelivr.net/npm/simplebar@5.3.6/dist/simplebar.min.js"></script>

        <!-- Waves -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js"></script>

        <!-- DataTables -->
        <script src="https://cdn.datatables.net/2.3.8/js/dataTables.min.js"></script>

        <!-- Toastr -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <!-- Bootstrap-select (⚠️ cuidado versão antiga) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

        <!-- App -->
        <script src="{{ asset('assets/js/app.js') }}"></script>

        <script src="{{ asset('assets/js/app.js') }}"></script>

        <!-- Adicione o script JavaScript para exibir os toasts -->
        <script>
            @if(Session::has('toastr'))
                var toastrData = {!! json_encode(Session::get('toastr')) !!};
                // Defina a opção showMethod como 'slideDown'
                toastr.options.showMethod = 'slideDown';
                toastr.options.progressBar = true;
                toastr[toastrData.type](toastrData.message, toastrData.title);
            @endif

            let table = new DataTable('#myTable');

            // To style all selects
            $('select').selectpicker();

            $(document).ready(function () {
                function dataTableBaseConfig() {
                    return {
                        lengthChange: false,
                        language: {
                            paginate: {
                                previous: "<i class='mdi mdi-chevron-left'>",
                                next: "<i class='mdi mdi-chevron-right'>"
                            }
                        },
                        drawCallback: function () {
                            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
                        },
                        buttons: ["copy", "excel", "pdf", "colvis"]
                    };
                }

                function inicializarDataTable($table, customConfig = {}) {
                    let config = $.extend(true, {}, dataTableBaseConfig(), customConfig);
                    let dataTable = $table.DataTable(config);

                    dataTable.buttons().container().appendTo($table.closest('.dataTables_wrapper').find('.col-md-6:eq(0)'));
                    $(".dataTables_length select").addClass("form-select form-select-sm");
                }

                // Padrão
                $(".datatable-default").each(function () {
                    inicializarDataTable($(this));
                });

                // Com ordenação por data (desc) e ocultar coluna 0
                $(".datatable-date").each(function () {
                    inicializarDataTable($(this), {
                        columnDefs: [
                            { targets: 0, visible: false }, // esconde a data bruta
                            { targets: 1, orderData: 0 }    // ordena pela coluna 0, mas mostra a 1
                        ],
                        order: [[0, 'asc']] // mais antigo primeiro
                    });
                });
            });
        </script>
    </body>
</html>
