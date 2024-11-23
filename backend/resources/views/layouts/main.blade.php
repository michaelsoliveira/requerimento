<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
        <link rel="stylesheet" href="/css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="/js/scripts.js"></script>
    </head>
    <body>
            <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="d-flex align-items-center">
                    <a href="/" class="navbar-brand">
                        <img src="/img/samurai-round.png" alt="" style="width: 40px; height: 40px;">
                    </a>
                    <ul class="navbar-nav d-flex flex-row ms-3">
                        <li class="nav-item me-3">
                            <a href="/" class="nav-link">Eventos</a>
                        </li>
                        <li class="nav-item me-3">
                            <a href="/events/create" class="nav-link">Criar Eventos</a>
                        </li>
                        <li class="nav-item me-3">
                            <a href="/auth/login" class="nav-link">Entrar</a>
                        </li>
                        <li class="nav-item">
                            <a href="/" class="nav-link">Cadastrar</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        @yield('content')
        <footer>
            <p>requerimento</p>
        </footer>
    </body>
</html>
