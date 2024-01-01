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
                        <!-- Bordered Tabs Justified -->
                        <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                            <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-home" type="button" role="tab" aria-controls="home" aria-selected="true">Victimes</button>
                            </li>
                            <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Attaques</button>
                            </li>
                            <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Informations</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                            <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel" aria-labelledby="home-tab">
                            <section class="section">
                                <table class="table">
                                    <tbody>
                                        @foreach ($victims as $victim)
                                            <tr>
                                                <th scope="row">
                                                    <?php
                                                        if ($victim->OS == "Windows") {
                                                            echo "<i class=\"bx bxl-windows\"></i>";
                                                        } else if ($victim->OS == "Linux") {
                                                            echo "<i class=\"bx bxl-tux\"></i>";
                                                        } else if ($victim->OS == "MacOS") {
                                                            echo "<i class=\"bx bxl-apple\"></i>";
                                                        }
                                                    ?>
                                                </th>
                                                <td>{{ $victim->nom }}</td>
                                                <td>{{ $victim->version }}</td>
                                                <td>{{ $victim->IP_publique }}</td>
                                                <td>
                                                    <a class="btn btn-primary">Connexion</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="bordered-justified-profile" role="tabpanel" aria-labelledby="profile-tab">
                            Nesciunt totam et. Consequuntur magnam aliquid eos nulla dolor iure eos quia. Accusantium distinctio omnis et atque fugiat. Itaque doloremque aliquid sint quasi quia distinctio similique. Voluptate nihil recusandae mollitia dolores. Ut laboriosam voluptatum dicta.
                            </div>
                            <div class="tab-pane fade" id="bordered-justified-contact" role="tabpanel" aria-labelledby="contact-tab">
                                <p class="card-text">Créé le {{ $groupe->created_at }}</p>
                                <p class="card-text"><small class="text-muted">Dernière mise à jour le {{ $groupe->updated_at }}</small></p>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-start">
                                        <form action="{{ route('network.destroy', $groupe->id) }}" method="POST">
                                            @csrf
                                            <button name="id" class="btn btn-danger" type="submit">Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Bordered Tabs Justified -->
                </div>
            </div>
        </div>
    </div>
</section>

@endsection