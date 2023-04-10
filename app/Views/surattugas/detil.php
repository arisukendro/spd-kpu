<?=$this->extend('themes/'.config('site')->themes.'/default')?>

<?=$this->section('content')?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <input type="hidden" name="id_st" id="id_st" value="<?=$id_st?>">
                        <h3 class="card-title text-bold">
                            Form SPD
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body personil">

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-bold "> Detil Surat Tugas</h3>

                        <div class="card-tools">
                            <ul class="pagination pagination-sm">
                                <li class="page-item"><a target="blank"
                                        href="<?=site_url('surattugas/cetak/').base64_encode($id_st)?>"
                                        class="btn btn-sm btn-primary">Cetak ST</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">Perihal</dt>
                            <dd class="col-sm-8 perihal_st "></dd>

                            <dt class="col-sm-4">Lokasi Tujuan</dt>
                            <dd class="col-sm-8 lokasi"></dd>

                            <dt class="col-sm-4">Nomor ST</dt>
                            <dd class="col-sm-8 nomor_st"></dd>

                            <dt class="col-sm-4">Tanggal ST</dt>
                            <dd class="col-sm-8 tanggal_st"></dd>

                            <dt class="col-sm-4">Masa Tugas</dt>
                            <dd class="col-sm-8 masa_tugas">

                            </dd>
                        </dl>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div class="text-muted text-small"><i class="fa fa-user"></i> Kendro | <span
                                class="tgl_buat"></span></div>
                    </div>
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->
            </div>

        </div>

    </div>
</div>


<script>
function dataDetil() {
    $.ajax({
        type: "post",
        url: "<?= site_url('surattugas/dataDetil')?>",
        data: {
            id: $('#id_st').val(),
        },
        dataType: "json",
        success: function(data) {
            $('#id_st').html(data.id_st);
            $('.tgl_buat').html(data.tanggal_buat);
            $('.perihal_st').html(data.perihal_st);
            $('.nomor_st').html(data.nomor_st);
            $('.tanggal_st').html(data.tanggal_st);
            $('.masa_tugas').html(data.masa_tugas);
            $('.personil').html(data.personil);
            $('.lokasi').html(data.lokasi);
        },

        error: function(xhr, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },
    });
}

function buatSpd(id_personil) {
    $.ajax({
        type: "post",
        url: "<?=site_url('spd/formTambah')?>",
        data: {
            id_st_personil: id_personil,
            id_st: $("#id_st").val(),
        },
        dataType: "json",

        success: function(response) {
            if (response.sukses) {
                $('.viewmodal').html(response.sukses).show();
                $('#modalspd').modal('show');
            }
        },

        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },
    });
}

function ubahSpd(id) {
    $.ajax({
        type: "post",
        url: "<?=site_url('spd/formEdit')?>",
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

function hapusSpd(id) {
    Swal.fire({
        title: 'Konfirmasi Penghapusan [ID=' + id + ']',
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
                url: "<?=site_url('spd/hapus/')?>" + id,
                data: {
                    id: id
                },
                dataType: "json",

                success: function(response) {
                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Data telah dihapus',
                            showConfirmButton: false,
                            timer: 1000
                        })
                    }
                    dataDetil();
                },

                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                },

            });
        }
    })
}

$(document).ready(function() {
    dataDetil()
});
</script>

<?=$this->endSection()?>