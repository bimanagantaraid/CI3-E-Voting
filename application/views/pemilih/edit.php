<div class="content-header">
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-sm col-md-6 col-sm-12 d-flex justify-content-between">
                <h4 class="m-0"><?= $titlepage ?></h4>
                <a href="<?= base_url('pemilih/index') ?>" class="btn btn-sm btn-warning"><i class="fas fa-undo-alt"></i></a>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="row justify-content-md-center">
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('pemilih/edit/') . $pemilih['pemilih_id'] ?>" method="POST">
                        <div class="form-group">
                            <label for="no_resmi_instansi">No Resmi Identitas</label>
                            <input type="text" class="form-control" name="pemilih_id" value="<?= $pemilih['pemilih_id'] ?>" hidden>
                            <input type="text" class="form-control" name="no_identitas_resmi" value="<?= $pemilih['no_identitas_resmi'] ?>">
                            <?= form_error('no_identitas_resmi', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" value="<?= $pemilih['nama'] ?>">
                            <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" value="<?= $pemilih['username'] ?>">
                            <?= form_error('username', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" name="password" value="<?= $pemilih['password'] ?>">
                            <?= form_error('password', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="password">Jenis kelamin</label>
                            <input type="text" class="form-control" name="jenis_kelamin" value="<?= $pemilih['jenis_kelamin'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="<?= $pemilih['alamat'] ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>