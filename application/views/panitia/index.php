<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $titlepage ?></h1>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= $pemilih ?></sup></h3>

                        <p>Pemilih</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-person-booth"></i>
                    </div>
                    <a href="<?= base_url('pemilih') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>
                            <?php
                            $persen = ((int)$suara / (int)$pemilih) * 100;
                            echo round($persen, 2);
                            ?>
                            <sup style="font-size: 20px">%
                        </h3>
                        <p>Jumlah Suara Masuk : <?= $suara ?></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="<?= base_url('voting/rekapitulasi') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-sm-12">
                <div class="card">
                    <div class="card-header">Data suara</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <h6 class="text-center">Chart</h6>
                                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                                    <canvas id="pieChart" height="300" style="height: 300px;"></canvas>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <h6 class="text-center">Detail suara</h6>
                                <?php
                                $warna = array('#f56954', '#00a65a', '#f39c12', '#111');
                                $i = 0;
                                foreach ($suaramasuk as $s) :
                                    $persen = ((int)$s['suara'] / (int)$pemilih) * 100
                                ?>
                                    <div class="progress-group">
                                        <?= $s['nama_paslon'] ?>
                                        <span class="float-right"><b><?= $s['suara'] ?></b>/<?= $pemilih ?></span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar" style="width: <?= $persen ?>%; background: <?= $warna[$i++] ?>"></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(() => {
        var warna = ['#f56954', '#00a65a', '#f39c12', '#111'];
        var donutData = {
            datasets: [{
                data: [
                    <?php
                    foreach ($suaramasuk as $s) :
                    ?> '<?= $s['suara'] ?>',
                    <?php endforeach; ?>
                ],
                backgroundColor: warna,
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