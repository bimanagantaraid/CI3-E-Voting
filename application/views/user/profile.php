<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $titlepage  ?></h1>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/image/users/') . $user['image'] ?>" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"><?= $user['name'] ?></h3>



                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Role</b>
                                <span class="float-right">
                                    <?php if ($user['role_id'] == 1) {
                                        echo "Administrator";
                                    } else if ($user['role_id'] == 2) {
                                        echo "Panitia";
                                    } else {
                                        echo "Pemilih";
                                    }
                                    ?>
                                </span>
                            </li>
                            <li class="list-group-item">
                                <b>Gabung</b> <a class="float-right">
                                    <?php
                                    $date_created = $user['date_created'];
                                    $date_created = strtotime($date_created);
                                    echo date('d F Y', $date_created);
                                    ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-3">
                        <button class="btn btn-sm btn-primary">Detail</button>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="<?= base_url('user/editprofile') ?>" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" name="user_id" value="<?= $user['user_id'] ?>" hidden>
                                    <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>">
                                </div>
                            </div>
                            <?= form_error('name', '<small class="text-danger">', '</small>') ?>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>">
                                </div>
                            </div>
                            <?= form_error('email', '<small class="text-danger">', '</small>') ?>
                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>">
                                </div>
                            </div>
                            <?= form_error('username', '<small class="text-danger">', '</small>') ?>
                            <div class="form-group row">
                                <label for="inputExperience" class="col-sm-2 col-form-label">Foto</label>
                                <input type="text" value="<?= $user['image'] ?>" name="hiddenImage" hidden>
                                <div class="col-sm-2">
                                    <?php
                                    $image = $user['image'];
                                    if (file_exists(FCPATH . "assets/image/users/$image")) {
                                    ?>
                                        <img src="<?= base_url('assets/image/users/') . $user['image'] ?>" alt="paslon-img" class="mb-2 mt-2" style="width: 80px;height: 80px;object-fit: cover;border-radius: 50%;">
                                    <?php
                                    } else {
                                        echo "-";
                                    }
                                    ?>
                                </div>
                                <div class="custom-file col-sm-8">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="image">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Edit profile</button>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
</section>

<?php

if($this->session->flashdata('message')){
    ?>
    <script>
        $(document).ready(() => {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
            })
            Swall.fire({
                icon : '<?= $_SESSION['message']['icon']?>',
                title : '<?= $_SESSION['message']['message']?>',
            })
        })
    </script>

    <?php
}

?>

<script>
    $(document).ready(() => {
        bsCustomFileInput.init();
    })
</script>