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
                    <h5>Data</h5>
                    <a href="<?= base_url('calonpasangan/tambah') ?>" class="btn btn-sm btn-primary float-right"><i class="fas fa-plus-square"></i> Tambah</a>
                </div>
                <div class="card-body">
                    <table id="paslon" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Voting</th>
                                <th>No Pasangan</th>
                                <th>Nama Pasangan</th>
                                <th>Gambar Pasangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($paslon as $p) :
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $p['namaVoting'] ?></td>
                                    <td><?= $p['no_paslon'] ?></td>
                                    <td><?= $p['nama_paslon'] ?></td>
                                    <td>
                                        <?php
                                        $image = $p['image'];
                                        if (file_exists(FCPATH . "assets/image/calonpasangan/$image")) {
                                        ?>
                                            <img src="<?= base_url('assets/image/calonpasangan/') . $p['image'] ?>" alt="paslon-img" class="mb-2 mt-2" style="width: 80px;height: 80px;object-fit: cover;border-radius: 50%;">
                                        <?php
                                        } else {
                                            echo "-";
                                        }
                                        ?>

                                    </td>
                                    <td>
                                        <a href="<?= base_url('calonpasangan/edit/') . $p['paslon_id'] ?>" class="btn btn-xs btn-info"><i class="fas fa-edit"></i></a>
                                        <a href="<?= base_url('calonpasangan/hapus/') . $p['paslon_id'] ?>" class="btn btn-xs btn-danger"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#paslon').DataTable();
    })
</script>