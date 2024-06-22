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

                  <div class="col-12">
                    <button class="btn btn-primary w-100  m-1" type="submit">
                        Connexion
                    </button>

                      <button type="button" class="btn btn-secondary w-100 m-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                          J'ai un compte spécifique
                      </button>
                  </div>

                </form>




              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/" method="post" class="row g-3 needs-validation" novalidate>
                        @csrf
                        <div class="col-12">
                            <label for="yourPassword" class="form-label">Email</label>
                            <input type="text" name="email" class="form-control" id="email" required>
                        </div>

                        <div class="col-12">
                            <label for="yourPassword" class="form-label">Mot de passe ! </label>
                            <input type="password" name="password" class="form-control" id="yourPassword" required>
                            <div class="invalid-feedback">Merci de renseigner le mot de passe</div>
                        </div>
                </div>
                <div class="modal-footer">

                    <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Connexion</button>
                    </div>
                    </form>
                </div>

            </div>

        </div>
    </div>



</main><!-- End #main -->
@include('partials/footerhome')
