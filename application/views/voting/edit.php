<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 d-flex justify-content-center">
            <div class="col-sm-6 d-flex align-item-center justify-content-between">
                <h1 class="m-0"><?= $titlepage ?></h1>
                <a href="<?= base_url('voting') ?>" class="btn btn-sm btn-warning"><i class="fas fa-undo-alt"></i></a>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <?php
                    if ($this->session->flashdata('message')) {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                    ?>
                    <h5>Data</h5>

                </div>
                <div class="card-body">
                    <form action="<?= base_url('voting/edit/'.$voting['voting_id'])?>" method="POST">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="voting_id" id="voting_id" value="<?= $voting['voting_id']?>" hidden>
                            <input type="text" class="form-control" name="nama" id="nama" value="<?= $voting['nama']?>">
                            <?= form_error('nama', '<span class="invalid-input">', '</span>') ?>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" id="deskripsi" cols="30" rows="40"><?= $voting['deskripsi']?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(() => {
        $('#deskripsi').summernote({
            height: 200
        });
    })
</script>