<div class="modal fade" id="authModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-default text-white d-flex align-items-center gap-4">
                <img src="{{ asset('img/logo.png') }}" alt="Logo Pizza&Parla" width="50">
                <h5 class="modal-title">Pizza&Parla</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <ul class="nav nav-tabs mb-3">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#login">
                            Entrar
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#register">
                            Cadastrar
                        </button>
                    </li>
                </ul>

                <div class="tab-content">

                    {{-- LOGIN --}}
                    <div class="tab-pane fade show active" id="login">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
                            <input type="password" name="password" class="form-control mb-2" placeholder="Senha" required>

                            <button class="btn btn-success w-100">Entrar</button>
                        </form>
                    </div>

                    {{-- CADASTRO --}}
                    <div class="tab-pane fade" id="register">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <input type="text" name="name" class="form-control mb-2" placeholder="Nome" required>
                            <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
                            <input type="password" name="password" class="form-control mb-2" placeholder="Senha" required>
                            <input type="password" name="password_confirmation" class="form-control mb-2" placeholder="Confirmar Senha" required>

                            <button class="btn btn-primary w-100">Cadastrar</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
