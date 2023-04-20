@extends( "layouts.game" )

@section( "title", $buildings->main->name )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >

            @include( "users/player/partials.resources" )

            <div class=col-12 col-md-10 mx-auto >
                <div class="card border-0" >
                    {{-- nome e pontuação da aldeia --}}
                    @include( "users/player/partials.building-name" )

                    <div class="card-body" >
                        @include( "users/player/partials.building-description", [
                            "title"    => "Tempo reduzido por nível",
                            "field"    => "time",
                            "uni"      => "%",
                            "building" => $buildings->main
                        ] )

                        <div class="row mt-4" >

                            {{-- fila de construção --}}
                            @include( "users/player/partials.building-queue", [ "events" => $events ] )

                            {{-- edificios construidos --}}
                            @include( "users/player/partials.building-builded" )

                            {{-- edificios ainda nao construidos --}}
                            @include( "users/player/partials.building-not-builded" )

                            {{-- nome da aldeia --}}
                            <div class="col-12 col-xl-10 mx-auto mt-5" >
                                <p class="fw-bold mb-2" >Mudar nome da aldeia:</p>
                                <form class="row row-cols-auto" method="POST" action="{{ route( "village.change.name", [ "village" => $village ] ) }}" >
                                    @csrf
                                    <div class="col pe-2" >
                                        <input type="text" class="form-control form-control-sm" name="name" value="{{ $village->name }}" >
                                    </div>
                                    <div class="col ps-2" >
                                        <button type="submit" class="btn btn-light btn-sm" >Salvar</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection

@include( "users/player/partials.update-resources" )
