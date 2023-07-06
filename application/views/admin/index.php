<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Pengguna</span>
                        <span class="info-box-number">
                            <?= $this->mc->ambil('user')->num_rows(); ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Admin</span>
                        <span class="info-box-number">
                            <?= $this->mc->ambil('user', ['role' => 1])->num_rows(); ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Guru</span>
                        <span class="info-box-number">
                            <?= $this->mc->ambil('user', ['role' => 2])->num_rows(); ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-book"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Jumlah Mata Pelajaran</span>
                        <span class="info-box-number">
                            <?= $this->mc->ambil('mapel')->num_rows(); ?>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <div class="row">

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Gaji</h3>
                        <div class="card-tools">
                            <a href="javascript::void(0)" onclick="reload()"><i class="fa fa-refresh"></i></a>
                        </div>
                    </div>
                    <div class="card-body table-responsive">

                        <table class="table table-hovered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nip</th>
                                    <th>Nama Guru</th>
                                    <th>Bulan Ini</th>
                                    <th>Pertemuan Seharusnya</th>
                                    <th>Kehadiran</th>
                                    <th>Gaji</th>
                                    <th>Gaji Seharusnya</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!--/. container-fluid -->
</section>
<!-- /.content -->

<script>
    var table;
    $(document).ready(function() {
        table = $('.table').DataTable({
            "processing": true,
            "serverSide": true,
            "searching": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('homeadmin/ajax_list') ?>",
                "type": "POST",
            },
            "columDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],
        });
    })

    function reload() {
        table.ajax.reload();
    }
    const usr = $('.usr').data('flashdata');
    const eror = $('.eror').data('flashdata');
    if (usr) {
        Toast.fire({
            type: 'success',
            title: 'Data' + usr
        })
    } else if (eror) {
        Toast.fire({
            type: 'error',
            title: 'Data' + eror
        })
    }
</script>