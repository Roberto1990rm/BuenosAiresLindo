<x-layout>
    <div>
        <div class="container mb-4">
            <h1 class="mt-2" style="text-align: center; font-family: 'Arial', 'Helvetica', sans-serif; color: #007BFF; font-size: 38px; text-transform: uppercase; margin-bottom: 20px; letter-spacing: 2px; border: 0.2px solid #ffffff; ">Explora los Barrios</h1>

            <div class="main-container">
                <div id="map" style="width: 100%; height: 400px; border-radius: 10px;"></div>

                <script src="https://cdn.jsdelivr.net/npm/ol/ol.js"></script>
                <script>
                    var map = new ol.Map({
                        target: 'map',
                        layers: [
                            new ol.layer.Tile({
                                source: new ol.source.OSM()
                            })
                        ],
                        view: new ol.View({
                            center: ol.proj.fromLonLat([-58.4173, -34.6118]),
                            zoom: 12
                        })
                    });
                
                    // Overlay para el tooltip
                    var tooltip = document.createElement('div');
                    tooltip.className = 'ol-tooltip';
                    tooltip.style.display = 'none';
                    var overlay = new ol.Overlay({
                        element: tooltip,
                        offset: [15, 0],
                        positioning: 'bottom-left'
                    });
                    map.addOverlay(overlay);
                
                    var tooltipTimeout;
                
                    @foreach ($barrios as $barrio)
                        var feature = new ol.Feature({
                            geometry: new ol.geom.Point(ol.proj.fromLonLat([{{ $barrio->longitude }}, {{ $barrio->latitude }}])),
                            title: '{{ $barrio->title }}',
                            body: '{{ Str::limit($barrio->body, 50, '...') }}',
                            id: '{{ $barrio->id }}'
                        });
                
                        var starStyle = new ol.style.Style({
                            image: new ol.style.RegularShape({
                                fill: new ol.style.Fill({ color: '#ffcc33' }),
                                stroke: new ol.style.Stroke({ color: '#ff0000', width: 1 }),
                                points: 5,
                                radius: 10,
                                radius2: 4,
                                angle: 0
                            })
                        });
                        feature.setStyle(starStyle);
                
                        var vectorSource = new ol.source.Vector({
                            features: [feature]
                        });
                
                        var markerVectorLayer = new ol.layer.Vector({
                            source: vectorSource,
                        });
                
                        map.addLayer(markerVectorLayer);
                    @endforeach
                
                    map.on('singleclick', function(evt) {
                        map.forEachFeatureAtPixel(evt.pixel, function(feature) {
                            var url = '/barrios/' + feature.get('id');
                            window.open(url, '_blank');
                        });
                    });
                
                    map.on('pointermove', function(evt) {
                        if (tooltipTimeout) {
                            clearTimeout(tooltipTimeout);
                        }
                
                        var showTooltip = map.forEachFeatureAtPixel(evt.pixel, function(feature) {
                            overlay.setPosition(evt.coordinate);
                            tooltip.innerHTML = '<strong>' + feature.get('title') + '</strong><br>' + feature.get('body') +
                                '<br><span style="text-decoration: underline; cursor: pointer;" onclick="window.open(\'/barrios/' + feature.get('id') + '\', \'_blank\');"></span>';
            tooltip.style.display = 'block';
                            return true;
                        });
                
                        if (!showTooltip) {
                            tooltipTimeout = setTimeout(function() { 
                                tooltip.style.display = 'none'; 
                            }, 3000);
                        }
                    });
                
                    map.on('pointerout', function() {
                        if (tooltipTimeout) {
                            clearTimeout(tooltipTimeout);
                        }
                        tooltipTimeout = setTimeout(function() { 
                            tooltip.style.display = 'none'; 
                        }, 3000);
                    });
                </script>
                
                
                
                <style>
                    .ol-tooltip {
                        background: rgba(255, 255, 255, 0.8);
                        border: 1px solid black;
                        padding: 4px 8px;
                        position: relative;
                        bottom: 15px;
                        left: -50%;
                        min-width: 100px;
                        text-align: center;
                        border-radius: 4px;
                        pointer-events: none; /* Importante para evitar problemas con eventos de mouse */
                    }
                </style>
                
            </div>

            <div class="row mt-4">
                @foreach ($barrios as $barrio)
                <div class="col-md-4">
                    <div class="card w-100 mt-1" style="cursor: pointer; transition: background-color 0.2s; background: rgba(0, 0, 0, 0.7);">
                        @if ($barrio->img && Storage::disk('public')->exists($barrio->img))
                            <img style="height: 150px;" class="card-img" src="{{ url('storage/' . $barrio->img) }}" alt="{{ $barrio->title }}">
                        @else
                            <img class="card-img" src="{{ asset('img/default.jpg') }}" alt="{{ $barrio->title }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title" style="color: #c9e87b;">{{ $barrio->title }}</h5>
                            <p class="card-text" style="color: #fff;">{{ Str::limit($barrio->body, 180, '...') }}</p> <!-- Aquí se hace el cambio -->
                            <div class="button-container d-flex justify-content-start align-items-center">
                                <a href="{{ route('barrios.show', $barrio) }}" class="btn btn-primary">Ver Detalles</a>
                                @if (auth()->check() && auth()->user()->admin == 1)
                                    <form action="{{ route('barrios.delete', ['id' => $barrio->id]) }}" method="POST" class="ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger rounded-circle" style="width: 30px; height: 30px; padding: 0; line-height: 30px; text-align: center;">
                                            <i class="bi bi-x"></i> <!-- Ícono de Bootstrap -->
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
            
                      
                    </div>
                </div>
            @endforeach
            
        </div>
    </div>
</x-layout>

<style>
 
        .card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: auto; /* Ajusta según tus necesidades */
        }

        .card-body {
            flex-grow: 1;
    overflow: hidden; /* Oculta el contenido que excede el espacio */
        }

        .card-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }


.card-title, .card-text {
    white-space: wrap;
    overflow: hidden;
    text-overflow: ellipsis; /* Muestra puntos suspensivos si el texto es demasiado largo */
}


    </style>

