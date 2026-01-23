{{-- resources/views/site/home.blade.php --}}
@extends('layouts.site')

@section('title', 'Pizza&Parla - A Melhor Pizzaria')

@section('content')
<main class="container-principal py-5">
    <section class="container">

        {{-- Filtro --}}
        <form method="GET" action="{{ route('site.index') }}">
            <div class="mb-5 bg-default rounded-3 p-4">
                <div class="row justify-content-center">
                    <div class="col-md-10 d-flex gap-3">

                        <select name="category"
                                class="form-select bg-white fw-normal text-black custom-select"
                                onchange="this.form.submit()">

                            <option value="">Opções</option>

                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}"
                                    {{ request('category') == $category->slug ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="bi bi-search"></i>
                            </span>
                            <input 
                                type="text" 
                                name="search" 
                                class="form-control"
                                placeholder="Buscar produtos"
                                value="{{ request('search') }}"
                            >
                        </div>

                        <button class="btn btn-warning text-danger">Buscar</button>

                    </div>
                </div>
            </div>
        </form>


        {{-- @php
            echo '<pre>';
            var_dump($pizzas);
            
        @endphp --}}

        <div class="bg-default rounded-3 p-3 mb-4 text-white">
            <h5 class="fw-bold mb-0">Pizzas Gigantes</h5>
        </div>

        <div class="row g-3">
            @foreach($pizzas as $pizza)
                @foreach($pizza->sizes as $size)
                    @if($size->name === 'Gigante')
                        <div class="col-lg-2 col-md-3 col-sm-2 mb-3">
                            <div class="card hover-card pizza-card text-center">

                                <img 
                                    src="{{ asset('img/' . $pizza->image) }}" 
                                    class="card-img-top pizza-img"
                                    alt="{{ $pizza->name }}"
                                >

                                <div class="card-body p-2">
                                    <h6 class="fw-bold text-dark mb-0 small">
                                        {{ $pizza->name }}
                                    </h6>

                                    <small class="text-muted d-block">
                                        {{ $size->name }} • {{ $size->diameter }}cm
                                    </small>

                                    <span class="badge bg-warning text-dark my-1">
                                        R$ {{ number_format($size->pivot->price, 2, ',', '.') }}
                                    </span>

                                    <button 
                                        class="btn btn-sm btn-success w-100 mt-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalPizza"
                                        data-pizza-id="{{ $pizza->id }}"
                                        data-size-id="{{ $size->id }}"
                                        data-pizza-name="{{ $pizza->name }}"
                                        data-price="{{ (float) $size->pivot->price }}"
                                    >
                                        + Adicionar
                                    </button>

                                </div>

                            </div>
                        </div>
                    @endif
                @endforeach
            @endforeach
        </div>


        <div class="bg-default rounded-3 p-3 my-5 text-white">
            <h5 class="fw-bold mb-0">Pizzas Médias</h5>
        </div>

        <div class="row g-3">
            @foreach($pizzas as $pizza)
                @foreach($pizza->sizes as $size)
                    @if($size->name === 'Média')
                        <div class="col-lg-2 col-md-3 col-sm-2 mb-3">
                            <div class="card hover-card pizza-card text-center">

                                <img src="{{ asset('img/' . $pizza->image) }}" class="card-img-top pizza-img">

                                <div class="card-body p-2">
                                    <h6 class="fw-bold text-dark mb-0 small">{{ $pizza->name }}</h6>

                                    <small class="text-muted d-block">
                                        {{ $size->name }} • {{ $size->diameter }}cm
                                    </small>

                                    <span class="badge bg-warning text-dark my-1">
                                        R$ {{ number_format($size->pivot->price, 2, ',', '.') }}
                                    </span>

                                    <button 
                                        class="btn btn-sm btn-success w-100 mt-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalPizza"
                                        data-pizza-id="{{ $pizza->id }}"
                                        data-size-id="{{ $size->id }}"
                                        data-pizza-name="{{ $pizza->name }}"
                                        data-price="{{ (float) $size->pivot->price }}"
                                    >
                                        + Adicionar
                                    </button>

                                </div>

                            </div>
                        </div>
                    @endif
                @endforeach
            @endforeach
        </div>

        <div class="bg-default rounded-3 p-3 my-5 text-white">
            <h5 class="fw-bold mb-0">Pizzas Pequenas</h5>
        </div>

        <div class="row g-3">
            @foreach($pizzas as $pizza)
                @foreach($pizza->sizes as $size)
                    @if($size->name === 'Pequena')
                        <div class="col-lg-2 col-md-3 col-sm-2 mb-3">
                            <div class="card hover-card pizza-card text-center">

                                <img src="{{ asset('img/' . $pizza->image) }}" class="card-img-top pizza-img">

                                <div class="card-body p-2">
                                    <h6 class="fw-bold text-dark mb-0 small">{{ $pizza->name }}</h6>

                                    <small class="text-muted d-block">
                                        {{ $size->name }} • {{ $size->diameter }}cm
                                    </small>

                                    <span class="badge bg-warning text-dark my-1">
                                        R$ {{ number_format($size->pivot->price, 2, ',', '.') }}
                                    </span>

                                    <button 
                                        class="btn btn-sm btn-success w-100 mt-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalPizza"
                                        data-pizza-id="{{ $pizza->id }}"
                                        data-size-id="{{ $size->id }}"
                                        data-pizza-name="{{ $pizza->name }}"
                                        data-price="{{ (float) $size->pivot->price }}"
                                    >
                                        + Adicionar
                                    </button>
                                </div>

                            </div>
                        </div>
                    @endif
                @endforeach
            @endforeach
        </div>

        <div class="bg-default rounded-3 p-3 my-5 text-white">
            <h5 class="fw-bold mb-0">Bebidas</h5>
        </div>
        
        <div class="row g-3">
            @foreach($beverages as $beverage)
                <div class="col-lg-2 col-md-3 col-sm-2 mb-3">
                    <div class="card hover-card pizza-card text-center">

                        <img 
                            src="{{ asset('img/' . $beverage->image) }}" 
                            class="card-img-top pizza-img"
                            alt="{{ $beverage->name }}"
                        >

                        <div class="card-body p-2">
                            <h6 class="fw-bold text-dark mb-0 small">
                                {{ $beverage->name }}
                            </h6>

                            <span class="badge bg-warning text-dark my-2 d-block">
                                R$ {{ number_format($beverage->price, 2, ',', '.') }}
                            </span>

                            <button 
                                class="btn btn-sm btn-success w-100 mt-1"
                                data-bs-toggle="modal"
                                data-bs-target="#modalBeverage"
                                data-beverage-id="{{ $beverage->id }}"
                            >
                                + Adicionar
                            </button>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

    </section>

    <div class="modal fade" id="modalPizza" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <form method="POST" action="{{ route('site.index') }}">
                    @csrf

                    <input type="hidden" name="pizza_id" id="modalPizzaId">
                    <input type="hidden" name="size_id" id="modalSizeId">

                    <div class="modal-header bg-default d-flex align-items-center gap-4">
                        <img src="img/logo.png" alt="" width="70">
                        <h3 class="text-white" >Pizza&Parla</h3>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">

                            {{-- ESQUERDA: OPÇÕES --}}
                            <div class="col-md-7">

                                <h6 class="fw-bold">Sabores</h6>
                                <div class="row">
                                    @foreach($pizzas as $pizza)
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input 
                                                    class="form-check-input flavor-checkbox"
                                                    type="checkbox"
                                                    value="{{ $pizza->id }}"
                                                    data-name="{{ $pizza->name }}"
                                                >
                                                <label class="form-check-label">
                                                    {{ $pizza->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <hr>

                                <h6 class="fw-bold">Borda <span class="text-danger">*</span></h6>

                                @foreach([
                                    ['name' => 'Sem borda', 'price' => 0],
                                    ['name' => 'Cheddar', 'price' => 5],
                                    ['name' => 'Catupiry', 'price' => 5],
                                ] as $border)
                                    <div class="form-check">
                                        <input 
                                            class="form-check-input border-radio"
                                            type="radio"
                                            name="border"
                                            data-name="{{ $border['name'] }}"
                                            data-price="{{ $border['price'] }}"
                                            required
                                        >
                                        <label class="form-check-label">
                                            {{ $border['name'] }} 
                                            @if($border['price'] > 0)
                                                (+ R$ {{ number_format($border['price'], 2, ',', '.') }})
                                            @endif
                                        </label>
                                    </div>
                                @endforeach

                                <hr>

                                <h6 class="fw-bold">Bebida</h6>
                                <select class="form-select beverage-select">
                                    <option value="" data-price="0">Nenhuma</option>
                                    @foreach($beverages as $beverage)
                                        <option 
                                            value="{{ $beverage->id }}"
                                            data-name="{{ $beverage->name }}"
                                            data-price="{{ $beverage->price }}"
                                        >
                                            {{ $beverage->name }} (+ R$ {{ number_format($beverage->price, 2, ',', '.') }})
                                        </option>
                                    @endforeach
                                </select>

                                <hr>

                                <h6 class="fw-bold">Observações</h6>
                                <textarea class="form-control" rows="3"></textarea>

                            </div>

                            {{-- DIREITA: RESUMO --}}
                            <div class="col-md-5">
                                <div class="border rounded p-3 bg-light">
                                    <h6 class="fw-bold">Resumo do pedido</h6>

                                    <p class="mb-1"><strong>Pizza:</strong> <span id="summaryPizza"></span></p>
                                    <p class="mb-1"><strong>Borda:</strong> <span id="summaryBorder">—</span></p>
                                    <p class="mb-1"><strong>Bebida:</strong> <span id="summaryBeverage">—</span></p>

                                    <hr>

                                    <h5 class="fw-bold text-success">
                                        Total: R$ <span id="summaryTotal">0,00</span>
                                    </h5>
                                </div>
                            </div>

                        </div>

                        <button 
                            type="button"
                            class="btn btn-success w-100"
                            id="addToCartBtn"
                        >
                            Adicionar ao carrinho 🛒
                        </button>

                    </div>
                    

                </form>
            </div>
        </div>
    </div>

</main>
@endsection
