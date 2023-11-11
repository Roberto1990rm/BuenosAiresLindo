

<x-layout>
    <div class="container">
        <h1 class="text-center mt-5 mb-4" style="text-align: center; font-family: 'Arial', 'Helvetica', sans-serif; color: #007BFF; font-size: 38px; text-transform: uppercase; margin-bottom: 20px; letter-spacing: 2px; border: 0.2px solid #ffffff; ">Listado de Bares en Buenos Aires</h1>
        <div class="main-container">
            <div class="map-container">
                <div id="map" style="width: 100%; height: 400px; border-radius: 10px;"></div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
            <script>
                var map = L.map('map').setView([-34.6118, -58.4173], 12);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);
                map.setZoom(12);
                
                @foreach ($bares as $bar)
                    var marker = L.marker([{{ $bar->latitude }}, {{ $bar->longitude }}]).addTo(map);
                    marker.bindPopup("{{ $bar->nombre }}"); // Esto agrega una etiqueta emergente con el nombre del bar
                    marker.bindTooltip("{{ $bar->nombre }}").openTooltip(); // Esto agrega una etiqueta flotante con el nombre del bar y la abre por defecto
                @endforeach
            </script>
        </div>
        <div class="row">
            @foreach ($bares as $bar)
                <div class="col-md-4">
                    <div class="bar-item" style="color: white; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);">
                        <div id="carousel-{{ $bar->id }}" class="carousel slide" data-bs-ride="carousel">
                            @if ($bar->image2 || $bar->image3 || $bar->image4)
                                <ol class="carousel-indicators">
                                    @foreach ($bares as $key => $otherBar)
                                        <li data-bs-target="#carousel-{{ $bar->id }}" data-bs-slide-to="{{ $key }}" @if ($key === 0) class="active" @endif></li>
                                    @endforeach
                                </ol>
                            @endif
                            <div class="carousel-inner">
                                @if ($bar->image1)
                                    <div class="carousel-item active">
                                        <img style="height:150px; with: auto;" src="{{ asset('storage/' . $bar->image1) }}" class="d-block mx-auto img-fluid" alt="{{ $bar->nombre }}">
                                    </div>
                                @endif
                                @if ($bar->image2)
                                    <div class="carousel-item">
                                        <img src="{{ asset('storage/' . $bar->image2) }}" class="d-block mx-auto img-fluid" alt="{{ $bar->nombre }}">
                                    </div>
                                @endif
                                @if ($bar->image3)
                                    <div class="carousel-item">
                                        <img src="{{ asset('storage/' . $bar->image3) }}" class="d-block mx-auto img-fluid" alt="{{ $bar->nombre }}">
                                    </div>
                                @endif
                                @if ($bar->image4)
                                    <div class="carousel-item">
                                        <img src="{{ asset('storage/' . $bar->image4) }}" class="d-block mx-auto img-fluid" alt="{{ $bar->nombre }}">
                                    </div>
                                @endif
                            </div>
                            @if ($bar->image2 || $bar->image3 || $bar->image4)
                                <a class="carousel-control-prev" href="#carousel-{{ $bar->id }}" role="button" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel-{{ $bar->id }}" role="button" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </a>
                            @endif
                        </div>
                        <div class="bar-details">
                            <h5 class="bar-title text-center">{{ $bar->nombre }}</h5>
                            <p class="bar-description">{{ Str::limit($bar->descripcion, 179, '...') }}</p>

                            <p><strong>Barrio:</strong> {{ $bar->barrio->title }}</p>
                        </div>
                        <div class="d-flex justify-content-center mb-2">
                            <a href="{{ route('bares.show', $bar->id) }}" class="btn btn-primary">Ver Detalles</a>
                        </div>
                        
                        @if (auth()->check() && auth()->user()->admin == 1)
                        <div class="text-center">
                            <form action="{{ route('bares.destroy', $bar) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mb-2">Eliminar</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <style>
        .bar-item {
            margin: 20px 0;
            background: rgba(0, 0, 0, 0.7);
            border: 1px solid #e1e1e1;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transition: background 0.3s;
        }

        .bar-item:hover {
            background: rgba(51, 165, 255, 0.8);
        }

        .carousel-inner img {
            width: 100%;
            height: auto;
        }

        .bar-details {
            padding: 20px;
        }

        .bar-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .bar-description {
            font-size: 1.2rem;
            margin-bottom: 10px;
            text-align: justify;
        }

        .text-center {
            text-align: center;
        }
    </style>
</x-layout>
