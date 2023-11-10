<!DOCTYPE html>
<html>
<head>
    <title>{{ $title ?? 'BuenosAiresLindo.com' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
    <link href="{{ asset('css/globalstyles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<!-- Incluir CSS de Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<!-- Coloca esto en el <head> o al final del <body> de tu plantilla principal -->
<script src="https://cdn.tiny.cloud/1/l75m3smh1dz3mwy419v875a4691p4ttba07aiu4zedr1hj68/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol/ol.css" type="text/css">
<script src="https://cdn.jsdelivr.net/npm/ol/ol.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/openlayers/dist/ol.css" type="text/css">
<script src="https://cdn.jsdelivr.net/npm/openlayers/dist/ol.js"></script>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
    <title>{{ $title ?? 'buenosaireslindo.com' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <x-navbar />

    <div class="wrapper">
        {{$slot}}
    </div>
    
  
    
    <x-footer />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    
  
    
</body>
</html>