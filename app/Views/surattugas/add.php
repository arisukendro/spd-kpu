<?=$this->extend('themes/'.config('site')->themes.'/default')?>

<?=$this->section('content')?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>Tambah Surat Tugas</h4>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <?=form_open('surattugas/simpandata', ['class'=>'formsurattugas'])?>
            <?=csrf_field();?>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis Surat Tugas </label>
                            <select name="jenis_st" id="jenis_st" class="form-control select2"
                                data-minimum-results-for-search="Infinity" style="width: 100%;">
                                <option value="">Pilih</option>
                                <option value="ketua">Ketua</option>
                                <option value="sekretaris">Sekretaris</option>
                            </select>
                            <div class="invalid-feedback error_jenis_st"> </div>
                        </div>
                        <div class=" form-group">
                            <div class="row">
                                <div class="col-md-6"><label>Nomor ST</label></div>
                                <div class="col-md-6">
                                    <div id="id_lalu" class="text-right pull-right "></div>
                                </div>
                            </div>
                            <div class="input-group ">
                                <input name="nomor_st" id="nomor_st" type="text" class="form-control">
                                <span class="input-group-append">
                                    <button type="button" id="reload_nomor" class="btn btn-warning btn-sm"><i
                                            class="fa fa-sync"></i></button>
                                </span>
                                <div class="invalid-feedback error_nomor_st"> </div>
                            </div>
                        </div>
                        <div class=" form-group">
                            <label>Perihal / Keperluan Tugas</label>
                            <input name="perihal" id="perihal" type="text" class="form-control">
                            <div class="invalid-feedback error_perihal"> </div>
                        </div>

                        <div class=" form-group">
                            <label>Dasar ST</label>
                            <input name="dasar_st" id="dasar_st" type="text" class="form-control">
                            <div class="invalid-feedback error_dasar_st"> </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6"><label>Lokasi Tugas</label></div>
                                <div class="col-md-6 ">
                                    <div class="text-right">
                                        <button type="button" id="tambah_lokasi" class="btn btn-success btn-sm"><i
                                                class="fa fa-plus"></i></button>
                                        <button type="button" id="reload_lokasi" class="btn btn-warning btn-sm"><i
                                                class="fa fa-sync"></i></button>
                                    </div>
                                </div>
                            </div>
                            <select name="lokasi[]" id="lokasi" class="select2" multiple="multiple" style="width:
                                100%;">
                            </select>
                            <div class="invalid-feedback error_lokasi"> </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Date -->
                                <div class="form-group">
                                    <label>Tanggal Berangkat</label>
                                    <div class="input-group date" id="tgl_berangkat" data-target-input="nearest">
                                        <input name="tgl_berangkat" type="text"
                                            class="form-control datetimepicker-input" data-target="#tgl_berangkat"
                                            value="<?=date('Y-mm-dd');?>" />
                                        <div class="input-group-append" data-target="#tgl_berangkat"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback error_tgl_berangkat"> </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Kembali</label>
                                    <div class="input-group date" id="tgl_kembali" data-target-input="nearest">
                                        <input name="tgl_kembali" type="text" class="form-control datetimepicker-input"
                                            data-target="#tgl_kembali" value="<?=date('Y-mm-dd');?>" />
                                        <div class="input-group-append" data-target="#tgl_kembali"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback error_tgl_kembali"> </div>

                                </div>
                            </div>
                        </div>

                        <div class="border rounded border-warning p-2">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kota Ditandatangani</label>
                                        <input name="kota_ttd" id="kota_ttd" type="text" class="form-control"
                                            value="<?=config('site')->ibukota?>">
                                        <div class="invalid-feedback error_kota_ttd"> </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Ditandatangani</label>
                                        <div class="input-group date" id="tgl_st" data-target-input="nearest">
                                            <input name="tgl_st" type="text" class="form-control datetimepicker-input"
                                                data-target="#tgl_st" value="<?=date('Y-mm-dd');?>" />
                                            <div class="input-group-append" data-target="#tgl_st"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback error_tgl_st"> </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jabatan Penandatangan</label>
                                        <select name="jabatan_ttd" id="jabatan_ttd" class="form-control select2"
                                            data-minimum-results-for-search="Infinity" style="width: 100%;">

                                        </select>
                                        <div class="invalid-feedback error_jabatan_ttd"> </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Penandatangan</label>
                                        <input name="nama_ttd" id="nama_ttd" type="text" class="form-control">
                                        <div class="invalid-feedback error_nama_ttd"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /col-md-6 -->

                    <!-- tabel pegawai -->
                    <div class="col-md-6">
                        <div id="div_tabel_personil">
                            <!-- data pegawai tampil disini -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary btnsimpan">Simpan</button>
        </div>

        <?=form_close()?>
    </div>
</div>
</div>

<script>
function reload_nomor() {
    $.ajax({
        type: "post",
        url: "<?= site_url('surattugas/nomor_st')?>",
        dataType: "json",
        data: {
            jenis_st: $("#jenis_st").val()
        },

        success: function(data) {
            $('#nomor_st').val(data.nomor_st_skg);
            $('#id_lalu').html("<span class='badge badge-info'>Agenda lalu: " +
                data.nomor_lalu + '</span>');
        },

        error: function(xhr, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },
    });
}

$("#reload_nomor").click(function() {
    reload_nomor();
});


function cekPersonil(id) {
    $.ajax({
        type: "post",
        url: "<?=site_url('surattugas/cekPersonil')?>",
        data: {
            id_personil: id
        },
        dataType: "json",

        success: function(response) {
            if (response.sukses) {
                $('.viewmodal').html(response.sukses).show();
                $('#modalCekPersonil').modal('show');
            }
        },

        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },

    });
}


function getLokasi() {
    $.ajax({
        type: "post",
        url: "<?= site_url('chaindata/getLokasi')?>",
        data: {},
        dataType: "json",
        success: function(data) {
            $('#lokasi').html(data.isi_lokasi);
        },

        error: function(xhr, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },
    });
}

$('#tambah_lokasi').click(function(e) {
    e.preventDefault();
    $.ajax({
        url: "<?=site_url('surattugas/tambahlokasi')?>",
        dataType: "json",
        success: function(response) {
            $('.viewmodal').html(response.data).show();
            $('#modaltambah').modal('show');

        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });

});

$("#reload_lokasi").click(function() {
    $('#lokasi').html('');
    getLokasi();
});

$('#jenis_st').change(function(e) {
    if ($('#jenis_st').val().length === 0) {
        $('#jabatan_ttd').html('');
        $('#nomor_st').val('');
        $('#nama_ttd').val('');
        $('#div_tabel_personil').html('');
    } else {
        reload_nomor();
        $.ajax({
            type: "post",
            url: "<?= site_url('surattugas/dataTambah')?>",
            data: {
                jenis_st: $(this).val(),
            },
            dataType: "json",

            success: function(data) {
                $('#jabatan_ttd').html(data.jabatan_ttd);
                $('#jabatan_ttd').change();
                $('#div_tabel_personil').html(data.start_table + data.row_pegawai + data.end_table);
                $('#tabel_personil').DataTable({
                    'processing': true,
                    'pageLength': 10,
                    'paging': true,
                    "dom": 'frtp',
                    'columnDefs': [{
                        'targets': 0,
                        'checkboxes': {
                            'selectRow': true,
                            'stateSave': false,
                        }
                    }],
                    // 'select': 'multi',
                    'order': [
                        [1, 'asc']
                    ]
                });
            },

            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" +
                    thrownError);
            },
        });
    }

});

$('#jabatan_ttd').change(function(e) {
    $.ajax({
        type: "post",
        url: "<?= site_url('surattugas/ambilPejabatTtd')?>",
        data: {
            jabatan_ttd: $(this).val(),
        },
        dataType: "json",
        success: function(response) {
            $('#nama_ttd').val(response.nama_ttd);
        }
    });
});

//button submit
$('form').submit(function(e) {
    e.preventDefault();

    var rows_selected = $('#tabel_personil').DataTable().column(0).checkboxes.selected();
    // Iterate over all selected checkboxes
    const personil = [];
    $.each(rows_selected, function(index, pegawaiId) {
        //create hidden elemen
        $('form').append(
            $('<input>')
            .attr('type', 'hidden')
            .attr('id', 'personil')
            .attr('name', 'personil[]')
            .val(pegawaiId)
        );
        //diperlukan untuk menghitung isi array personil
        personil.push(pegawaiId);
    });


    $.ajax({
        type: "post",
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: "json",

        beforeSend: function() {
            $('.btnsimpan').attr('disable', 'disabled');
            $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>');
        },

        complete: function() {
            $('.btnsimpan').removeAttr('disable');
            $('.btnsimpan').html('Simpan');
        },

        success: function(response) {
            //hack to remove /reset state array datatables
            for (let i = 0; i < personil.length; i++) {
                $('#personil').remove();
            }

            if (response.error) {

                if (response.error.jenis_st) {
                    $('#jenis_st').addClass('is-invalid');
                    $('.error_jenis_st').html(response.error.jenis_st)
                } else {
                    $('#jenis_st').removeClass('is-invalid');
                    $('.error_jenis_st').html()
                }

                if (response.error.nomor_st) {
                    $('#nomor_st').addClass('is-invalid');
                    $('.error_nomor_st').html(response.error.nomor_st)
                } else {
                    $('#nomor_st').removeClass('is-invalid');
                    $('.error_nomor_st').html()
                }

                if (response.error.perihal) {
                    $('#perihal').addClass('is-invalid');
                    $('.error_perihal').html(response.error.perihal)
                } else {
                    $('#perihal').removeClass('is-invalid');
                    $('.error_perihal').html()
                }

                if (response.error.dasar_st) {
                    $('#dasar_st').addClass('is-invalid');
                    $('.error_dasar_st').html(response.error.dasar_st)
                } else {
                    $('#dasar_st').removeClass('is-invalid');
                    $('.error_dasar_st').html()
                }

                if (response.error.lokasi) {
                    $('#lokasi').addClass('is-invalid ');
                    $('.error_lokasi').html(response.error.lokasi)
                } else {
                    $('#lokasi').removeClass('is-invalid');
                    $('.error_lokasi').html()
                }

                if (response.error.tgl_st) {
                    $('#tgl_st').addClass('is-invalid');
                    $('.error_tgl_st').html(response.error.tgl_st)
                } else {
                    $('#tgl_st').removeClass('is-invalid');
                    $('.error_tgl_st').html()
                }

                if (response.error.tgl_berangkat) {
                    $('#tgl_berangkat').addClass('is-invalid');
                    $('.error_tgl_berangkat').html(response.error.tgl_berangkat)
                } else {
                    $('#tgl_berangkat').removeClass('is-invalid');
                    $('.error_tgl_berangkat').html()
                }

                if (response.error.tgl_kembali) {
                    $('#tgl_kembali').addClass('is-invalid');
                    $('.error_tgl_kembali').html(response.error.tgl_kembali)
                } else {
                    $('#tgl_kembali').removeClass('is-invalid');
                    $('.error_tgl_kembali').html()
                }

                if (response.error.kota_ttd) {
                    $('#kota_ttd').addClass('is-invalid');
                    $('.error_kota_ttd').html(response.error.kota_ttd)
                } else {
                    $('#kota_ttd').removeClass('is-invalid');
                    $('.error_kota_ttd').html()
                }

                if (response.error.tgl_st) {
                    $('#tgl_st').addClass('is-invalid');
                    $('.error_tgl_st').html(response.error.tgl_st)
                } else {
                    $('#tgl_st').removeClass('is-invalid');
                    $('.error_tgl_st').html()
                }

                if (response.error.jabatan_ttd) {
                    $('#jabatan_ttd').addClass('is-invalid');
                    $('.error_jabatan_ttd').html(response.error.jabatan_ttd)
                } else {
                    $('#jabatan_ttd').removeClass('is-invalid');
                    $('.error_jabatan_ttd').html()
                }

                if (response.error.nama_ttd) {
                    $('#nama_ttd').addClass('is-invalid');
                    $('.error_nama_ttd').html(response.error.nama_ttd)
                } else {
                    $('#nama_ttd').removeClass('is-invalid');
                    $('.error_nama_ttd').html()
                }

                if (response.error.personil) {
                    $('#error_personil').html(
                        "* Personil belum ada yang dipilih")

                } else {
                    $('#error_personil').html('')
                }

            } else {
                location.href = "<?=site_url('surattugas')?>";
            }


        },

        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" +
                thrownError);
        },

    });

    return false;

})

$(document).ready(function() {
    getLokasi();

    $('.select2').select2();
    $('#tgl_berangkat, #tgl_kembali, #tgl_st').datetimepicker({
        // format: 'L',
        format: 'YYYY-MM-DD',
        autoclose: true,
        language: 'id',
    });

});
</script>

<?=$this->endSection()?>