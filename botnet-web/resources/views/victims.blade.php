@extends("layouts.layout")

@section("title", "Postes infectés")

@section("content")

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Postes infectés non attribués</h5>

                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    <!-- Table pour les victimes non attribuées -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th>UID</th>
                                <th>IP publique</th>
                                <th>Date d'infection</th>
                                <th>Attribution</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unsigned_victims as $victim)
                            <tr>
                                <th scope="row">{{ $victim->id }}</th>
                                <td><a href="{{ route('victims.show', ['id' => $victim->id]) }}" class="card-link">{{ $victim->uid }}</a></td>
                                <td>{{ $victim->ip }}</td>
                                <td>{{ $victim->created_at }}</td>
                                <td>
                                    <form action="{{ route('victims.update', $victim->id) }}" method="POST"
                                        class="d-flex align-items-center">
                                        @csrf
                                        @method('PUT')
                                        <div class="col-md-3">
                                            <select class="form-select" name="group" required>
                                                @foreach ($groups as $group)
                                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Attribuer</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Fin de la table pour les victimes non attribuées -->

                    <!-- Table pour toutes les victimes -->
                    <h5 class="card-title mt-4 pt-4">Postes infectés </h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th>UID</th>
                                <th>IP publique</th>
                                <th>Date d'infection</th>
                                <th>Groupe attribué</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_victims as $victim)
                            <tr>
                                <th scope="row">{{ $victim->id }}</th>
                                <td><a href="{{ route('victims.show', ['id' => $victim->id]) }}" class="card-link">{{ $victim->uid }}</a></td>
                                <td>{{ $victim->ip }}</td>
                                <td>{{ $victim->created_at }}</td>
                                <td>
                                    @if ($victim->victimGroups->isNotEmpty())
                                        {{ $victim->victimGroups->first()->network->name }}
                                    @else
                                        Non attribué
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Fin de la table pour toutes les victimes -->
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
