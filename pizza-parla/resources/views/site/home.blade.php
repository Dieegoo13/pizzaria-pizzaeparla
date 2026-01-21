{{-- resources/views/site/home.blade.php --}}
@extends('layouts.site')

@section('title', 'Pizza&Parla - A Melhor Pizzaria')

@section('content')
<main class="container-principal py-5">
    <section class="container">

        {{-- Filtro --}}
        <div class="mb-5 bg-default rounded-3 p-4">
            <div class="row justify-content-center">
                <div class="col-md-10 d-flex gap-3">

                    <select name="category" id="category" class="form-select bg-default fw-normal category-select">
                        <option value="">CATEGORIAS</option>
                        <option value="pizza_gigante">Pizzas Gigante</option>
                        <option value="pizza_media">Pizzas Média</option>
                        <option value="pizza_pequena">Pizzas Pequena</option>
                        <option value="bebida">Bebidas</option>
                    </select>

                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="bi bi-search"></i>
                        </span>
                        <input 
                            type="text" 
                            name="search" 
                            id="search" 
                            class="form-control"
                            placeholder="Buscar produtos"
                        >
                    </div>

                </div>
            </div>
        </div>

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
                        <div class="col-lg-2 col-md-3 col-sm-4 mb-3">
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
                        <div class="col-lg-2 col-md-3 col-sm-4 mb-3">
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
                        <div class="col-lg-2 col-md-3 col-sm-4 mb-3">
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
        

    </section>
</main>
@endsection
