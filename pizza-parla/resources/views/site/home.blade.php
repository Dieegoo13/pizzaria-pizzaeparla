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

        {{-- Título --}}
        <div class="bg-default rounded-3 p-3 mb-4 text-white">
            <h2 class="fw-bold mb-0">Pizzas Gigantes</h2>
        </div>

        {{-- Cards --}}
        <div class="row g-3">

            {{-- Card Pizza --}}
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card h-100 hover-card">
                    <a href="{{ route('site.index') }}" class="text-decoration-none">
                        <img 
                            src="{{ asset('img/logo.png') }}" 
                            class="card-img-top p-3"
                            alt="Pizza Gigante"
                        >
                        <div class="card-body text-center">
                            <h6 class="fw-bold text-dark mb-1">Gigante 8 fatias</h6>
                            <small class="text-muted d-block mb-2">35cm</small>
                            <span class="badge bg-warning text-dark">
                                R$ 60,90
                            </span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card h-100 hover-card">
                    <a href="{{ route('site.index') }}" class="text-decoration-none">
                        <img 
                            src="{{ asset('img/logo.png') }}" 
                            class="card-img-top p-3"
                            alt="Pizza Gigante"
                        >
                        <div class="card-body text-center">
                            <h6 class="fw-bold text-dark mb-1">Gigante 8 fatias</h6>
                            <small class="text-muted d-block mb-2">35cm</small>
                            <span class="badge bg-warning text-dark">
                                R$ 60,90
                            </span>
                        </div>
                    </a>
                </div>
            </div>


        </div>

        {{-- Próxima categoria --}}
        <div class="bg-default rounded-3 p-3 my-5 text-white">
            <h2 class="fw-bold mb-0">Pizzas Médias</h2>
        </div>

    </section>
</main>
@endsection
