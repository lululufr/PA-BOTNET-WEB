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
                    <th scope="col">Nom</th>
                    <th scope="col">IP privée</th>
                    <th scope="col">IP publique</th>
                    <th scope="col">MAC</th>
                    <th scope="col">OS</th>
                    <th scope="col">Date d'infection</th>
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
                        </tr>
                    @endforeach
                </tbody>
              </table>
              <!-- End Default Table Example -->
            </div>
          </div>
@endsection