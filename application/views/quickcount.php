<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Voting</title>
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/home.css') ?>">
    <!-- ion icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body>
    <?php $this->load->view('home_nav') ?>

    <main class="main">
        <div class="container calonpasangan">
            <div class="container update-suara text-center">
                <a href="<?= base_url('vote/quickcount') ?>" class="btn btn-success">
                    <span style="padding-left: 2px;">update suara</span>
                    <ion-icon name="refresh-outline"></ion-icon>
                </a>
            </div>
            <div class="container d-flex justify-content-center">
                <div class="row">
                    <?php foreach ($suara as $p) : ?>
                        <div class="col-sm">
                            <div class="card" style="width: 18rem;">
                                <img src="<?= base_url() ?>assets/image/calonpasangan/<?= $p['image'] ?>" class="card-img-top img-paslon">
                                <div class="card-body">
                                    <p class="card-title text-center"><?= $p['nama_paslon'] ?></p>
                                    <div class="card__description">
                                        <div class="btn btn-info">Jumlah Suara : <span class="suara"><?= $p['suara'] ?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="chart">
            <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-nama" id="modal-nama">

                        </div>
                        <div class="modal-deskripsi" id="modal-deskripsi">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?= base_url('assets/') ?>plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/chart.js/Chart.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>assets/dist/js/custom.js"></script>
    <script src="<?= base_url('assets/') ?>dist/js/adminlte.js"></script>
    <script>
        $(document).ready(() => {
            var donutData = {
                labels: [
                    <?php foreach ($suara as $s) : ?> '<?= $s['nama_paslon'] ?> ( No Urut : <?= $s['no_paslon'] ?>)',
                    <?php endforeach; ?>
                ],
                datasets: [{
                    data: [
                        <?php foreach ($suara as $s) : ?> '<?= $s['suara'] ?>',
                        <?php endforeach; ?>
                    ],
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12'],
                }]
            }
            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData = donutData;
            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })
        })
    </script>
</body>

</html>