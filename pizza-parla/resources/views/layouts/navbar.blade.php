<header>
    <nav class="navbar bg-default">
        <div class="container-fluid px-4">

            {{-- Logo --}}
            <a class="navbar-brand d-flex align-items-center gap-3" href="{{ route('site.index') }}">
                <img src="{{ asset('img/logo.png') }}" alt="Pizza&Parla" height="70" class="rounded">
            </a>

            {{-- Info --}}
            <p class="info-nav text-white mb-0 d-none d-lg-block">
                <strong>Pizza&Parla</strong><br>
                Av Sabiracema, 198 - Ceú Azul, Belo Horizonte - MG<br>
                Aberto das <span class="text-warning">18:00 às 23:30</span>
            </p>

            {{-- Ações --}}
            <div class="d-flex align-items-center gap-4">

                {{-- Usuário --}}
                @auth
                    <div class="dropdown">
                        <a class="text-white dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle fs-4"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="bi bi-person me-2"></i>Meu Perfil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="bi bi-receipt me-2"></i>Meus Pedidos
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Sair
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="#" class="text-white">
                        <i class="bi bi-person-circle fs-4"></i>
                    </a>
                @endauth

                {{-- Carrinho --}}
                <a href="#" class="text-white position-relative">
                    <i class="bi bi-cart3 fs-4"></i>
                    @if(session('cart') && count(session('cart')) > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge bg-danger">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>

                {{-- Botão Hambúrguer --}}
                <button 
                    class="btn text-white fs-3"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#menuLateral"
                >
                    <i class="bi bi-list"></i>
                </button>

            </div>
        </div>
    </nav>

    <div class="offcanvas offcanvas-end bg-white text-dark" tabindex="-1" id="menuLateral">
        
        <div class="offcanvas-header bg-default">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Pizza&Parla" height="50">
            <h3 class="text-white">Pizza&Parla</h3>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>

        <div class="offcanvas-body">

            <ul class="nav flex-column gap-3 fs-5">

                <li class="nav-item">
                    <a href="#" class="nav-link text-dark">
                        <i class="bi bi-person me-2 text-dark"></i>
                        Entrar / Cadastrar-se
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#cardapio" class="nav-link text-dark">
                        <i class="bi bi-journal-text me-2 text-dark"></i>
                        Cardápio
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link text-dark">
                        <i class="bi bi-info-circle me-2 text-dark"></i>
                        Informações
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <span class="text-secondary">Redes Sociais</span>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link text-dark">
                        <i class="bi bi-instagram me-2 text-dark"></i>
                        Instagram
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link text-dark">
                        <i class="bi bi-whatsapp me-2 text-dark"></i>
                        WhatsApp
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link text-dark">
                        <i class="bi bi-twitter me-2 text-dark"></i>
                        Twitter
                    </a>
                </li>

            </ul>

        </div>
    </div>


</header>
