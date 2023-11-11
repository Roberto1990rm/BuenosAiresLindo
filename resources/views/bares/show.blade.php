<x-layout>
    <div class="container">
        <h2 class="title text-center" style="color: rgb(8, 67, 103)">{{ $bar->nombre }}</h2>

        <!-- Carrusel de imágenes -->
        <div id="carouselBar" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ([$bar->image1, $bar->image2, $bar->image3, $bar->image4] as $index => $img)
                    @if ($img)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $img) }}" class="d-block w-100" alt="Imagen del bar">
                        </div>
                    @endif
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselBar" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselBar" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
            </a>
        </div>

        <!-- Detalles del bar -->
        <div class="body-text" style="background-color: rgba(255, 253, 253, 0.5);">
            <p><strong>Descripción:</strong> {{ $bar->descripcion }}</p>
            <p><strong>Dirección:</strong> {{ $bar->direccion }}</p>
            <p><strong>Barrio:</strong> {{ $bar->barrio->title }}</p>
            <p><strong>Precios:</strong> {{ $bar->precios }}</p>
            <p><strong>Horario:</strong> {{ $bar->horario }}</p>
        </div>

        <div id="map" style="width: 100%; height: 400px;"></div>
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
            center: ol.proj.fromLonLat([{{ $bar->longitude }}, {{ $bar->latitude }}]),
            zoom: 15
        })
    });

    var starStyle = new ol.style.Style({
        image: new ol.style.RegularShape({
            fill: new ol.style.Fill({ color: 'yellow' }),
            stroke: new ol.style.Stroke({ color: 'black', width: 1 }),
            points: 5,
            radius: 10,
            radius2: 4,
            angle: 0
        })
    });

    var marker = new ol.Feature({
        geometry: new ol.geom.Point(ol.proj.fromLonLat([{{ $bar->longitude }}, {{ $bar->latitude }}]))
    });

    marker.setStyle(starStyle);

    var vectorSource = new ol.source.Vector({
        features: [marker]
    });

    var vectorLayer = new ol.layer.Vector({
        source: vectorSource
    });

    map.addLayer(vectorLayer);
        
            // Crear un overlay con el nombre y la dirección
            var element = document.createElement('div');
            element.innerHTML = "<b>{!! $bar->nombre !!}</b><br>{!! $bar->direccion !!}";
            element.className = 'ol-tooltip';
        
            var popup = new ol.Overlay({
                element: element,
                positioning: 'bottom-center',
                stopEvent: false,
                offset: [0, -50]
            });
        
            map.addOverlay(popup);
            popup.setPosition(ol.proj.fromLonLat([{{ $bar->longitude }}, {{ $bar->latitude }}]));
        </script>
        
    </div>
    <div class="text-center">
        <a href="{{ url('/bares') }}" class="btn mt-3 mb-3 danger">Volver</a>
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
