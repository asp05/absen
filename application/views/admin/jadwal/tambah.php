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
                        <h3 class="card-title">Tambah Jadwal Pelajaran</h3>
                        <div class="card-tools">
                            <a href="javascript::void(0)" onclick="window.history.back()"><i class="fas fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if ($this->session->flashdata('eror')) : ?>
                            <div class="alert alert-danger">
                                <?= $this->session->flashdata('eror'); ?>
                            </div>
                        <?php endif; ?>
                        <form action="<?= base_url('admin/jadwal/tambah'); ?>" method="post">
                            <div class="row">
                                <div class="col-md-6 col-x-12">
                                    <div class="form-group">
                                        <label for="">Nama Guru</label>
                                        <select name="id_user" class="form-control">
                                            <option value="">Pilih Guru</option>
                                            <?php foreach ($guru as $x) : ?>
                                                <option value="<?= $x->id_user; ?>"><?= $x->nama_user; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?= form_error('id_user', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-x-12">
                                    <div class="form-group">
                                        <label for="">Nama Mata Pelajaran</label>
                                        <select name="id_mapel" class="form-control">
                                            <option value="">Pilih Mata Pelajaran</option>
                                            <?php foreach ($mapel as $x) : ?>
                                                <option value="<?= $x->id_mapel; ?>"><?= $x->nama_mapel; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?= form_error('id_mapel', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-x-12">
                                    <div class="form-group">
                                        <label for="">Hari</label>
                                        <select name="hari" class="form-control">
                                            <option value="">Pilih Hari</option>
                                            <option value="senin">Senin</option>
                                            <option value="selasa">Selasa</option>
                                            <option value="rabu">Rabu</option>
                                            <option value="kamis">Kamis</option>
                                            <option value="jumat">Jumat</option>
                                            <option value="sabtu">Sabtu</option>
                                        </select>
                                        <?= form_error('hari', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-x-12">
                                    <div class="form-group">
                                        <label for="">Jam Mulai</label>
                                        <div class="input-group date" id="timepicker" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" name="jam" data-target="#timepicker" />
                                            <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                        </div>
                                        <?= form_error('jam', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-x-12">
                                    <div class="form-group">
                                        <label for="">Waktu</label>
                                        <div class="input-group date" id="timepicker" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" name="waktu" />
                                            <div class="input-group-append">
                                                <div class="input-group-text">menit</div>
                                            </div>
                                        </div>
                                        <?= form_error('waktu', '<small class="text-danger">', '</small>'); ?>
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
<script>
    $('#timepicker').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
    })
</script>