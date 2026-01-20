{{-- resources/views/layouts/partials/footer.blade.php --}}
<footer id="footer" class="bg-default text-white pt-5 pb-3 mt-5">
    <div class="container">
        <div class="row">
            
            {{-- Coluna ACESSO --}}
            <div class="col-md-4 mb-4">
                <h5 class="text-uppercase fw-bold mb-3 text-warning">Acesso</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('site.index') }}" class="text-white text-decoration-none hover-link">
                            <i class="bi bi-house-door me-2"></i>Home
                        </a>
                    </li>
                    <li class="mb-2">
                        {{-- <a href="{{ route('cardapio.index') }}" class="text-white text-decoration-none hover-link">
                            <i class="bi bi-book me-2"></i>Cardápio
                        </a> --}}
                    </li>
                    <li class="mb-2">
                        <a href="#footer" class="text-white text-decoration-none hover-link">
                            <i class="bi bi-info-circle me-2"></i>Informações
                        </a>
                    </li>
                    @guest
                        <li class="mb-2">
                            <a href="{{ route('site.index') }}" class="text-white text-decoration-none hover-link">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>

            {{-- Coluna CONTATOS --}}
            <div class="col-md-4 mb-4">
                <h5 class="text-uppercase fw-bold mb-3 text-warning">Contatos</h5>
                <ul class="list-unstyled">

                    <li class="mb-2">
                        <a href="tel:+5531995882234" class="text-white text-decoration-none hover-link">
                            <i class="bi bi-whatsapp me-2"></i>(31) 99588-2234
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="mailto:contato@pizzaeparla.com.br" class="text-white text-decoration-none hover-link">
                            <i class="bi bi-envelope me-2"></i>contato@pizzaeparla.com.br
                        </a>
                    </li>

                    <li class="mb-2">
                        <a href="tel:+5531995882234" class="text-white text-decoration-none hover-link">
                            <i class="bi bi-house me-2"></i>Av Sabiracema, 198 - Ceú Azul, Belo Horizonte, MG 30626-400 Aberto até 23:30 
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Coluna REDES SOCIAIS --}}
            <div class="col-md-4 mb-4">
                <h5 class="text-uppercase fw-bold mb-3 text-warning">Redes Sociais</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="https://instagram.com/pizzaeparla" target="_blank" class="text-white text-decoration-none hover-link">
                            <i class="bi bi-instagram me-2"></i>Instagram
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="https://facebook.com/pizzaeparla" target="_blank" class="text-white text-decoration-none hover-link">
                            <i class="bi bi-facebook me-2"></i>Facebook
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="https://twitter.com/pizzaeparla" target="_blank" class="text-white text-decoration-none hover-link">
                            <i class="bi bi-twitter me-2"></i>Twitter
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Copyright --}}
        <hr class="bg-secondary">
        <div class="text-center py-3">
            <p class="mb-0">
                &copy; {{ date('Y') }} - Pizza&Parla - A melhor PIZZARIA - 
                Desenvolvido por <a href="https://github.com/Dieegoo13" target="_blank" class="text-warning text-decoration-none fw-bold">Diego</a>
            </p>
        </div>
    </div>
</footer>
