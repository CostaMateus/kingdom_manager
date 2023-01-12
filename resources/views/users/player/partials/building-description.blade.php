
                        <div class="row" >
                            <div class="col-12 col-sm-4 col-md-3 col-lg-2 text-center my-auto" >
                                <img src="{{ asset( "assets/graphic/buildings/{$building[ "key" ]}1.png" ) }}" alt="{{ $building[ "name" ] }}" >
                            </div>
                            <div class="col-12 col-sm-8 col-md-9 col-lg-10 mt-3 mt-sm-0" >
                                <p class="h3 mb-2" >
                                    @php
                                        $key   = "building_{$building[ "key" ]}";
                                        $level = ( $village->$key != 0 ) ? "Nível {$village->$key}" : "não construído";
                                    @endphp
                                    <b>{{ $building[ "name" ] }} ({{ $level }})</b>
                                </p>
                                <p class="h5 mb-0" >
                                    {{ $building[ "description" ] }}
                                </p>
                            </div>
                        </div>
