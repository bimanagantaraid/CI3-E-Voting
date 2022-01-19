<table id="voting" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($voting as $v) :
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $v['nama'] ?></td>
                                    <td><?php echo deskripsipendek($v['deskripsi'], $v['voting_id']) ?></td>
                                    <td><?php echo ($v['is_active'] == 1) ? '<button class="btn btn-xs bg-lightblue">Aktif</button>':'<button class="btn btn-xs bg-maroon">Tidak aktif</button>' ?></td>
                                    <td>
                                        <a href="<?= base_url('voting/edit/') . $v['voting_id'] ?>" class="btn btn-xs btn-info"><i class="fas fa-edit"></i></a>
                                        <a href="<?= base_url('voting/hapus/') . $v['voting_id'] ?>" class="btn btn-xs btn-danger"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <!-- Modal -->
<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Voting</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control text-center" name="nama" id="nama" readonly>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi: </label>
                    <div name="deskripsi" id="deskripsi" cols="30" rows="40" readonly></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>