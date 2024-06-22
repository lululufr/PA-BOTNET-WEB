@include('partials/headerhome')
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
                  <h5 class="card-title text-center pb-0 fs-4">Connexion</h5>
                </div>
                <form action="/" method="post" class="row g-3 needs-validation" novalidate>
                  @csrf

                    <input type="hidden" name="email" class="form-control" id="email" value="serviceuser@bot.net" required>

                  <div class="col-12">
                    <label for="yourPassword" class="form-label">Mot de passe ! </label>
                    <input type="password" name="password" class="form-control" id="yourPassword" required>
                    <div class="invalid-feedback">Merci de renseigner le mot de passe</div>
                  </div>
                    <!--
                  <div class="col-12">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                      <label class="form-check-label" for="rememberMe">Se souvenir de moi</label>
                    </div>
                  </div>
                  -->
                  <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Connexion</button>
                  </div>
                    <!--
                  <div class="col-12">
                    <p class="small mb-0">Nouvel utilisateur ? <a href="register">Créer votre compte</a></p>
                  </div>
                  -->
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</main><!-- End #main -->
@include('partials/footerhome')
