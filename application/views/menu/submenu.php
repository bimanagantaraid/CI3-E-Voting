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
        <div class="col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <?= form_error('nama', '<div class="alert alert-warning" role="alert">', '</div>') ?>
                    <?= $this->session->userdata('message'); ?>
                    <button type="button" class="btn btn-primary float-right mr-2" data-toggle="modal" data-target="#editModal">
                        Tambah Sub Menu
                    </button>
                    <div class="modal fade" id="editModal" aria-labelledby="editModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalTitle">Tambah Sub Menu</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= base_url('menu/submenu') ?>" method="POST">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Menu</label>
                                            <select class="form-control menu" name="nav_menu_id" style="width: 100%;">
                                                <?php foreach ($menu as $mn) : ?>
                                                    <option value="<?= $mn['nav_menu_id'] ?>"><?= $mn['nama'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="nameEdit">Sub Menu</label>
                                            <input type="text" class="form-control" id="name" name="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="urlTambah">Url</label>
                                            <input type="text" class="form-control" id="url" name="url">
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch1" name="is_active">
                                            <label class="custom-control-label" for="customSwitch1">Aktif?</label>
                                        </div>
                                        <br>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
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
                                <th>Submenu</th>
                                <th>Menu</th>
                                <th>Url</th>
                                <th>Icon</th>
                                <th>Active</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($submenu as $sm) :
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $sm['name'] ?></td>
                                    <td><?= $sm['nama_menu'] ?></td>
                                    <td><?= $sm['url'] ?></td>
                                    <td><?= $sm['icon'] ?></td>
                                    <td>
                                        <?php if ($sm['is_active'] == 1) : ?>
                                            <span class="text-primary font-weight-bold">Active</span>
                                        <?php else : ?>
                                            <span class="text-dark font-weight-bold">Non Active</span>
                                        <?php endif; ?>
                                    </td>
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

        $('.menu').select2();

    })
</script>