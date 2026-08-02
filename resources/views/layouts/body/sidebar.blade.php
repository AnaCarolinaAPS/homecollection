<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                    <li>
                        <a href="{{ route('dashboard'); }}" class="waves-effect">
                            <i class="ri-dashboard-line"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-pencil-line"></i>
                            <span>Cadastros</span>
                        </a>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">Produtos</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('categoriaProduto.index'); }}">Categorias</a></li>
                                <li><a href="{{ route('produto.index'); }}">Produtos</a></li>
                            </ul>
                        </li>
                    </li>

                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
