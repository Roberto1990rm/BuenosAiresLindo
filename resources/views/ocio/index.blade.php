<x-layout>
    <div class="container">





        <h1 class="mt-3" style="text-align: center; font-family: 'Arial', 'Helvetica', sans-serif; color: #007BFF; font-size: 38px; text-transform: uppercase; margin-bottom: 20px; letter-spacing: 2px; border: 0.2px solid #ffffff;">Actividades</h1>
       
       
       
       
        <div id="map" class="map" style="width: 100%; height: 400px;"></div>

        <script type="text/javascript">
            var map = new ol.Map({
                target: 'map',
                layers: [
                    new ol.layer.Tile({
                        source: new ol.source.OSM()
                    })
                ],
                view: new ol.View({
                    center: ol.proj.fromLonLat([-58.4173, -34.6118]), // Longitud, latitud del centro del mapa
                    zoom: 12
                })
            });
        
            // Overlay para el tooltip
            var overlay = new ol.Overlay({
                element: document.createElement('div'),
                positioning: 'bottom-center',
                offset: [0, -10],
                stopEvent: false
            });
            overlay.getElement().classList.add('ol-tooltip');
            map.addOverlay(overlay);
        
            @foreach ($ocios as $ocio)
                var marker = new ol.Feature({
                    geometry: new ol.geom.Point(ol.proj.fromLonLat([{{ $ocio->longitude }}, {{ $ocio->latitude }}])),
                    name: '{{ $ocio->nombre }}',
                    description: '{{ $ocio->descripcion }}'
                });
        
                var vectorSource = new ol.source.Vector({
                    features: [marker]
                });
        
                var markerVectorLayer = new ol.layer.Vector({
                    source: vectorSource,
                });
        
                map.addLayer(markerVectorLayer);
            @endforeach
        
            // Evento para mostrar el tooltip
            map.on('pointermove', function (evt) {
                var feature = map.forEachFeatureAtPixel(evt.pixel, function(feature) {
                    return feature;
                });
                var element = overlay.getElement();
                if (feature) {
                    element.innerHTML = feature.get('name') + '<br>' + feature.get('description');
                    overlay.setPosition(evt.coordinate);
                    element.style.display = 'block';
                } else {
                    element.style.display = 'none';
                }
            });
        </script>
        
        
       
       
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align: center; vertical-align: middle; background-color: aqua; opacity: 0.9;">Actividad</th>
                    <th style="text-align: center; vertical-align: middle; background-color: rgb(128, 255, 0); opacity: 0.9;">Descripción</th>
                    <th style="text-align: center; vertical-align: middle; background-color: aqua; opacity: 0.9;">Imagen</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ocios as $ocio)
                    <tr>
                        <td style="text-align: center; vertical-align: middle; opacity: 0.9;">{{ $ocio->nombre }}</td>
                        <td style="text-align: center; vertical-align: middle; opacity: 0.9;">
                            {{ $ocio->descripcion }}
                            <form action="{{ route('ocio.destroy', $ocio->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                @if (auth()->check() && auth()->user()->admin == 1)
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este registro?')">Eliminar</button>
                                @endif
                            </form>
                        </td>
                        <td style="text-align: center; vertical-align: middle; opacity: 0.9;">
                            <div id="ocioCarousel{{ $ocio->id }}" class="carousel slide" data-ride="carousel" style="margin: auto; width: 50%;"><!-- Adjust width as needed -->
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    @if ($ocio->imagen)
                                        <li data-target="#ocioCarousel{{ $ocio->id }}" data-slide-to="0" class="active"></li>
                                    @endif
                                    <!-- ... other indicators ... -->
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    @if ($ocio->imagen)
                                        <div class="carousel-item active">
                                            <img src="{{ asset('storage/' . $ocio->imagen) }}" alt="{{ $ocio->nombre }}" class="d-block w-100">
                                        </div>
                                    @endif
                                    @if ($ocio->imagen2)
                                    <div class="carousel-item">
                                        <img src="{{ asset('storage/' . $ocio->imagen2) }}" alt="{{ $ocio->nombre }}" class="d-block w-100">
                                    </div>
                                @endif
                                @if ($ocio->imagen3)
                                    <div class="carousel-item">
                                        <img src="{{ asset('storage/' . $ocio->imagen3) }}" alt="{{ $ocio->nombre }}" class="d-block w-100">
                                    </div>
                                @endif
                                @if ($ocio->imagen4)
                                    <div class="carousel-item">
                                        <img src="{{ asset('storage/' . $ocio->imagen4) }}" alt="{{ $ocio->nombre }}" class="d-block w-100">
                                    </div>
                                @endif
                                    <!-- Repeat for other images -->
                                </div>

                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#ocioCarousel{{ $ocio->id }}" role="button" data-slide="prev" style="width: 5%; height: 100%; align-items: center; justify-content: center; display: flex; position: absolute; top: 0; bottom: 0; left: 0; z-index: 10;">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#ocioCarousel{{ $ocio->id }}" role="button" data-slide="next" style="width: 5%; height: 100%; align-items: center; justify-content: center; display: flex; position: absolute; top: 0; bottom: 0; right: 0; z-index: 10;">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
