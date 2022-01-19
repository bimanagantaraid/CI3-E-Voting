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
        <section class="vote" id="vote">
            <h5><?= $voting[0]['nama'] ?></h5>
            <div class="vote__container">
                <?php

                foreach ($paslon as $p) :

                ?>
                    <div class="card">
                        <div class="card__title">
                            <p class="card__title-info">No urut</p>
                            <p class="card__title-value"><?= $p['no_paslon'] ?></p>
                        </div>
                        <div class="card__image">
                            <img src="<?= base_url() ?>assets/image/calonpasangan/<?= $p['image'] ?>">
                        </div>
                        <div class="nama_paslon">
                            <?= $p['nama_paslon'] ?>
                        </div>
                        <div class="card__description">
                            <div class="btn btn-info" paslon_id="<?= $p['paslon_id'] ?>">Visi Misi</div>
                        </div>
                        <div class="card__footer">
                            <?php

                            if ($pemilihstatus) {

                            ?>
                                <button class="btn btn-sm btn-danger" disabled>Anda sudah memilih</button>
                                <small class="text-danger">*Suara hanya berhak memilih 1 kali</small>
                                <?php

                            } else {
                                if ($this->session->userdata('pemilih_id')) {

                                ?>
                                    <button class="btn-vote" paslon_id="<?= $p['paslon_id'] ?>" pemilih_id="<?= $pemilih['pemilih_id'] ?>">Vote</button>
                                <?php
                                } else {
                                ?>
                                    <a class="btn-sm btn-warning text-center" href="<?= base_url('auth/loginpemilih') ?>">Vote</a>
                                    <small class="text-center text-danger">Vote (Login untuk memilih)</small>
                            <?php
                                }
                            }

                            ?>
                        </div>
                    </div>

                <?php

                endforeach;

                ?>
            </div>
        </section>
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
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>assets/dist/js/custom.js"></script>
    <script src="<?= base_url('assets/') ?>dist/js/adminlte.js"></script>
</body>

</html>