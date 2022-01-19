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
        <div class="col-sm-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <?= form_error('nama', '<div class="alert alert-warning" role="alert">', '</div>') ?>
                    <?= $this->session->userdata('message');?>
                    <a href="<?= base_url('menu/submenu')?>" class="btn btn-primary float-right">
                        <i class="fas fa-bars"></i> Sub Menu
                    </a>
                    <button type="button" class="btn btn-primary float-right mr-2" data-toggle="modal" data-target="#editModal">
                        Tambah menu
                    </button>
                    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalTitle">Tambah Menu</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= base_url('menu') ?>" method="POST">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nameEdit">Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="menu" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Menu</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($menu as $m) :
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $m['nama'] ?></td>
                                    <td>
                                        <a href="" class="btn btn-xs btn-info"><i class="fas fa-edit"></i></a>
                                        <a href="" class="btn btn-xs btn-danger"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#menu').DataTable({
            "autoWidth": false,
            "columnDefs": [{
                "width": "5%",
                "targets": 0
            }]
        });
    })
</script>