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
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-start">
                <div class="col-sm-10">
                    <form class="form-horizontal" method="POST" action="<?= base_url('user/gantipassword') ?>">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-4 col-form-label">Password sekarang</label>
                            <div class="col-sm-8">
                                <input type="text" name="user_id" value="<?= $user['user_id'] ?>" hidden>
                                <input type="password" class="form-control" id="passwordnow" name="passwordnow" value="<?= set_value('passwordnow') ?>">
                                <?= form_error('passwordnow', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-4 col-form-label">Password baru</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="password" name="password" value="<?= set_value('password') ?>">
                                <?= form_error('password', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName2" class="col-sm-4 col-form-label">Konfirmasi password baru</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="confpassword" name="confpassword" value="<?= set_value('confpassword') ?>">
                                <?= form_error('confpassword', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-4 col-sm-8">
                                <button type="submit" class="btn btn-danger">Ganti Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
<?php

if ($this->session->flashdata('message')) {
?>
    <script>
        $(document).ready(() => {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            })
            Toast.fire({
                icon: '<?= $_SESSION['message']['icon'] ?>',
                title: '<?= $_SESSION['message']['message'] ?>',
                text: 'Tunggu 3 detik anda akan akan keluar!'
            })
            var timer = setTimeout(function() {
                window.location = '<?= base_url('auth/logout') ?>'
            }, 3000);
        })
    </script>

<?php
}
?>