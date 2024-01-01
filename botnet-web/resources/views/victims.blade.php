@extends("layouts.layout")

@section("title", "Postes infectés")

@section("content")

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Postes infectés non attribués</h5>

              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th>Nom</th>
                    <th>IP privée</th>
                    <th>IP publique</th>
                    <th>MAC</th>
                    <th>OS</th>
                    <th>Date d'infection</th>
                    <th>Attribution</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($victims as $victim)
                        <tr>
                            <th scope="row">{{ $victim->id }}</th>
                            <td>{{ $victim->nom }}</td>
                            <td>{{ $victim->IP_privee }}</td>
                            <td>{{ $victim->IP_publique }}</td>
                            <td>{{ $victim->MAC }}</td>
                            <td>{{ $victim->OS }}</td>
                            <td>{{ $victim->created_at }}</td>
                            <td>
                                <form action="{{ route('victims.update', $victim->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                        <select class="form-select" name="groupe" id="validationDefault04" required>
                                            @foreach ($groupes as $groupe)
                                                <option value="{{ $groupe->id }}">{{ $groupe->nom }}</option>
                                            @endforeach
                                        </select>
                                    <button type="submit" class="btn btn-primary">Attribuer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
              <!-- End Default Table Example -->
            </div>
          </div>
@endsection