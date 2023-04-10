<?=$this->extend('themes/'.config('site')->themes.'/default')?>

<?=$this->section('content')?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-8">
                <h3><?=$title_page?></h3>
            </div><!-- /.col -->
            <div class="col-sm-4">
                <div class="breadcrumb float-sm-right">
                    <a href="<?=site_url('surattugas/tambah')?>" type="button" class="tomboltambah btn btn-primary  "><i
                            class="fa fa-plus-circle"></i> Tambah</a>
                    &nbsp;

                    <a href="<?=site_url('surattugas/laporan')?>" type="button"
                        class=" float-right btn-print btn btn-default "><i class="fas fa-print"></i>
                        Laporan</a>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-2">
                <div class="float-left">
                    <div class="periode"></div>
                </div>
                <div id="viewdata"></div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <div class="">
                    <form action="<?=site_url('surattugas/listData')?>" method="post" class="form">
                        <div class="row">
                            <div class="col-md-2">
                                <!-- Date -->
                                <div class="form-group">
                                    <label>FILTER: Tanggal ST</label>
                                    <div class="input-group date" id="tgl_filter_1" data-target-input="nearest">
                                        <input name="tgl_filter_1" type="text"
                                            class="input_tgl_filter_1 form-control datetimepicker-input"
                                            data-target="#tgl_filter_1" />
                                        <div class="input-group-append" data-target="#tgl_filter_1"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback error_tgl_filter_1"> </div>

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>s.d tanggal</label>
                                    <div class="input-group date" id="tgl_filter_2" data-target-input="nearest">
                                        <input name="tgl_filter_2" type="text"
                                            class="input_tgl_filter_2 form-control datetimepicker-input"
                                            data-target="#tgl_filter_2" />
                                        <div class="input-group-append" data-target="#tgl_filter_2"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback error_tgl_filter_2"> </div>
                                </div>
                            </div>
                            <div class="col-md-2 mt-auto">
                                <div class="form-group ">
                                    <button type="submit" class="btn-submit btn btn-primary">Filter</button>
                                    <button type="button" class="btn-reset btn btn-default">Reset</button>
                                </div>
                            </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->


<!-- Page specific script -->
<script>
function datasurattugas() {
    $.ajax({
        url: "<?=site_url('surattugas/listData')?>",
        dataType: "json",
        success: function(response) {
            $('#viewdata').html(response.buka_tabel + response.isi_tabel + response.tutup_tabel);
            $('.periode').html(response.periode);
            $('.input_tgl_filter_1').val(response.startDate)
            $('.input_tgl_filter_2').val(response.endDate)

            $("#tabeldata").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                'ordering': false,
            });
        },

        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

function hapus(id_st) {
    Swal.fire({
        title: 'Konfirmasi Penghapusan [ID=' + id_st + ']',
        text: 'Data yang dihapus tidak bisa dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'

    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: "<?=site_url('surattugas/hapusdata/')?>" + id_st,
                data: {
                    id_st: id_st
                },
                dataType: "json",

                success: function(response) {
                    if (response.sukses) {
                        Swal.fire({
                            position: 'top-end',
                            text: response.sukses,
                            showConfirmButton: false,
                            timer: 1000,
                        })
                    }
                    datasurattugas();
                },

                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                },

            });
        }
    })
}

function edit(id) {
    $.ajax({
        type: "post",
        url: "<?=site_url('surattugas/edit')?>",
        data: {
            id: id
        },
        dataType: "json",

        success: function(response) {
            if (response.sukses) {
                $('.viewmodal').html(response.sukses).show();
                $('#modaledit').modal('show');
            }
        },

        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },

    });
}

$('.btn-reset').click(function(e) {
    datasurattugas();
});

$('.form').submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: "json",

        beforeSend: function() {
            $('.btn-submit').attr('disable', 'disabled');
            $('.btn-submit').html('<i class="fa fa-spin fa-spinner"></i>');
        },

        complete: function() {
            $('.btn-submit').removeAttr('disable');
            $('.btn-submit').html('Filter');
        },

        success: function(response) {
            $('#viewdata').html(response.buka_tabel + response.isi_tabel + response
                .tutup_tabel);
            $('.periode').html(response.periode);
            $('.input_tgl_filter_1').val(response.startDate)
            $('.input_tgl_filter_2').val(response.endDate)

            $("#tabeldata").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                'ordering': false,
            });

        },

        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },
    });

    return false;

});

$(document).ready(function() {
    datasurattugas();

    $('#tgl_filter_1, #tgl_filter_2').datetimepicker({
        format: 'YYYY-MM-DD',
        autoclose: true,
        language: 'id',
    });
});
</script>

<?=$this->endSection()?>