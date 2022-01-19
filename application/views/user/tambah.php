<div class="content-header">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-12 d-flex justify-content-between">
                <h4><?= $titlepage ?></h4>
                <a href="<?= base_url('user')?>" class="btn btn-sm btn-warning"><i class="fas fa-undo-alt"></i></a>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>DATA</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('user/tambah') ?>" method="post">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" name="name" value="<?= set_value('name') ?>">
                            <?= form_error('name', '<small class="invalid-input">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="<?= set_value('email') ?>">
                            <?= form_error('email', '<small class="invalid-input">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" value="<?= set_value('username') ?>">
                            <?= form_error('username', '<small class="invalid-input">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" value="<?= set_value('password') ?>">
                            <?= form_error('password', '<small class="invalid-input">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role_id" id="role_id" class="form-control">
                                <option value="" selected="selected">Pilih role</option>
                                <?php foreach ($role as $r) : ?>
                                    <option value="<?= $r['user_role_id'] ?>" <?php echo  set_select('role_id', $r['user_role_id'], TRUE); ?>><?= $r['role'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('role_id', '<small class="invalid-input">', '</small>') ?>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1" name="is_active" <?php echo set_checkbox('is_active', 'on'); ?>>
                            <label class="custom-control-label" for="customSwitch1">Aktif?</label>
                            <?= form_error('is_active', '<small class="invalid-input">', '</small>') ?>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mt-2">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(() => {

    })
</script>