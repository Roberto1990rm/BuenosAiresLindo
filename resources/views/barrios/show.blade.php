<x-layout>
    <div class="container text-center">
        <h1 class="title" style="color: rgb(8, 67, 103)">{{ $barrio->title }}</h1>

        <!-- Carrusel de imágenes -->
        <div id="carouselBarrio" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach ([$barrio->img, $barrio->imagen2, $barrio->imagen3, $barrio->imagen4, $barrio->imagen5] as $index => $img)
                    @if ($img)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $img) }}" class="d-block w-100" alt="Imagen del Barrio">
                        </div>
                    @endif
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselBarrio" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselBarrio" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
            </a>
        </div>

        <!-- Texto del cuerpo con opacidad en el fondo -->
        <div class="body-text" style="background-color: rgba(255, 253, 253, 0.5);">
            <p>{{ $barrio->body }}</p>
        </div>

        @if($barrio->latitude && $barrio->longitude)
        <div id="map" style="width: 100%; height: 400px;"></div>
        <script>
            var bares = @json($bares);
            var parques = @json($parques);
        
            var map = new ol.Map({
                target: 'map',
                layers: [new ol.layer.Tile({ source: new ol.source.OSM() })],
                view: new ol.View({
                    center: ol.proj.fromLonLat([{{ $barrio->longitude }}, {{ $barrio->latitude }}]),
                    zoom: 14
                })
            });
        
            // Crear un tooltip
            var tooltip = document.createElement('div');
            tooltip.className = 'ol-tooltip';
            document.body.appendChild(tooltip);
            var overlay = new ol.Overlay({
                element: tooltip,
                offset: [0, -15],
                positioning: 'bottom-center'
            });
            map.addOverlay(overlay);
        
            // Añadir marcadores para cada bar
            bares.forEach(function(bar) {
                var barCoords = [parseFloat(bar.longitude), parseFloat(bar.latitude)];
                var barFeature = new ol.Feature({
                    geometry: new ol.geom.Point(ol.proj.fromLonLat(barCoords)),
                    nombre: bar.nombre,
                    direccion: bar.direccion
                });
        
                var style = new ol.style.Style({
                    image: new ol.style.RegularShape({
                        fill: new ol.style.Fill({ color: 'gold' }),
                        stroke: new ol.style.Stroke({ color: 'black', width: 1 }),
                        points: 5,
                        radius: 10,
                        radius2: 4,
                        angle: 0
                    })
                });
                barFeature.setStyle(style);
        
                var vectorSource = new ol.source.Vector({
                    features: [barFeature]
                });
        
                var markerVectorLayer = new ol.layer.Vector({
                    source: vectorSource,
                });
        
                map.addLayer(markerVectorLayer);
            });



            parques.forEach(function(parque) {
            var parqueCoords = [parseFloat(parque.longitude), parseFloat(parque.latitude)];
            var parqueFeature = new ol.Feature({
                geometry: new ol.geom.Point(ol.proj.fromLonLat(parqueCoords)),
                nombre: parque.nombre,
                calle: parque.calle
            });

            var style = new ol.style.Style({
                image: new ol.style.RegularShape({
                    fill: new ol.style.Fill({ color: 'green' }),
                    stroke: new ol.style.Stroke({ color: 'black', width: 1 }),
                    points: 3,
                    radius: 10,
                    angle: Math.PI / 4
                })
            });
            parqueFeature.setStyle(style);

            var vectorSource = new ol.source.Vector({
                features: [parqueFeature]
            });

            var markerVectorLayer = new ol.layer.Vector({
                source: vectorSource,
            });

            map.addLayer(markerVectorLayer);
        });

        
            // Mostrar tooltip al pasar el mouse sobre los marcadores
            map.on('pointermove', function(evt) {
                var showTooltip = false;
                map.forEachFeatureAtPixel(evt.pixel, function(feature) {
                    if (feature.get('nombre')) {
                        overlay.setPosition(evt.coordinate);
                        tooltip.innerHTML = '<strong>' + feature.get('nombre') + '</strong><br>' + feature.get('direccion');
                        tooltip.style.display = 'block';
                        showTooltip = true;
                    }
                });
        
                if (!showTooltip) {
                    tooltip.style.display = 'none';
                }
            });
        </script>
        
        
    @endif

        <!-- Botón de regreso con estilos .danger -->
        <a href="{{ url('/barrios/index') }}" class="btn mt-3 mb-3 danger">Volver a barrios</a>

    </div>

    <!-- Estilos personalizados -->
    <style>
        .title, .body-text {
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }
        .body-text {
            margin: 0 auto;
            text-align: justify;
            max-width: 800px;
            max-height: 300px;
            overflow-y: scroll;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f8f9fa;
        }
        .danger {
            background-color: #e05b5b;
        }
        .danger:hover {
            background-color: #fa0606;
        }
    </style>
</x-layout>
