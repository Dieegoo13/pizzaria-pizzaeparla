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
                        <a class="text-white dropdown-toggle d-flex align-items-center gap-2 text-decoration-none"
                        href="#"
                        data-bs-toggle="dropdown">
                            
                            <i class="bi bi-person-circle fs-4"></i>
                            <span>Olá, {{ Auth::user()->name }}</span>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('site.perfil') }}">
                                    <i class="bi bi-person me-2"></i>Meu Perfil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('site.perfil') }}">
                                    <i class="bi bi-receipt me-2"></i>Meus Pedidos
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Sair
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a 
                        href="#" 
                        class="text-white d-flex align-items-center gap-2 text-decoration-none"
                        data-bs-toggle="modal"
                        data-bs-target="#authModal"
                    >
                        <i class="bi bi-person-circle fs-4"></i>
                        <span class="fst-italic">Entrar ou Cadastrar-se</span>
                    </a>
                @endauth

                {{-- Carrinho --}}
                <button class="btn position-relative" data-bs-toggle="modal" data-bs-target="#cartModal">
                    <i class="bi bi-cart fs-4 text-white"></i>
                    <span id="cartCount" class="position-absolute top-0 start-100 translate-middle badge bg-danger">
                        {{ count(session('cart', [])) }}
                    </span>
                </button>



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

                @auth
                    <li class="nav-item">
                        <span class="nav-link text-dark fw-normal">
                            <i class="bi bi-person-circle me-2"></i>
                            Olá, {{ Auth::user()->name }}
                        </span>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('site.perfil') }}" class="nav-link text-dark">
                            <i class="bi bi-person me-2"></i>
                            Meu Perfil
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('site.perfil') }}" class="nav-link text-dark">
                            <i class="bi bi-receipt me-2"></i>
                            Meus Pedidos
                        </a>
                    </li>

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="nav-link text-danger border-0 bg-transparent text-start w-100">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                Sair
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a 
                            href="#"
                            class="nav-link text-dark"
                            data-bs-toggle="modal"
                            data-bs-target="#authModal"
                        >
                            <i class="bi bi-person me-2"></i>
                            Entrar / Cadastrar-se
                        </a>
                    </li>
                @endauth

                <li class="nav-item">
                    <a href="{{ route('site.index') }}" class="nav-link text-dark">
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

    <div class="modal fade" id="cartModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

            <div class="modal-header bg-default text-white d-flex justify-content-between align-items-center">
                <h5 class="fw-bold">Seu carrinho</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                @if(session('cart') && count(session('cart')) > 0)
                    @foreach(session('cart') as $id => $item)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <strong>{{ $item['name'] }}</strong><br>
                                <small>{{ $item['border'] }} | {{ $item['beverage'] }}</small>
                            </div>
                            <div>
                                R$ {{ number_format($item['price'], 2, ',', '.') }}
                                <button 
                                    class="btn btn-sm btn-danger ms-2"
                                    onclick="removeItem('{{ $id }}')"
                                >✕</button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted text-center">Carrinho vazio</p>
                @endif
            </div>

            <div class="modal-footer d-flex justify-content-between">
                <button class="btn btn-outline-danger" onclick="clearCart()">
                    Limpar carrinho
                </button>

                <a href="{{ route('cart.checkout') }}" class="btn btn-success">
                    Ir para pagamento
                </a>
            </div>

            </div>
        </div>
    </div>

    

</header>
