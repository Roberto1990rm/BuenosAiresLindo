<x-layout>
    <div>
        <div class="container mb-4">
            <h1 class="mt-2" style="text-align: center; font-family: 'Arial', 'Helvetica', sans-serif; color: #007BFF; font-size: 38px; text-transform: uppercase; margin-bottom: 20px; letter-spacing: 2px; border: 0.2px solid #ffffff; ">Explora los Barrios</h1>

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
                    
                    @foreach ($barrios as $barrio)
                        var marker = L.marker([{{ $barrio->latitude }}, {{ $barrio->longitude }}]).addTo(map);
                        marker.bindPopup("{{ $barrio->title }}"); // Esto agrega una etiqueta emergente con el nombre del barrio
                        marker.bindTooltip("{{ $barrio->title }}").openTooltip(); // Esto agrega una etiqueta flotante con el nombre del barrio y la abre por defecto
                    @endforeach
                </script>
            </div>

            <div class="row mt-4">
                @foreach ($barrios as $barrio)
                    <div class="col-md-4">
                        <div class="card w-50" style="cursor: pointer; transition: background-color 0.2s; background: rgba(0, 0, 0, 0.7);">
                            @if ($barrio->img && Storage::disk('public')->exists($barrio->img))
                            <img src="{{ url('storage/' . $barrio->img) }}" class="card-img-top" alt="{{ $barrio->title }}">
                            @else
                            <img src="{{ asset('img/default.jpg') }}" class="card-img-top" alt="{{ $barrio->title }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title" style="color: #fff;">{{ $barrio->title }}</h5>
                                <p class="card-text" style="color: #fff;">{{ $barrio->body }}</p>
                                <a href="#" class="btn btn-primary">Ver Detalles</a>
                            </div>

                            @if (auth()->check() && auth()->user()->admin == 1)
                            <div class="text-center mb-2">
                                <form action="{{ route('barrios.delete', ['id' => $barrio->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar Barrio</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>



