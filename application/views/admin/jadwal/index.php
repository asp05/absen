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
                        <h3 class="card-title">Data Jadwal Pelajaran</h3>
                        <div class="card-tools">
                            <a href="javascript::void(0)" onclick="reload()"><i class="fas fa-refresh"></i></a>
                            <a href="<?= base_url('admin/jadwal/tambah'); ?>"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="card-body table-responsive">

                        <table class="table table-hovered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Barcode</th>
                                    <th>Nama Guru</th>
                                    <th>Nama Mapel</th>
                                    <th>Hari</th>
                                    <th>Jam</th>
                                    <th>Waktu</th>
                                    <th>Aksi</th>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <img src="" alt="" srcset="" id="gbr">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-xs-12 text-center">
                        <div id="nama"></div>
                    </div>
                    <div class="col-md-12 col-xs-12 text-center">
                        <div id="mapel"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-xs-12 text-center">
                        <div id="hari"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var table;
    $(document).ready(function() {
        table = $('.table').DataTable({
            "processing": true,
            "serverSide": true,
            "searching": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('admin/jadwal/ajax_list') ?>",
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

    $('#exampleModal').on('shown.bs.modal', function(e) {
        $('#gbr').attr('src', '<?= base_url('assets/admin/dist/img/'); ?>' + $(e.relatedTarget).data('gambar'))
        $('#nama').html($(e.relatedTarget).data('nama'))
        $('#mapel').html($(e.relatedTarget).data('mapel'))
        $('#hari').html($(e.relatedTarget).data('hari') + ',' + $(e.relatedTarget).data('jam') + '(' + $(e.relatedTarget).data('waktu') + ')')
    })
</script>