@extends("layouts.layout")

@section("title", "Quick tools")

@section("content")


<div class="container-fluid">

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalphishing">
        Send direct phishing email
    </button>



</div>








    <!-- MODAL -->

<div class="modal fade" id="modalphishing" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

          <form action="/phising/send" method="POST">
            @csrf
            <div class="mb-3">
                A qui envoyer ->
                <input type="email" id="receiver" name="receiver">

            </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-primary">ENVOYER</button>
      </div>
          </form>
    </div>
  </div>
</div>


@endsection
