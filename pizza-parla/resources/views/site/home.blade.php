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
</main>
@endsection
