<x-layout>
    <div class="container mb-4">
        <h1 class="text-center mt-5 mb-4" style="text-align: center; font-family: 'Arial', 'Helvetica', sans-serif; color: #007BFF; font-size: 38px; text-transform: uppercase; margin-bottom: 20px; letter-spacing: 2px; border: 0.2px solid #ffffff;">Listado de Parques en Buenos Aires</h1>
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
    
                @foreach ($parques as $parque)
                    var marker = L.marker([{{ $parque->latitude }}, {{ $parque->longitude }}]).addTo(map);
                    marker.bindPopup("{{ $parque->nombre }}"); // Agrega una etiqueta emergente con el nombre del parque
                    marker.bindTooltip("{{ $parque->nombre }}").openTooltip(); // Agrega una etiqueta flotante con el nombre del parque y la abre por defecto
                @endforeach
            </script>
        </div>
    </div>
    



    <div class="container mb-3 w-75" style="text-align: center; font-family: 'Arial', 'Helvetica', sans-serif; color: #ffffff;  text-transform: uppercase; margin-bottom: 20px; letter-spacing: 2px; border: 0.2px solid #ffffff; ">
       
        <div class="row">
            @foreach ($parques as $parque)
                <div class="col-md-6">
                    <div class="parque-item" style="color: rgb(255, 255, 255); background: rgba(0, 0, 0, 0.7); border: 1px solid #e1e1e1; border-radius: 5px; overflow: hidden; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); transition: background 0.3s;">
                        <img src="{{ asset('storage/' . $parque->imagen) }}" alt="{{ $parque->nombre }}" style="max-width: 100%;">
                        <div class="parque-details">
                            <h5 class="parque-title text-center">{{ $parque->nombre }}</h5>
                            <p class="parque-description">{{ $parque->descripcion }}</p>
                            <p><strong>Calle:</strong> {{ $parque->calle }}</p>
                            <p><strong>Barrio:</strong> {{ $parque->barrio->title }}</p>
                        </div>

                        <a href="{{ route('parque.show', $parque) }}" class="btn btn-primary">Ver Detalles</a>

                        @if (auth()->check() && auth()->user() && auth()->user()->admin == 1)
                        <form action="{{ route('parques.destroy', $parque->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar Parque</button>
                        </form>
                    @endif
                    
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>

