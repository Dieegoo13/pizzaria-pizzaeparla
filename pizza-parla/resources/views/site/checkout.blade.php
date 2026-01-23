{{-- resources/views/site/checkout.blade.php --}}
@extends('layouts.site')

@section('title', 'Pizza&Parla - Finalizar Pedido')

@section('content')
<main class="container py-5">

    <h1 class="text-center mb-5 fw-bold">FINALIZAR PEDIDO</h1>

    <form action="{{ route('site.index') }}" method="POST" id="checkoutForm">
        @csrf
        
        <div class="row g-4">

            <!-- COLUNA ESQUERDA - Endereço e Pagamento -->
            <div class="col-lg-7">

                <!-- ENDEREÇO DE ENTREGA -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4">Endereço para entrega:</h4>
                        
                        <div class="mb-3">
                            <input 
                                type="text" 
                                name="rua" 
                                class="form-control form-control-lg @error('rua') is-invalid @enderror" 
                                placeholder="Rua" 
                                value="{{ old('rua', $endereco->rua ?? 'Tangará 28, Cardoso') }}"
                                required
                            >
                            @error('rua')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input 
                                type="text" 
                                name="cep" 
                                class="form-control form-control-lg @error('cep') is-invalid @enderror" 
                                placeholder="CEP" 
                                value="{{ old('cep', $endereco->cep ?? '30624-300') }}"
                                maxlength="9"
                                required
                            >
                            @error('cep')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- FORMA DE PAGAMENTO -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4">Forma de pagamento</h4>

                        <!-- Opções de Pagamento -->
                        <div class="d-flex gap-3 mb-4">
                            <!-- Cartão de Crédito -->
                            <button 
                                type="button" 
                                class="btn btn-outline-dark payment-option flex-fill py-3 active" 
                                data-payment="credit_card"
                            >
                                <i class="bi bi-credit-card fs-4 d-block mb-2"></i>
                                Cartão de crédito
                            </button>

                            <!-- PIX -->
                            <button 
                                type="button" 
                                class="btn btn-outline-dark payment-option flex-fill py-3" 
                                data-payment="pix"
                            >
                                <i class="bi bi-wallet2 fs-4 d-block mb-2"></i>
                                Pix
                            </button>

                            <!-- Dinheiro -->
                            <button 
                                type="button" 
                                class="btn btn-outline-dark payment-option flex-fill py-3" 
                                data-payment="cash"
                            >
                                <i class="bi bi-cash-stack fs-4 d-block mb-2"></i>
                                Dinheiro
                            </button>
                        </div>

                        <input type="hidden" name="payment_method" id="paymentMethod" value="credit_card" required>

                        <!-- Campos de Cartão de Crédito -->
                        <div id="creditCardFields">
                            <div class="mb-3">
                                <input 
                                    type="text" 
                                    name="card_number" 
                                    class="form-control form-control-lg" 
                                    placeholder="Número do Cartão de Crédito"
                                    maxlength="19"
                                    id="cardNumber"
                                >
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input 
                                        type="text" 
                                        name="card_validity" 
                                        class="form-control form-control-lg" 
                                        placeholder="Validade (mm/aa)"
                                        maxlength="5"
                                        id="cardValidity"
                                    >
                                </div>
                                <div class="col-md-6">
                                    <input 
                                        type="text" 
                                        name="card_cvv" 
                                        class="form-control form-control-lg" 
                                        placeholder="CVV"
                                        maxlength="4"
                                        id="cardCvv"
                                    >
                                </div>
                            </div>

                            <div class="mt-3">
                                <input 
                                    type="text" 
                                    name="card_name" 
                                    class="form-control form-control-lg" 
                                    placeholder="Nome impresso no cartão"
                                    id="cardName"
                                >
                            </div>

                            <div class="mt-3">
                                <input 
                                    type="text" 
                                    name="card_cpf" 
                                    class="form-control form-control-lg" 
                                    placeholder="CPF do titular"
                                    maxlength="14"
                                    id="cardCpf"
                                >
                            </div>
                        </div>

                        <!-- Mensagem PIX (oculta inicialmente) -->
                        <div id="pixMessage" class="d-none">
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle me-2"></i>
                                O código PIX será gerado após a confirmação do pedido.
                            </div>
                        </div>

                        <!-- Campos de Dinheiro (oculto inicialmente) -->
                        <div id="cashFields" class="d-none">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Precisa de troco?</label>
                                <input 
                                    type="number" 
                                    name="cash_change" 
                                    class="form-control form-control-lg" 
                                    placeholder="Troco para quanto? (Ex: R$ 50,00)"
                                    step="0.01"
                                    min="0"
                                >
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- COLUNA DIREITA - Resumo do Pedido -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm sticky-top" style="top: 100px;">
                    <div class="card-header bg-danger text-white py-3">
                        <h5 class="mb-0 fw-bold text-center">RESUMO DO PEDIDO</h5>
                    </div>
                    <div class="card-body p-4">
                        
                        <!-- Cabeçalho da Tabela -->
                        <div class="d-flex justify-content-between mb-3 pb-2 border-bottom">
                            <strong>Produto</strong>
                            <strong>Preço</strong>
                        </div>

                        <!-- Lista de Produtos -->
                        <div id="orderItems">
                            @if(session('cart') && count(session('cart')) > 0)
                                @foreach(session('cart') as $id => $item)
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>{{ $item['name'] }} <small class="text-muted">(x{{ $item['quantity'] }})</small></span>
                                        <span class="fw-bold">R$ {{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}</span>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center text-muted py-3">
                                    <i class="bi bi-cart-x fs-1 d-block mb-2"></i>
                                    Seu carrinho está vazio
                                </div>
                            @endif
                        </div>

                        <!-- Total -->
                        <div class="mt-4 pt-3 border-top">
                            <div class="d-flex justify-content-between align-items-center bg-danger text-white p-3 rounded">
                                <strong class="fs-5">Total a pagar:</strong>
                                <strong class="fs-4">R$ {{ number_format($total ?? 30.00, 2, ',', '.') }}</strong>
                            </div>
                        </div>

                        <!-- Botão Confirmar -->
                        <button 
                            type="submit" 
                            class="btn btn-success btn-lg w-100 mt-4 fw-bold"
                            {{ (session('cart') && count(session('cart')) > 0) ? '' : 'disabled' }}
                        >
                            <i class="bi bi-check-circle me-2"></i>Confirmar Pedido
                        </button>

                    </div>
                </div>
            </div>

        </div>

    </form>

</main>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // Elementos
    const paymentOptions = document.querySelectorAll('.payment-option');
    const paymentMethodInput = document.getElementById('paymentMethod');
    const creditCardFields = document.getElementById('creditCardFields');
    const pixMessage = document.getElementById('pixMessage');
    const cashFields = document.getElementById('cashFields');
    
    // Campos de cartão
    const cardNumber = document.getElementById('cardNumber');
    const cardValidity = document.getElementById('cardValidity');
    const cardCvv = document.getElementById('cardCvv');
    const cardName = document.getElementById('cardName');
    const cardCpf = document.getElementById('cardCpf');

    // Alternar forma de pagamento
    paymentOptions.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active de todos
            paymentOptions.forEach(b => b.classList.remove('active'));
            
            // Adiciona active no clicado
            this.classList.add('active');
            
            // Pega o método de pagamento
            const method = this.dataset.payment;
            paymentMethodInput.value = method;
            
            // Esconde todos os campos
            creditCardFields.classList.add('d-none');
            pixMessage.classList.add('d-none');
            cashFields.classList.add('d-none');
            
            // Remove required dos campos de cartão
            cardNumber.removeAttribute('required');
            cardValidity.removeAttribute('required');
            cardCvv.removeAttribute('required');
            cardName.removeAttribute('required');
            cardCpf.removeAttribute('required');
            
            // Mostra campos específicos
            if (method === 'credit_card') {
                creditCardFields.classList.remove('d-none');
                cardNumber.setAttribute('required', 'required');
                cardValidity.setAttribute('required', 'required');
                cardCvv.setAttribute('required', 'required');
                cardName.setAttribute('required', 'required');
                cardCpf.setAttribute('required', 'required');
            } else if (method === 'pix') {
                pixMessage.classList.remove('d-none');
            } else if (method === 'cash') {
                cashFields.classList.remove('d-none');
            }
        });
    });

    // Máscara de CEP
    const cepInput = document.querySelector('input[name="cep"]');
    if (cepInput) {
        cepInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 5) {
                value = value.slice(0, 5) + '-' + value.slice(5, 8);
            }
            e.target.value = value;
        });
    }

    // Máscara de Cartão
    if (cardNumber) {
        cardNumber.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
            e.target.value = value;
        });
    }

    // Máscara de Validade
    if (cardValidity) {
        cardValidity.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 2) {
                value = value.slice(0, 2) + '/' + value.slice(2, 4);
            }
            e.target.value = value;
        });
    }

    // Máscara de CPF
    if (cardCpf) {
        cardCpf.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
            e.target.value = value;
        });
    }

    // Apenas números no CVV
    if (cardCvv) {
        cardCvv.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '');
        });
    }

});
</script>
@endpush

@push('styles')
<style>
.payment-option {
    transition: all 0.3s ease;
}

.payment-option:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.payment-option.active {
    background-color: #dc3545;
    color: white;
    border-color: #dc3545;
}

.payment-option.active:hover {
    background-color: #bb2d3b;
    border-color: #bb2d3b;
}

.sticky-top {
    position: sticky;
}

@media (max-width: 991px) {
    .sticky-top {
        position: relative;
        top: 0 !important;
    }
}
</style>
@endpush