@include('partials/header')
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.php" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Créer un compte</h5>
                    <p class="text-center small">Renseignez vos informations personnelles</p>
                  </div>

                  <form action="/login" method="post" class="row g-3 needs-validation" novalidate>
                    @csrf
                    <div class="col-12">
                      <label for="Nom" class="form-label">Nom</label>
                      <input type="text" name="nom" class="form-control" id="nom" required>
                      <div class="invalid-feedback">Merci de renseigner votre nom !</div>
                    </div>

                    <div class="col-12">
                      <label for="Prenom" class="form-label">Prenom</label>
                      <input type="text" name="prenom" class="form-control" id="prenom" required>
                      <div class="invalid-feedback">Merci de renseigner votre prenom !</div>
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

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Créer un compte</button>
                    </div>

                    <div class="col-12">
                      <p class="small mb-0">Un compte déjà existant ? <a href="login.php">Connexion</a></p>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->
@include('partials/footer')