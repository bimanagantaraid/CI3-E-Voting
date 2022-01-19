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
            <a href="<?= base_url('user/tambah') ?>" class="btn btn-sm btn-primary float-right">Tambah</a>
        </div>
        <div class="card-body">
            <table id="users" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($users as $users) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $users['username'] ?></td>
                            <td><?= $users['email'] ?></td>
                            <td><?= $users['name'] ?></td>
                            <td>
                                <?php echo ($users['is_active'] == 1) ? '<button class="btn btn-xs bg-lightblue">Aktif</button>' : '<button class="btn btn-xs bg-lightblue disabled">Tidak Aktif</button>' ?>
                            </td>
                            <td>
                                <?php echo ($users['role_id'] == 1) ? '<button class="btn btn-xs bg-success">Administrator</button>' : '<div class="btn btn-xs bg-purple">Panitia</div>' ?>
                            </td>
                            <td>
                                <a href="<?= base_url('user/edit/') . $users['user_id'] ?>" class="btn btn-xs btn-info"><i class="fas fa-edit"></i></a>
                                <button onclick="hapus(this)" user_id="<?= $users['user_id'] ?>" class="btn btn-xs btn-danger"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- notification -->
<?php
if ($this->session->flashdata('message')) {
?>
    <script>
        $(document).ready(() => {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
            })

            Toast.fire({
                icon: '<?= $_SESSION['message']['icon'] ?>',
                title: '<?= $_SESSION['message']['message'] ?>'
            })
        });
    </script>
<?php
    unset($_SESSION['message']);
}
?>

<script>
    var table;
    $(document).ready(() => {
        table = $('#users').DataTable({
            responsive: true,
            autoWidth: false
        });

    })

    function hapus(user_id) {
        var user_id = $(user_id).attr('user_id');
        console.log(user_id);
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Jika tidak anda dapat membatalkannya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batalkan!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('user/hapus') ?>',
                    type: 'POST',
                    data: {
                        user_id: user_id
                    },
                    success: function() {
                        window.location.href = "<?= base_url() ?>/user";
                    }
                })
            }
        })
    }
</script>