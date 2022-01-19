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
        <div class="card-header">
            <a href="<?= base_url('pemilih/tambah') ?>" class="btn btn-sm btn-primary float-right">Tambah</a>
        </div>
        <div class="card-body">
            <p class="text-danger">*No Identitas (NIK/NISN/<small>NO RESMI</small>)</p>
            <div class="row">
                <div class="col-sm">
                    <table id="pemilih" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No Identitas *</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
                position: 'top-end'
            });
            Toast.fire({
                icon: '<?= $_SESSION['message']['icon'] ?>',
                title: '<?= $_SESSION['message']['message'] ?>'
            })
        })
    </script>
<?php
    unset($_SESSION['message']);
}
?>
<script>
    $(document).ready(function() {
        $('#pemilih').DataTable({
            responsive: true,
            autoWidth: false,
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                //panggil method ajax list dengan ajax
                "url": '<?= base_url('pemilih/getpemilih') ?>',
                "type": "POST"
            }
        });

    });

    function hapus(datahapus) {
        var pemilih_id = $(datahapus).attr('pemilih_id');
        Swal.fire({
            title: 'Apakah anda yakin?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: `Tidak`,
            cancelButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('pemilih/hapus') ?>',
                    type: 'POST',
                    data: {
                        pemilih_id: pemilih_id
                    },
                    success: function(data) {
                        window.location = "<?= base_url() ?>pemilih";
                    }
                })
            } else {
                Swal.fire('Ok data aman', '', 'info');
            }
        })
    }
</script>