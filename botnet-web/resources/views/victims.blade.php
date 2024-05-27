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
                    <th>IP publique</th>
                    <th>Date d'infection</th>
                    <th>Attribution</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($victims as $victim)
                        <tr>
                            <th scope="row">{{ $victim->id }}</th>
                            <td>{{ $victim->ip }}</td>
                            <td>{{ $victim->created_at }}</td>
                            <td>
                                <form action="{{ route('victims.update', $victim->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                        <select class="form-select" name="groupe" id="validationDefault04" required>
                                            @foreach ($groups as $group)
                                                <option value="{{ $group->id }}">{{ $group->name }}</option>
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