<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Voting</title>
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/home.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <!-- ion icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body>
    <?php $this->load->view('home_nav') ?>

    <main class="main">
        <section class="home" id="home">
            <div class="home__container container grid">
                <img src="<?= base_url('') ?>assets/dist/img/page/home.svg" class="home__img">

                <div class="home__data">
                    <h1 class="home__title">
                        E-Voting
                    </h1>
                    <p class="home__description">
                        Selamat datang di <span class="font-weight-bold"><?= $voting[0]['nama']?></span>. Silahkan gunakan suara anda untuk calon pasangan pilihan anda.
                    </p>
                    <div class="home__button">
                        <a href="#" class="button-voting">Voting</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?= base_url() ?>assets/dist/js/custom.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/') ?>dist/js/adminlte.js"></script>
</body>

</html>