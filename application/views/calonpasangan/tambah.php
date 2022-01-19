<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 d-flex justify-content-center">
            <div class="col-sm-12 d-flex align-item-center justify-content-between">
                <h1 class="m-0"><?= $titlepage ?></h1>
                <a href="<?= base_url('calonpasangan') ?>" class="btn btn-sm btn-warning"><i class="fas fa-undo-alt"></i></a>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <?php
                    if ($this->session->flashdata('message')) {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                    ?>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('calonpasangan/tambah') ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama">Voting</label>
                            <select name="voting_id" id="voting_id" class="form-control">
                                <?php foreach ($voting as $v) : ?>
                                    <option value="<?= $v['voting_id'] ?>"><?= $v['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('nama', '<span class="invalid-input">', '</span>') ?>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="nama_paslon">Nomor urut pasangan</label>
                                    <input type="text" class="form-control" name="no_paslon" id="no_paslon" value="<?= set_value('no_paslon') ?>">
                                    <?= form_error('no_paslon', '<span class="invalid-input">', '</span>') ?>
                                </div>
                                <div class="form-group">
                                    <label for="nama_paslon">Nama pasangan</label>
                                    <input type="text" class="form-control" name="nama_paslon" id="nama_paslon" value="<?= set_value('nama_paslon') ?>"">
                                    <?= form_error('nama_paslon', '<span class="invalid-input">', '</span>') ?>
                                </div>
                                <div class=" form-group">
                                    <label for="exampleInputFile">Gambar pasangan</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile" name="image">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                    <?= form_error('nama_paslon', '<span class="invalid-input">', '</span>') ?>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <div class="form-group">
                                    <label for="visi_misi">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" id="deskripsi" cols="30" rows="35"><?= set_value('deskripsi') ?></textarea>
                                    <?= form_error('visi_misi', '<span class="invalid-input">', '</span>') ?>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(() => {
        $('#deskripsi').summernote({
            height: 400
        });
        $('#voting_id').select2();
        $('#deskripsi').summernote();
        bsCustomFileInput.init();
    })
</script>