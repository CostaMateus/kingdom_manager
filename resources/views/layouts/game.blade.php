<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    <meta charset="utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1" >

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" >

    <title>
        @yield( "title" ) | {{ config( "app.name", "Laravel" ) }}
    </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com" >
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet" >

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet" >

    {{-- CSS TW --}}
    <link rel="stylesheet" href="{{ asset( "css/tw.css" ) }}" >
</head>
<body>
    <div id="app" >
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" >
            <div class="container" >
                <a id="km-menu" class="navbar-brand d-md-none" href="{{ route( "home" ) }}" >
                    [{{ config('app.name', 'Laravel') }}]
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}" >
                    <span class="navbar-toggler-icon" ></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent" >

                    <div class="row mx-auto">
                        <div class="col-12 d-none d-md-block text-center">
                            <a id="km-main" class="navbar-brand mx-0" href="{{ route( "home" ) }}" >
                                [{{ config('app.name', 'Laravel') }}]
                            </a>
                        </div>
                        <div class="col-12">
                            <!-- Center Navbar -->
                            <ul class="navbar-nav justify-content-center" >
                                <li class="nav-item dropdown" >
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle {{ Route::currentRouteNamed( "home" ) ? "active" : "" }}" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Visualizações
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-start" aria-labelledby="navbarDropdown" >
                                        <a class="dropdown-item {{ Route::currentRouteNamed( "home" ) ? "active" : "" }}" href="{{ route( "home" ) }}" >Início</a>
                                        {{--
                                            Combinado
                                                - lista as construções e o que está em andamento nelas
                                                - lista o exército e as qntdds
                                                - lista mercadores, livre/total
                                            Produção
                                                - lista pontos, recursos por hora, armazem, comerciantes, fazenda, fila de construção/pesquisa/recrutamento
                                            Transporte
                                                - lista movimentação dos comerciantes (partida/chegada/retorno)
                                            Tropas
                                                - lista localização do exército
                                            Comandos
                                                - lista movimentação do exército
                                            Chegando
                                                - lista ataques e apoios
                                            Edifícios
                                                - lista pontos, nível dos edifícios e fila de construção
                                            Pesquisa
                                                - lista pontos, status de pesquisa de cada unidade do exército, fila de pesquisa e bandeira ativa
                                            Gerente de conta
                                                - automatização
                                        --}}
                                    </div>
                                </li>

                                <li class="nav-item" >
                                    <a class="nav-link {{ Route::currentRouteNamed( "map" ) ? "active" : "" }}" href="{{ route( "map" ) }}" >Mapa</a>
                                </li>

                                <li class="nav-item" >
                                    <a class="nav-link {{ Route::currentRouteNamed( "reports" ) ? "active" : "" }}" href="{{ route( "reports" ) }}" >Relatórios</a>
                                    {{-- Todos | Ataques | Defesas | Suporte | Comércio | Eventos | Diversos | Encaminhados | Público | Filtros | Pastas --}}
                                </li>

                                <li class="nav-item" >
                                    <a class="nav-link {{ Route::currentRouteNamed( "messages" ) ? "active" : "" }}" href="{{ route( "messages" ) }}" >Mensagens</a>
                                    {{-- Mensagens | Mensagens coletivas | Escrever mensagem | Caderno de endereços | Pastas --}}
                                </li>

                                <li class="nav-item" >
                                    <a class="nav-link {{ Route::currentRouteNamed( "ranking" ) ? "active" : "" }}" href="{{ route( "ranking" ) }}" >Classificação</a>
                                    {{-- Alianças | Jogadores | Dominância do mundo | Alianças do continente | Jogadores do continente | Oponentes derrotados (aliança) | Oponentes derrotados | Realizações | Em um dia | Guerras da aliança --}}
                                </li>

                                <li class="nav-item" >
                                    <a class="nav-link {{ Route::currentRouteNamed( "alliance" ) ? "active" : "" }}" href="{{ route( "alliance" ) }}" >Aliança</a>
                                    {{-- Visualização geral | Propriedades | Nível | Membros | Diplomacia | Guerras da aliança | Planejador | Recrutamento | Fórum --}}
                                </li>

                                <li class="nav-item dropdown" >
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle {{ Route::currentRouteNamed( "profile" ) ? "active" : "" }}" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->nickname }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" >
                                        <a class="dropdown-item {{ Route::currentRouteNamed( "profile" ) ? "active" : "" }}" href="{{ route( "profile" ) }}" >Perfil</a>
                                        {{-- nick | Inventário | Realizações | Estatísticas | Amigos | Bônus diário | Mentor | Lista de bloqueados --}}

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();" >
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none" >
                                            @csrf
                                        </form>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main class="pt-2 pb-4" >
            @yield('content')
        </main>
    </div>
</body>
</html>
