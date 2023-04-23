@extends( "layouts.game" )

@section( "title", "Classificação" )

@section( "content" )
    <div class="container" >
        <div class="row justify-content-center" >

            <div class="col-12 col-md-10 mx-auto"  >
                <div class="card border-0" >

                    <div class="card-body px-3" >
                        <p class="fw-bold h3 mb-4" >Classificação</p>

                        {{-- não implementado --}}
                        @include( "users/player/partials.warning", [ "warning_text" => "Classificação incompleta! Status 40%" ] )

                        <div class="row" >
                            <div class="col-12 col-md-8 mx-auto" >
                                <div class="table-responsive" >
                                    <table id="overview-production" class="table table-hover table-sm align-middle" >
                                        <thead>
                                            <tr>
                                                <th scope="col"                                          >#</th>
                                                <th scope="col" style="min-width:100px"                  >Jogador</th>
                                                <th scope="col"                                          >Aliança</th>
                                                <th scope="col" class="text-end"                         >Pontos</th>
                                                <th scope="col" class="text-end"                         >Aldeias</th>
                                                <th scope="col" class="text-end" style="min-width:125px" >Pontos por aldeia</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ( $players as $player )
                                                @php
                                                    $points     = $player->points ?? 0;
                                                    $perVillage = $player->villages == 0 ? 0 : ( $points / $player->villages );
                                                @endphp

                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $player->nickname }}</td>
                                                    <td></td>
                                                    <td class="text-end" >{{ $points           }}</td>
                                                    <td class="text-end" >{{ $player->villages }}</td>
                                                    <td class="text-end" >{{ $perVillage       }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
