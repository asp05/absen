<div class="usr" data-flashdata="<?= $this->session->flashdata('berhasil') ?>"></div>
<div class="eror" data-flashdata="<?= $this->session->flashdata('eror') ?>"></div>
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
                        <h3 class="card-title">Data Absen</h3>
                    </div>
                    <div class="card-body table-responsive">

                        <table class="table table-hovered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Guru</th>
                                    <th>Nama Mapel</th>
                                    <th>Hari</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                        </table>
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
    var table;
    $(document).ready(function() {
        table = $('.table').DataTable({
            "processing": true,
            "serverSide": true,
            "searching": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('admin/historiabsen/ajax_list') ?>",
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