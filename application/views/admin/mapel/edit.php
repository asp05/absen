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
                        <h3 class="card-title">Edit Mata Pelajaran</h3>
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
                        <form action="<?= base_url('admin/mapel/edit/' . base64_encode($mapel['id_mapel'])); ?>" method="post">
                            <div class="row">
                                <div class="col-md-6 col-x-12">
                                    <div class="form-group">
                                        <label for="">Nama Mata Pelajaran</label>
                                        <input type="text" name="nama_mapel" value="<?= $mapel['nama_mapel']; ?>" class="form-control">
                                        <?= form_error('nama_mapel', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-x-12">
                                    <div class="form-group">
                                        <label for="">Keterangan</label>
                                        <textarea name="keterangan" value="<?= $mapel['keterangan']; ?>" rows="2" class="form-control"></textarea>
                                        <?= form_error('keterangan', '<small class="text-danger">', '</small>'); ?>
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