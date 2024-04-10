@extends('layouts.template')

@section('styles')
    <link href="/css/cards.css" rel="stylesheet">
    <link href="/css/filtros.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #mapa {
            height: 300px;
        }
    </style>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="filtros col-3">
            <!-- Contenido del div izquierdo aquí -->
            <div class="filters">
                <div class="h1 text-center text-dark" id="filtersHeaderTitle">Filtros</div>
                <div class="filter-option">
                    <h3 class="filter-title">Tipo</h3>
                    <ul class="filter-list">
                        <li class="filter-item">Evento</li>
                        <li class="filter-item">Podcast</li>
                    </ul>
                </div>
                <div class="filter-option">
                    <h3 class="filter-title">Duración</h3>
                    <ul class="filter-list">
                        <li class="filter-item">Menos de 30 mins</li>
                        <li class="filter-item">30 mins - 1 hora</li>
                        <li class="filter-item">Más de 1 hora</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col bg-white">
            <!-- Contenido del div derecho aquí -->
            <div class="btn-group btn-group-toggle" data-toggle="buttons" style="width: 100%;">
                <div class="container">
                    <nav>
                      <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Eventos</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Tienda</button>
                      </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                      <div class="tab-pane fade show active p-3" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <section class="light">
                            <div class="container py-2">
                                <div class="h1 text-center text-dark" id="pageHeaderTitle">
                                    <span style="display: inline-block; margin-bottom: 10px;">EVENTOS</span>
                                    <form method="GET" action="{{ route('createEvent') }}" style="display: inline-block; margin-left: 90px; margin-top: 10px;">
                                        <button type="submit" class="custom-button">
                                            <span>Crear Evento</span>
                                            <svg width="34" height="34" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="37" cy="37" r="35.5" stroke="white" stroke-width="3"></circle>
                                                <path d="M25 35.5C24.1716 35.5 23.5 36.1716 23.5 37C23.5 37.8284 24.1716 38.5 25 38.5V35.5ZM49.0607 38.0607C49.6464 37.4749 49.6464 36.5251 49.0607 35.9393L39.5147 26.3934C38.9289 25.8076 37.9792 25.8076 37.3934 26.3934C36.8076 26.9792 36.8076 27.9289 37.3934 28.5147L45.8787 37L37.3934 45.4853C36.8076 46.0711 36.8076 47.0208 37.3934 47.6066C37.9792 48.1924 38.9289 48.1924 39.5147 47.6066L49.0607 38.0607ZM25 38.5L48 38.5V35.5L25 35.5V38.5Z" fill="white"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>

                                @php $count = 0 @endphp
                                @foreach ($events as $event)
                                    @php
                                        // Obtén la ubicación del evento y divídela en latitud y longitud
                                        $ubicacion = $event->location;
                                        $ubicacion = trim($ubicacion, '()'); // Elimina los paréntesis
                                        list($latitud, $longitud) = explode(',', $ubicacion); // Divide la cadena en dos partes
                                        $latitud = floatval($latitud);
                                        $longitud = floatval($longitud);
                                    @endphp
                                    @if ($count % 2 == 0)
                                        <article class="postcard light blue">
                                            <div id="map{{$loop->iteration}}" style="width: 60%; height: 34c0px;"></div>
                                            <script>
                                                var map{{$loop->iteration}} = L.map('map{{$loop->iteration}}').setView([{{$latitud}}, {{$longitud}}], 13);
                                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                                    attribution: '© OpenStreetMap contributors'
                                                }).addTo(map{{$loop->iteration}});
                                                
                                                var marker{{$loop->iteration}} = L.marker([{{$latitud}}, {{$longitud}}]).addTo(map{{$loop->iteration}})
                                                    .bindPopup('Aquí será el evento')
                                                    .openPopup();
                                                map{{$loop->iteration}}.setView([{{$latitud}}, {{$longitud}}], 13);
                                            </script>
                                            <div class="postcard__text t-dark">
                                                <h1 class="postcard__title blue">{{$event->title}}</h1>
                                                <div class="postcard__subtitle small">
                                                    <time datetime="{{ $event->date }}T{{ $event->time }}">
                                                        <i class="fas fa-calendar-alt mr-2"></i>
                                                        {{ date('Y-m-d', strtotime($event->date)) }} {{ date('H:i', strtotime($event->time)) }}
                                                    </time>                                                    
                                                </div>
                                                <div class="postcard__bar"></div>
                                                <div class="postcard__preview-txt">{{$event->desc_location}}</div>
                                                <div class="postcard__preview-txt">{{$event->desc_event}}</div>
                                                <div class="postcard__preview-txt">Personas apuntadas: {{$event->personas_apuntadas}}</div>
                                                <ul class="postcard__tagbox">
                                                    <li class="tag__item"><i class="fas fa-tag mr-2"></i>Podcast</li>
                                                    <li class="tag__item"><i class="fas fa-clock mr-2"></i>55 mins.</li>
                                                    <li class="tag__item play blue">
                                                        <a href="#"><i class="fas fa-play mr-2"></i>Play Episode</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </article>
                                    @else
                                    @endif
                                    @php $count++ @endphp
                                @endforeach
                                                                
                                <article class="postcard light blue">
                                    <a class="postcard__img_link" href="#">
                                        <img class="postcard__img" src="https://picsum.photos/1000/1000" alt="Image Title" />
                                    </a>
                                    <div class="postcard__text t-dark">
                                        <h1 class="postcard__title blue">Título Evento</h1>
                                        <div class="postcard__subtitle small">
                                            <time datetime="2020-05-25 12:00:00">
                                                <i class="fas fa-calendar-alt mr-2"></i>Fecha y Hora
                                            </time>
                                        </div>
                                        <div class="postcard__bar"></div>
                                        <div class="postcard__preview-txt">Ubicacion</div>
                                        <div class="postcard__preview-txt">Duración</div>
                                        <div class="postcard__preview-txt">Personas apuntadas y rango de edad(min - max)</div>
                                        <ul class="postcard__tagbox">
                                            <li class="tag__item"><i class="fas fa-tag mr-2"></i>Podcast</li>
                                            <li class="tag__item"><i class="fas fa-clock mr-2"></i>55 mins.</li>
                                            <li class="tag__item play blue">
                                                <a href="#"><i class="fas fa-play mr-2"></i>Play Episode</a>
                                            </li>
                                        </ul>
                                    </div>
                                </article>
                                <article class="postcard light blue">
                                    <a class="postcard__img_link" href="#">
                                        <img class="postcard__img" src="https://picsum.photos/501/500" alt="Image Title" />	
                                    </a>
                                    <div class="postcard__text t-dark">
                                        <h1 class="postcard__title blue"><a href="#">Podcast Title</a></h1>
                                        <div class="postcard__subtitle small">
                                            <time datetime="2020-05-25 12:00:00">
                                                <i class="fas fa-calendar-alt mr-2"></i>Mon, May 25th 2020
                                            </time>
                                        </div>
                                        <div class="postcard__bar"></div>
                                        <div class="postcard__preview-txt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi, fugiat asperiores inventore beatae accusamus odit minima enim, commodi quia, doloribus eius! Ducimus nemo accusantium maiores velit corrupti tempora reiciendis molestiae repellat vero. Eveniet ipsam adipisci illo iusto quibusdam, sunt neque nulla unde ipsum dolores nobis enim quidem excepturi, illum quos!</div>
                                        <ul class="postcard__tagbox">
                                            <li class="tag__item"><i class="fas fa-tag mr-2"></i>Podcast</li>
                                            <li class="tag__item"><i class="fas fa-clock mr-2"></i>55 mins.</li>
                                            <li class="tag__item play blue">
                                                <a href="#"><i class="fas fa-play mr-2"></i>Play Episode</a>
                                            </li>
                                        </ul>
                                    </div>
                                </article>
                            </div>
                        </section>
                      </div>
                      <div class="tab-pane fade p-3" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <h2>Profile</h2>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi, cupiditate nam aperiam possimus, ratione modi enim inventore reiciendis ipsum mollitia, adipisci accusamus! Dolorem omnis illo incidunt ex, sit minus numquam.</p>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi, cupiditate nam aperiam possimus, ratione modi enim inventore reiciendis ipsum mollitia, adipisci accusamus! Dolorem omnis illo incidunt ex, sit minus numquam.</p>
                      </div>
                      <div class="tab-pane fade p-3" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <h2>Contact</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere voluptates nostrum vel officiis! Magni animi assumenda numquam exercitationem facilis! Excepturi, doloremque illo. Voluptate, natus molestias? Enim repellendus earum ad sunt!</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere voluptates nostrum vel officiis! Magni animi assumenda numquam exercitationem facilis! Excepturi, doloremque illo. Voluptate, natus molestias? Enim repellendus earum ad sunt!</p>
                      </div>
                    </div>
                  </div>
            </div>
            <div class="container">
                <div class="row">
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</script>
<!-- Incluye la biblioteca de Leaflet.js -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>


@endsection