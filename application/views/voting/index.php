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
    <div class="row">
        <div class="col-sm">
            <div class="card">
                <div class="card-header">
                    <?php
                    if ($this->session->flashdata('message')) {
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                    ?>
                    <h5>Konfigurasi Voting</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">
                            <?php if ($voting) : ?>
                                <form action="<?= base_url('voting/edit') ?>" method="POST">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" name="voting_id" id="voting_id" value="<?= $voting['voting_id'] ?>" hidden>
                                        <input type="text" class="form-control" name="nama" id="nama" value="<?= $voting['nama'] ?>">
                                        <?= form_error('nama', '<span class="invalid-input">', '</span>') ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <label for="deskripsi">Deskripsi</label>
                                                <textarea name="deskripsi" class="form-control" id="deskripsi" cols="30" rows="40"><?= $voting['deskripsi'] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="Status">Status</label>
                                                <div class="custom-control custom-switch mb-2">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch1" name="is_active" <?php echo ($voting['is_active'] == 1) ? 'checked' : '' ?>>
                                                    <label class="custom-control-label" for="customSwitch1"><?php echo ($voting['is_active'] == 1) ? 'Aktif' : 'Tutup' ?></label>
                                                </div>
                                                <?= form_error('is_active', '<span class="invalid-input">', '</span>') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            <?php else : ?>
                                <a href="<?= base_url('voting/tambah') ?>" class="btn btn-sm btn-primary">Buat Voting</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    var detail;
    $(document).ready(function() {
        $('#voting').DataTable();
        $('#deskripsi').summernote({
            height: 400,
            callbacks: {
                onImageUpload: (files, editor, welEditable) => {
                    uploadImage(files[0], editor, welEditable);
                },
                onMediaDelete: (files, editor, welEditable, target) => {
                    deleteImage(files[0].src);
                }
            }
        });

        function uploadImage(files, editor, welEditable) {
            var imageFile = new FormData();
            imageFile.append("file", files);
            $.ajax({
                url: "<?php echo site_url('voting/upload_image') ?>",
                cache: false,
                contentType: false,
                processData: false,
                data: imageFile,
                type: "POST",
                success: function(response) {
                    $('#deskripsi').summernote('insertImage', response);
                },
                error: function(imageFile) {
                    console.log(imageFile);
                }
            });
        }

        function deleteImage(src) {
            console.log(src);
            $.ajax({
                data: {
                    src: src
                },
                type: "POST",
                url: "<?php echo site_url('voting/delete_image') ?>",
                cache: false,
                success: function(response) {
                }
            });
        }

        $('#customSwitch1').change(function() {
            if (this.checked) {
                Swal.fire('Status voting dirubah!', 'Silahkan simpan untuk menyimpan konfigurasi', 'success')
                $(this).prop("checked");
            } else {
                Swal.fire('Status voting dirubah!', 'Silahkan simpan untuk menyimpan konfigurasi', 'success')
                $(this).prop("");
            }
        });
    })
</script>