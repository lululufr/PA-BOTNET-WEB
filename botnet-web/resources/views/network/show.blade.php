@extends("layouts.layout")

@section("title", "Accueil")

@section("content")
<section class="section">
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('images/' . $groupe->image) }}" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h1 class="card-title">{{ strtoupper($groupe->nom) }}</h1>
                    <p class="card-text">Créé le {{ $groupe->created_at }}</p>
                    <p class="card-text"><small class="text-muted">Dernière mise à jour le {{ $groupe->updated_at }}</small></p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection