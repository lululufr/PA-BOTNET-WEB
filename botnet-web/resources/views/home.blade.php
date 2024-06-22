@extends("layouts.layout")

@section("title", "Accueil")

@section("content")


  <div class="card">
    <div class="card-body">
        <h5 class="card-title">Serveur Python</h5>
        <!-- Affichage des messages d'erreur ou de succès -->

            @if(is_array(session('output')) && count(session('output')) > 0)
                <div class="alert alert-info">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Argument</th>
                            <th scope="col">Description</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach (session('output') as $flag => $description)
                                <tr>

                                    <td><strong>{{ $flag }} </strong> </td>
                                    <td>{{ $description }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        @elseif(session('output') !== null)

                <div class="alert alert-info">
                    {{ session('output') }}
                </div>
            @endif

        @if(!$botnetRunning)
            <form method="POST" action="/botnet-on">
                @csrf
                <div class="row mb-3">
                    <div class="row mb-3">
                      <label for="inputText" class="col-sm-3 col-form-label">Port d'écoute (1023 - 65535)</label>
                      <div class="col-sm-2">
                        <input type="number" class="form-control" name="port" required min="1023" max="65535">
                      </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Allumer</button>
            </form>
        @else
            <form method="POST" action="/botnet-off">
                @csrf
                <button type="submit" class="btn btn-danger">Éteindre</button>
            </form>
        @endif
    </div>
  </div>

  <form method="POST" action="/aide_botnet">
    @csrf
    <div class="card">
          <div class="card-body">

            <h5 class="card-title">Afficher les options botnet</h5>
            <button type="submit" class="btn btn-primary">Options</button>

          </div>
        </div>
  </form>



<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Dernières attaques</h5>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Type</th>
                                <th>Statut</th>
                                <th>Resultats</th>
                                <th>Date de lancement</th>
                                <th>Date de fin exécution</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($attacks) && count($attacks) > 0)
                                @foreach($attacks as $attack)
                                    <tr>
                                        <td>{{ $attack['id'] }}</td>
                                        <td>{{ $attack['type'] }}</td>
                                        <td>{{ $attack['status'] }}</td>
                                        <td>{{ $attack['results']}}</td>
                                        <td>{{ $attack['timestamp_start'] }}</td>
                                        <td>{{ $attack['timestamp_end'] }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">Aucune attaque trouvée</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>
        </div>
    </div>
</section>

      <div class="row">

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Victimes inféctées</h5>

              <!-- Line Chart -->
              <canvas id="lineChart" style="max-height: 400px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#lineChart'), {
                    type: 'line',
                    data: {
                      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                      datasets: [{
                        label: 'Victimes',
                        data: [65, 59, 80, 81, 56, 55, 40],
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                      }]
                    },
                    options: {
                      scales: {
                        y: {
                          beginAtZero: true
                        }
                      }
                    }
                  });
                });
              </script>
              <!-- End Line CHart -->

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Nouveaux utilisateurs</h5>

              <!-- Bar Chart -->
              <canvas id="barChart" style="max-height: 400px;"></canvas>
                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        var months = {!! $months !!}; // Récupérer les mois depuis le contrôleur
                        var userRegistrationCounts = {!! $userRegistrationCounts !!}; // Récupérer les compteurs d'inscription depuis le contrôleur

                        new Chart(document.querySelector('#barChart'), {
                            type: 'bar',
                            data: {
                                labels: months,
                                datasets: [{
                                    label: 'Utilisateurs',
                                    data: userRegistrationCounts,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(255, 159, 64, 0.2)',
                                        'rgba(255, 205, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(201, 203, 207, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgb(255, 99, 132)',
                                        'rgb(255, 159, 64)',
                                        'rgb(255, 205, 86)',
                                        'rgb(75, 192, 192)',
                                        'rgb(54, 162, 235)',
                                        'rgb(153, 102, 255)',
                                        'rgb(201, 203, 207)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    });
                </script>
                <!-- End Bar Chart -->


            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Systèmes d'exploitations</h5>

              <!-- Pie Chart -->
              <canvas id="pieChart" style="max-height: 400px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#pieChart'), {
                    type: 'pie',
                    data: {
                      labels: [
                        'MacOS',
                        'Windows',
                        'Linux'
                      ],
                      datasets: [{
                        label: 'My First Dataset',
                        data: [300, 50, 100],
                        backgroundColor: [
                          'rgb(255, 99, 132)',
                          'rgb(54, 162, 235)',
                          'rgb(255, 205, 86)'
                        ],
                        hoverOffset: 4
                      }]
                    }
                  });
                });
              </script>
              <!-- End Pie CHart -->

            </div>
          </div>
        </div>

      <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Réseaux infectés</h5>

                <!-- Radial Bar Chart -->
                <div id="radialBarChart"></div>

                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        var networkData = {!! $networkCount !!}; // Récupérer le nombre de réseaux infectés depuis le contrôleur

                        new ApexCharts(document.querySelector("#radialBarChart"), {
                            series: [networkData],
                            chart: {
                                height: 420,
                                type: 'radialBar',
                                toolbar: {
                                    show: true
                                }
                            },
                            plotOptions: {
                                radialBar: {
                                    dataLabels: {
                                        name: {
                                            fontSize: '22px',
                                        },
                                        value: {
                                            fontSize: '16px',
                                            show: true
                                        },
                                        total: {
                                            show: true,
                                            label: 'Total',
                                            formatter: function (w) {
                                                return networkData;
                                            }
                                        }
                                    }
                                }
                            },
                            labels: ["Réseaux infectés"],
                        }).render();
                    });
                </script>
                <!-- End Radial Bar Chart -->

            </div>
        </div>
    </div>


    <div id="terminal"></div>
@endsection
