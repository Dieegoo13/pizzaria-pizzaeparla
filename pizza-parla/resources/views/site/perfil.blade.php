{{-- resources/views/site/perfil.blade.php --}}
@extends('layouts.site')

@section('title', 'Minha Conta - Pizza&Parla')

@section('content')
<main class="py-5">
    <div class="container">

        <!-- Header CONTA -->
        <div class="bg-default text-white p-4 mb-4 rounded">
            <h1 class="mb-0 fw-bold">CONTA</h1>
        </div>

        <div class="row g-4">

            <!-- COLUNA ESQUERDA -->
            <div class="col-lg-6">

                <!-- DETALHES DA CONTA -->
                <div class="mb-5">
                    <h4 class="fw-bold mb-4">Detalhes da conta</h4>

                    <form action="{{ route('site.index') }}" method="POST" id="profileForm">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nome e sobrenome:</label>
                                <p class="mb-0">{{ auth()->user()->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">E-mail:</label>
                                <p class="mb-0">{{ auth()->user()->email }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">CPF/CNPJ</label>
                                <p class="mb-0">{{ auth()->user()->cpf ?? 'Não informado' }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Celular:</label>
                                <p class="mb-0">{{ auth()->user()->phone ?? 'Não informado' }}</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Aniversário:</label>
                            <p class="mb-0">{{ auth()->user()->birth_date ? \Carbon\Carbon::parse(auth()->user()->birth_date)->format('d/m/Y') : 'Não informado' }}</p>
                        </div>

                        <button type="button" class="btn btn-success px-4" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                            EDITAR
                        </button>

                    </form>
                </div>

                <!-- MEUS PEDIDOS -->
                <div class="mb-5">
                    <h4 class="fw-bold mb-3">Meus Pedidos</h4>
                    
                    @if(isset($pedidos) && $pedidos->count() > 0)
                        <div class="list-group">
                            @foreach($pedidos as $pedido)
                                <a href="{{ route('site.index', $pedido->id) }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">Pedido #{{ $pedido->id }}</h6>
                                            <small class="text-muted">{{ $pedido->created_at->format('d/m/Y H:i') }}</small>
                                        </div>
                                        <div class="text-end">
                                            <span class="badge bg-{{ $pedido->status_color }}">{{ $pedido->status_label }}</span>
                                            <p class="mb-0 fw-bold">R$ {{ number_format($pedido->total, 2, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            Não há pedidos
                        </div>
                    @endif
                </div>

                <!-- MEUS ENDEREÇOS -->
                <div class="mb-5">
                    <h4 class="fw-bold mb-3">Meus Endereços</h4>

                    @if(isset($enderecos) && $enderecos->count() > 0)
                        @foreach($enderecos as $endereco)
                            <div class="d-flex justify-content-between align-items-start border rounded p-3 mb-3">
                                <div>
                                    <p class="mb-1">
                                        <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                                        <strong>Endereço:</strong>
                                        {{ $endereco->street }},
                                        {{ $endereco->number ?? 's/n' }}
                                    </p>

                                    <p class="mb-0 text-muted small">
                                        {{ $endereco->neighborhood }} - {{ $endereco->city }} <br>
                                        CEP: {{ $endereco->zip_code }}
                                    </p>
                                </div>

                                <button class="btn btn-sm btn-outline-danger"
                                        onclick="deleteAddress({{ $endereco->id }})">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            Nenhum endereço cadastrado
                        </div>
                    @endif


                    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                        <i class="bi bi-plus-circle me-2"></i>Adicionar Endereço
                    </button>
                </div>

                <!-- DELETAR CONTA -->
                <div>
                    <h4 class="fw-bold mb-3">Deletar conta</h4>
                    <button class="btn btn-danger px-4" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                        DELETAR
                    </button>
                </div>

            </div>

            <!-- COLUNA DIREITA -->
            <div class="col-lg-6">

                <!-- FORMAS DE PAGAMENTO -->
                <div class="mb-5">
                    <h4 class="fw-bold mb-3">Formas de pagamento</h4>
                    
                    @if(isset($cartoes) && $cartoes->count() > 0)
                        <div class="list-group mb-3">
                            @foreach($cartoes as $cartao)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="bi bi-credit-card text-danger me-2"></i>
                                        <strong>****  ****  ****  {{ substr($cartao->numero, -4) }}</strong>
                                        <small class="text-muted d-block">{{ $cartao->nome_titular }}</small>
                                    </div>
                                    <button class="btn btn-sm btn-outline-danger" onclick="deleteCard({{ $cartao->id }})">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info mb-3">
                            <i class="bi bi-info-circle me-2"></i>
                            Não há cartão cadastrados
                        </div>
                    @endif

                    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addCardModal">
                        <i class="bi bi-plus-circle me-2"></i>Adicionar Cartão
                    </button>
                </div>

                <!-- SENHA -->
                <div>
                    <h4 class="fw-bold mb-3">Senha</h4>

                    <form action="{{ route('site.index') }}" method="POST" id="passwordForm">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <input 
                                type="password" 
                                name="current_password" 
                                class="form-control @error('current_password') is-invalid @enderror" 
                                placeholder="Senha Atual"
                                required
                            >
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input 
                                type="password" 
                                name="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                placeholder="Nova Senha"
                                required
                            >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input 
                                type="password" 
                                name="password_confirmation" 
                                class="form-control" 
                                placeholder="Confirmar Nova Senha"
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn-success px-4">
                            SALVAR
                        </button>

                    </form>
                </div>

            </div>

        </div>

    </div>
</main>

<!-- Modal: Editar Perfil -->
<div class="modal fade" id="editProfileModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-default text-white">
                <h5 class="modal-title">Editar Perfil</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('site.index') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nome Completo</label>
                        <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">E-mail</label>
                        <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">CPF</label>
                        <input type="text" name="cpf" class="form-control" value="{{ auth()->user()->cpf }}" maxlength="14">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Celular</label>
                        <input type="text" name="phone" class="form-control" value="{{ auth()->user()->phone }}" maxlength="15">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Data de Nascimento</label>
                        <input type="date" name="birth_date" class="form-control" value="{{ auth()->user()->birth_date }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Adicionar Endereço -->
<div class="modal fade" id="addAddressModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-default text-white">
                <h5 class="modal-title">Adicionar Endereço</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('adress.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">CEP</label>
                        <input type="text" name="zip_code" class="form-control" maxlength="9" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rua</label>
                        <input type="text" name="street" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Número</label>
                        <input type="text" name="number" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bairro</label>
                        <input type="text" name="neighborhood" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cidade</label>
                        <input type="text" name="city" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Adicionar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Adicionar Cartão -->
<div class="modal fade" id="addCardModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-default text-white">
                <h5 class="modal-title">Adicionar Cartão</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('site.index') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Número do Cartão</label>
                        <input type="text" name="numero" class="form-control" maxlength="19" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nome no Cartão</label>
                        <input type="text" name="nome_titular" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Validade (MM/AA)</label>
                            <input type="text" name="validade" class="form-control" maxlength="5" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">CVV</label>
                            <input type="text" name="cvv" class="form-control" maxlength="4" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Adicionar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Deletar Conta -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Deletar Conta</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-danger fw-bold">⚠️ Esta ação é irreversível!</p>
                <p>Tem certeza que deseja deletar sua conta? Todos os seus dados serão permanentemente removidos.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('site.index') }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
