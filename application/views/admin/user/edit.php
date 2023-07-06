<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Pengguna</h3>
                        <div class="card-tools">
                            <a href="javascript::void(0)" onclick="window.history.back()"><i class="fas fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <?php if ($this->session->flashdata('eror')) : ?>
                            <div class="alert alert-danger">
                                <?= $this->session->flashdata('eror'); ?>
                            </div>
                        <?php endif; ?>
                        <form action="<?= base_url('admin/user/edit/' . base64_encode($user['id_user'])); ?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 col-x-12">
                                    <div class="form-group">
                                        <label for="">Nama Pengguna</label>
                                        <input type="text" name="nama_user" value="<?= $user['nama_user']; ?>" class="form-control">
                                        <?= form_error('nama_user', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-x-12">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="text" name="email" value="<?= $user['email']; ?>" class="form-control">
                                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-x-12">
                                    <div class="form-group">
                                        <label for="">NIK</label>
                                        <input type="text" name="nip" value="<?= $user['nip']; ?>" class="form-control">
                                        <?= form_error('nip', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-x-12">
                                    <div class="form-group">
                                        <label for="">Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir" value="<?= $user['tanggal_lahir']; ?>" class="form-control">
                                        <?= form_error('tanggal_lahir', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-x-12">
                                    <div class="form-group">
                                        <label for="">Jenis Pengguna</label>
                                        <select name="role" class="form-control">
                                            <option value="">Pilih Jenis Pengguna</option>
                                            <option value="1" <?= $user['role'] == 1 ? 'selected' : ''; ?>>Admin</option>
                                            <option value="2" <?= $user['role'] == 2 ? 'selected' : ''; ?>>Guru</option>
                                        </select>
                                        <?= form_error('role', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-x-12">
                                    <div class="form-group">
                                        <label for="">Jenis Kelamin</label>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio1" name="jenis_kelamin" value="l" <?= $user['role'] == 1 ? 'checked' : ''; ?>>
                                            <label for="customRadio1" class="custom-control-label">Laki-Laki</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio2" name="jenis_kelamin" value="p" <?= $user['role'] == 2 ? 'checked' : ''; ?>>
                                            <label for="customRadio2" class="custom-control-label">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-x-12">
                                    <div class="form-group">
                                        <label for="">Alamat</label>
                                        <textarea name="alamat" id="" rows="2" class="form-control"><?= $user['alamat']; ?></textarea>
                                        <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-x-12">
                                    <div class="form-group">
                                        <label for="">Gambar</label>
                                        <input type="file" name="gambar" class="form-control" id="">
                                        <input type="hidden" name="gambarlama" value="<?= $user['gambar']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-x-12">
                                    <div class="form-group">
                                        <label for="">Gaji</label>
                                        <input type="number" name="gaji" value="<?= $user['gaji']; ?>" min="0" required class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <button type="reset" class="btn btn-danger btn-block">Reset</button>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!--/. container-fluid -->
</section>
<!-- /.content -->