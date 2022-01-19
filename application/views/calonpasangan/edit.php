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
                    <form action="<?= base_url('calonpasangan/edit/') . $paslon['paslon_id'] ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama">Voting</label>
                            <input type="text" value="<?= $voting['voting_id'] ?>" name="voting_id" hidden>
                            <input type="text" class="form-control" value="<?= $voting['nama'] ?>" disabled>
                            <?= form_error('nama', '<span class="invalid-input">', '</span>') ?>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="nama_paslon">Nomor urut pasangan</label>
                                    <input type="text" class="form-control" name="no_paslon" id="no_paslon" value="<?= $paslon['no_paslon'] ?>">
                                    <?= form_error('no_paslon', '<span class="invalid-input">', '</span>') ?>
                                </div>
                                <div class="form-group">
                                    <label for="nama_paslon">Nama pasangan</label>
                                    <input type="text" class="form-control" name="nama_paslon" id="nama_paslon" value="<?= $paslon['nama_paslon'] ?>"">
                                    <?= form_error('nama_paslon', '<span class="invalid-input">', '</span>') ?>
                                </div>
                                <div class=" form-group">
                                    <label for="exampleInputFile">Gambar pasangan</label>
                                    <br>
                                    <?php
                                    $image = $paslon['image'];
                                    if (file_exists(FCPATH . "assets/image/calonpasangan/$image")) {
                                    ?>
                                        <img src="<?= base_url('assets/image/calonpasangan/') . $paslon['image'] ?>" alt="paslon-img" class="mb-2 mt-2" style="width: 80px;height: 80px;object-fit: cover;border-radius: 50%;">
                                    <?php
                                    } else {
                                        echo "-";
                                    }
                                    ?>
                                    <input type="text" value="<?= $paslon['image'] ?>" name="hiddenImage" hidden>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile" name="image">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <div class="form-group">
                                    <label for="visi_misi">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" id="deskripsi" cols="30" rows="35"><?= $paslon['deskripsi'] ?></textarea>
                                    <?= form_error('deskripsi', '<span class="invalid-input">', '</span>') ?>
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