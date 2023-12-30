@include('partials/header')

<main id="main" class="main">

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ajout d'un nouveau réseau</h5>

                        <!-- General Form Elements -->
                        <form action="/network" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Nom</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nom" required>
                                    <div class="invalid-feedback">Merci d'ajouter un nom pour le réseau.</div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Image de présentation</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="image" id="formFile" required>
                                    <div class="invalid-feedback">Merci d'ajouter une image.</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <button class="btn btn-primary" type="submit">Créer un réseau</button>
                                </div>
                            </div>
                        </form><!-- End General Form Elements -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>
    
    <div class="card mb-3">
      <div class="row g-0">
        <div class="col-md-4">
          <img src="assets/img/card.jpg" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">Card with an image on left</h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          </div>
        </div>
      </div>
    </div>

</main><!-- End #main -->

@include('partials/footer')