@extends("layouts.layout")

@section("title", "Utilisateurs")

@section("content")

    <div class="m-auto mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Créer un utilisateur
        </button>
    </div>


    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Utilisateurs</h5>
              @if (session('success'))
                <div class="alert alert-success">
                  {{ session('success') }}
                </div>
              @endif
              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Inscription</th>
                    <th scope="col">Mis à jour</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->firstname }}</td>
                        <td>{{ $user->lastname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                            @if($user->email != "serviceuser@bot.net")
                        <td>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </tr>
                        @else
                        <td>
                            <button class="btn" disabled>Supprimer</button>
                        </td>
                        @endif
                    @endforeach
                </tbody>
              </table>
              <!-- End Default Table Example -->
            </div>
          </div>



            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/register" method="post" class="row g-3 needs-validation" novalidate>
                                @csrf
                                <div class="col-12">
                                    <label for="Nom" class="form-label">Nom</label>
                                    <input type="text" name="lastname" class="form-control" id="lastname" required>
                                    <div class="invalid-feedback">Merci de renseigner votre nom !</div>
                                </div>

                                <div class="col-12">
                                    <label for="Prenom" class="form-label">Prenom</label>
                                    <input type="text" name="firstname" class="form-control" id="firstname" required>
                                    <div class="invalid-feedback">Merci de renseigner le prenom !</div>
                                </div>

                                <div class="col-12">
                                    <label for="yourEmail" class="form-label">Mail</label>
                                    <input type="email" name="email" class="form-control" id="email" required>
                                    <div class="invalid-feedback">Merci de renseigner une adresse mail valide !</div>
                                </div>

                                <div class="col-12">
                                    <label for="yourPassword" class="form-label">Mot de passe</label>
                                    <input type="password" name="password" class="form-control" id="password" required>
                                    <div class="invalid-feedback">Merci de renseigner un mot de passe !</div>
                                </div>

                        <div class="modal-footer">

                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">Créer un compte</button>
                            </div>

                        </div>
                            </form>
                    </div>
                </div>
            </div>




@endsection
