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
            @if(auth()->check())
                <form action="{{ route('logout') }}" method="GET">
                    @csrf
                    <div class="buttons_izquierda_logout">
                        <button type="submit" class="custom-button">
                            <span>Logout</span>
                            <svg width="34" height="34" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="37" cy="37" r="35.5" stroke="white" stroke-width="3"></circle>
                                <path d="M25 35.5C24.1716 35.5 23.5 36.1716 23.5 37C23.5 37.8284 24.1716 38.5 25 38.5V35.5ZM49.0607 38.0607C49.6464 37.4749 49.6464 36.5251 49.0607 35.9393L39.5147 26.3934C38.9289 25.8076 37.9792 25.8076 37.3934 26.3934C36.8076 26.9792 36.8076 27.9289 37.3934 28.5147L45.8787 37L37.3934 45.4853C36.8076 46.0711 36.8076 47.0208 37.3934 47.6066C37.9792 48.1924 38.9289 48.1924 39.5147 47.6066L49.0607 38.0607ZM25 38.5L48 38.5V35.5L25 35.5V38.5Z" fill="white"></path>
                            </svg>
                        </button>
                    </div>
                </form>
                @if(auth()->user()->image == '')
                    <img src="/img/usuario.png" alt="Imagen predeterminada">
                @else
                    <img src="data:image/png;base64,{{ auth()->user()->image }}" alt="Imagen de usuario">
                @endif    
                <div class="buttons_izquierda">
                    <button type="submit" class="custom-button">
                        <span>Mis eventos</span>
                        <svg width="34" height="34" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="37" cy="37" r="35.5" stroke="white" stroke-width="3"></circle>
                            <path d="M25 35.5C24.1716 35.5 23.5 36.1716 23.5 37C23.5 37.8284 24.1716 38.5 25 38.5V35.5ZM49.0607 38.0607C49.6464 37.4749 49.6464 36.5251 49.0607 35.9393L39.5147 26.3934C38.9289 25.8076 37.9792 25.8076 37.3934 26.3934C36.8076 26.9792 36.8076 27.9289 37.3934 28.5147L45.8787 37L37.3934 45.4853C36.8076 46.0711 36.8076 47.0208 37.3934 47.6066C37.9792 48.1924 38.9289 48.1924 39.5147 47.6066L49.0607 38.0607ZM25 38.5L48 38.5V35.5L25 35.5V38.5Z" fill="white"></path>
                        </svg>
                    </button>
                </div>
                <div class="buttons_izquierda">
                    <button type="submit" class="custom-button">
                        <span>Eventos apuntado</span>
                        <svg width="34" height="34" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="37" cy="37" r="35.5" stroke="white" stroke-width="3"></circle>
                            <path d="M25 35.5C24.1716 35.5 23.5 36.1716 23.5 37C23.5 37.8284 24.1716 38.5 25 38.5V35.5ZM49.0607 38.0607C49.6464 37.4749 49.6464 36.5251 49.0607 35.9393L39.5147 26.3934C38.9289 25.8076 37.9792 25.8076 37.3934 26.3934C36.8076 26.9792 36.8076 27.9289 37.3934 28.5147L45.8787 37L37.3934 45.4853C36.8076 46.0711 36.8076 47.0208 37.3934 47.6066C37.9792 48.1924 38.9289 48.1924 39.5147 47.6066L49.0607 38.0607ZM25 38.5L48 38.5V35.5L25 35.5V38.5Z" fill="white"></path>
                        </svg>
                    </button>
                </div>
            @else
                @if(!session()->has('form_login') || session()->get('form_login') == 0)
                    <div class="buttons_izquierda">
                        <div class="text_login">
                            <h2>¡Acelera tu emoción!<br>Únete a AquaConnect<br>y vive la adrenalina <br>en cada ola</h2>
                        </div>
                        <form action="{{ route('active_login') }}" method="GET">
                            @csrf
                            <button type="submit" class="custom-button">
                                <span>Iniciar Sesión</span>
                                <svg width="34" height="34" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="37" cy="37" r="35.5" stroke="white" stroke-width="3"></circle>
                                    <path d="M25 35.5C24.1716 35.5 23.5 36.1716 23.5 37C23.5 37.8284 24.1716 38.5 25 38.5V35.5ZM49.0607 38.0607C49.6464 37.4749 49.6464 36.5251 49.0607 35.9393L39.5147 26.3934C38.9289 25.8076 37.9792 25.8076 37.3934 26.3934C36.8076 26.9792 36.8076 27.9289 37.3934 28.5147L45.8787 37L37.3934 45.4853C36.8076 46.0711 36.8076 47.0208 37.3934 47.6066C37.9792 48.1924 38.9289 48.1924 39.5147 47.6066L49.0607 38.0607ZM25 38.5L48 38.5V35.5L25 35.5V38.5Z" fill="white"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                    <div class="buttons_izquierda">
                        <form action="{{ route('active_register') }}" method="GET">
                        @csrf
                            <button type="submit" class="custom-button">
                                <span>Registrarse</span>
                                <svg width="34" height="34" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="37" cy="37" r="35.5" stroke="white" stroke-width="3"></circle>
                                    <path d="M25 35.5C24.1716 35.5 23.5 36.1716 23.5 37C23.5 37.8284 24.1716 38.5 25 38.5V35.5ZM49.0607 38.0607C49.6464 37.4749 49.6464 36.5251 49.0607 35.9393L39.5147 26.3934C38.9289 25.8076 37.9792 25.8076 37.3934 26.3934C36.8076 26.9792 36.8076 27.9289 37.3934 28.5147L45.8787 37L37.3934 45.4853C36.8076 46.0711 36.8076 47.0208 37.3934 47.6066C37.9792 48.1924 38.9289 48.1924 39.5147 47.6066L49.0607 38.0607ZM25 38.5L48 38.5V35.5L25 35.5V38.5Z" fill="white"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                @elseif(session()->has('form_login') && session()->get('form_login') == 1)
                    <div class="buttons_izquierda">
                        <div class="text_login">
                            <h2>Iniciar Sesión</h2>
                        </div>
                        <form action="{{route('checkLogin')}}" method="POST">
                            @csrf
                            <div>
                                <input type="text" name="usernameLogin" id="usernameLogin" placeholder="Username" class="">
                                @error('usernameLogin')
                                    <p class="error-message">{{$message}}</p>
                                @enderror
                            </div>
                        
                            <div>
                                <input type="password" name="passwordLogin" id="passwordLogin" placeholder="Contraseña" class="">
                                @error('passwordLogin')
                                    <p class="error-message">{{$message}}</p>
                                @enderror
                            </div>
                        
                            <div class="recuperarContra">
                                <a id="show-recoverPassword">¿Olvidó su contraseña?</a>
                            </div>
                        
                            <div>
                                <button type="submit" class="custom-button">
                                    <span>Iniciar Sesión</span>
                                    <svg width="34" height="34" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="37" cy="37" r="35.5" stroke="white" stroke-width="3"></circle>
                                        <path d="M25 35.5C24.1716 35.5 23.5 36.1716 23.5 37C23.5 37.8284 24.1716 38.5 25 38.5V35.5ZM49.0607 38.0607C49.6464 37.4749 49.6464 36.5251 49.0607 35.9393L39.5147 26.3934C38.9289 25.8076 37.9792 25.8076 37.3934 26.3934C36.8076 26.9792 36.8076 27.9289 37.3934 28.5147L45.8787 37L37.3934 45.4853C36.8076 46.0711 36.8076 47.0208 37.3934 47.6066C37.9792 48.1924 38.9289 48.1924 39.5147 47.6066L49.0607 38.0607ZM25 38.5L48 38.5V35.5L25 35.5V38.5Z" fill="white"></path>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="buttons_izquierda mr-3">
                        <form action="{{route('index')}}" method="POST">
                            @csrf
                            <button type="submit" class="custom-button">
                                <span>Volver</span>
                                <svg width="34" height="34" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="37" cy="37" r="35.5" stroke="white" stroke-width="3"></circle>
                                    <path d="M25 35.5C24.1716 35.5 23.5 36.1716 23.5 37C23.5 37.8284 24.1716 38.5 25 38.5V35.5ZM49.0607 38.0607C49.6464 37.4749 49.6464 36.5251 49.0607 35.9393L39.5147 26.3934C38.9289 25.8076 37.9792 25.8076 37.3934 26.3934C36.8076 26.9792 36.8076 27.9289 37.3934 28.5147L45.8787 37L37.3934 45.4853C36.8076 46.0711 36.8076 47.0208 37.3934 47.6066C37.9792 48.1924 38.9289 48.1924 39.5147 47.6066L49.0607 38.0607ZM25 38.5L48 38.5V35.5L25 35.5V38.5Z" fill="white"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                @elseif(session()->has('form_login') && session()->get('form_login') == 2)
                    <div class="buttons_izquierda">
                        <div class="text_login">
                            <h2>Registrarse</h2>
                        </div>
                        <form action="{{route('checkRegister')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <input type="text" name="nameRegister" id="nameRegister" placeholder="Nombre" value="{{ old('nameRegister') }}">
                                @error('nameRegister')
                                    <p class="error-message">{{$message}}</p>
                                @enderror
                            </div>
                        
                            <div>
                                <input type="text" name="surnameRegister" id="surnameRegister" placeholder="Apellido" value="{{ old('surnameRegister') }}">
                                @error('surnameRegister')
                                    <p class="error-message">{{$message}}</p>
                                @enderror
                            </div>

                            <div>
                                <input type="text" name="usernameRegister" id="usernameRegister" placeholder="Username" value="{{ old('usernameRegister') }}">
                                @error('usernameRegister')
                                    <p class="error-message">{{$message}}</p>
                                @enderror
                            </div>

                            <div>
                                <input type="mail" name="mailRegister" id="mailRegister" placeholder="Mail" value="{{ old('mailRegister') }}">
                                @error('mailRegister')
                                    <p class="error-message">{{$message}}</p>
                                @enderror
                            </div>

                            <div>
                                <input type="number" name="ageRegister" id="ageRegister" placeholder="Edad" value="{{ old('ageRegister') }}">
                                @error('ageRegister')
                                    <p class="error-message">{{$message}}</p>
                                @enderror
                            </div>

                            <div>
                                <input type="password" name="passwordRegister" id="passwordRegister" placeholder="Contraseña">
                                @error('passwordRegister')
                                    <p class="error-message">{{$message}}</p>
                                @enderror
                            </div>

                            <div>
                                <label>Foto de Perfil</label>
                                <input type="file" name="imageRegister" id="imageRegister" placeholder="image">
                                @error('imageRegister')
                                    <p class="error-message">{{$message}}</p>
                                @enderror
                            </div>
                        
                            <div>
                                <button type="submit" class="custom-button-register">
                                    <span>Registrarse</span>
                                    <svg width="34" height="34" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="37" cy="37" r="35.5" stroke="white" stroke-width="3"></circle>
                                        <path d="M25 35.5C24.1716 35.5 23.5 36.1716 23.5 37C23.5 37.8284 24.1716 38.5 25 38.5V35.5ZM49.0607 38.0607C49.6464 37.4749 49.6464 36.5251 49.0607 35.9393L39.5147 26.3934C38.9289 25.8076 37.9792 25.8076 37.3934 26.3934C36.8076 26.9792 36.8076 27.9289 37.3934 28.5147L45.8787 37L37.3934 45.4853C36.8076 46.0711 36.8076 47.0208 37.3934 47.6066C37.9792 48.1924 38.9289 48.1924 39.5147 47.6066L49.0607 38.0607ZM25 38.5L48 38.5V35.5L25 35.5V38.5Z" fill="white"></path>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="buttons_izquierda mr-3">
                        <form action="{{route('index')}}" method="POST">
                            @csrf
                            <button type="submit" class="custom-button">
                                <span>Volver</span>
                                <svg width="34" height="34" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="37" cy="37" r="35.5" stroke="white" stroke-width="3"></circle>
                                    <path d="M25 35.5C24.1716 35.5 23.5 36.1716 23.5 37C23.5 37.8284 24.1716 38.5 25 38.5V35.5ZM49.0607 38.0607C49.6464 37.4749 49.6464 36.5251 49.0607 35.9393L39.5147 26.3934C38.9289 25.8076 37.9792 25.8076 37.3934 26.3934C36.8076 26.9792 36.8076 27.9289 37.3934 28.5147L45.8787 37L37.3934 45.4853C36.8076 46.0711 36.8076 47.0208 37.3934 47.6066C37.9792 48.1924 38.9289 48.1924 39.5147 47.6066L49.0607 38.0607ZM25 38.5L48 38.5V35.5L25 35.5V38.5Z" fill="white"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                @endif
            @endif
        </div>
        <div class="derecha col bg-white">
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
                                @foreach ($events as $event)
                                    @php
                                        $ubicacion = $event->location;
                                        $ubicacion = trim($ubicacion, '()'); 
                                        list($latitud, $longitud) = explode(',', $ubicacion);
                                        $latitud = floatval($latitud);
                                        $longitud = floatval($longitud);
                                    @endphp
                                        <article class="postcard light blue">
                                            <div id="map{{$loop->iteration}}" class="map"></div>
                                            <script>
                                                var map{{$loop->iteration}} = L.map('map{{$loop->iteration}}').setView([{{$latitud}}, {{$longitud}}], 13);
                                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                                    attribution: '© OpenStreetMap contributors'
                                                }).addTo(map{{$loop->iteration}});
                                                
                                                var marker{{$loop->iteration}} = L.marker([{{$latitud}}, {{$longitud}}]).addTo(map{{$loop->iteration}})
                                                    .bindPopup('Aquí será el evento')
                                                    .openPopup();
                                                map{{$loop->iteration}}.setView([{{$latitud}}, {{$longitud + 0.03}}], 13);
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
                                                    <form action="{{ route('apuntarseAlEveneto', ['eventId' => $event->id, 'userId' => auth()->user()->id]) }}" method="GET">
                                                        @csrf
                                                        <button type="submit" class="custom-button apuntarse">Apuntarme al evento</button>
                                                    </form>
                                                    <button onclick="toggleDropdown({{$event->id}})" class="custom-button ver-listado" data-id="{{ $event->id }}">Ver personas apuntadas</button>                                                
                                                </ul>
                                            </div>
                                        </article>
                                @endforeach
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
                        <div id="usersDropdown" class="users-dropdown">
                            <h4>PERSONAS APUNTADAS</h4>
                            
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function obtenerDatos(eventId) {
        $(document).ready(function(){
            $.ajax({
                url: 'http://localhost/obtener_eventos.php?id=' + eventId, // Incluir la ID del evento en la URL
                method: 'GET', 
                dataType: 'json', 
                success: function(data) {
                    mostrarDatos(data); // Llama a la función para mostrar los datos
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener los datos de la tabla de eventos:', error);
                }
            });
        });
    }

    function mostrarDatos(data) {
        console.log(data);
        var usersDropdown = document.getElementById('usersDropdown');
        var html = "<h4 style='margin-top:30px; margin-bottom: -150px;'>PERSONAS APUNTADAS AL EVENTO </h4>";
        // Recorre los datos y construye el HTML para mostrarlos
        data.forEach(function(item) {
            html += "<p style='color:black'>ID: " + item.id + ", ID de usuario: " + item.id_user + "</p>";
        });
        // Actualiza el contenido del usersDropdown con el HTML generado
        usersDropdown.innerHTML = html;
        // Muestra el usersDropdown
        usersDropdown.style.right = '0';
    }

    function toggleDropdown(eventId) {
        var usersDropdown = document.getElementById('usersDropdown');
        if (usersDropdown.style.right === '0px') {
            usersDropdown.style.right = '-800px'; 
        } else {
            obtenerDatos(eventId); 
            usersDropdown.style.right = '0';
        }
    }
</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</scrip>
<!-- Incluye la biblioteca de Leaflet.js -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>


@endsection