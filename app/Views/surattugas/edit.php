<?=$this->extend('themes/'.config('site')->themes.'/default')?>

<?=$this->section('content')?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>Ubah Surat Tugas</h4>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <?=form_open('surattugas/simpanupdate', ['class'=>'formsurattugas'])?>
            <?=csrf_field();?>
            <input type="hidden" name="idst" id="idst" value="<?=$id_st?>">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis Surat Tugas </label>
                            <input name="jenis_st" id="jenis_st" type="text" class="form-control" readonly>
                            <div class="invalid-feedback error_jenis_st"> </div>
                        </div>

                        <div class=" form-group">
                            <label>Nomor ST</label>
                            <input name="nomor_st" id="nomor_st" type="text" class="form-control" readonly>
                            <div class="invalid-feedback error_nomor_st"> </div>
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
                                        <input name="tgl_berangkat" type="text" id="in_tgl_berangkat"
                                            class="form-control datetimepicker-input" data-target="#tgl_berangkat" />
                                        <div class="input-group-append" data-target="#tgl_berangkat"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback error_tgl_berangkat"> </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Kembali</label>
                                    <div class="input-group date" id="tgl_kembali" data-target-input="nearest">
                                        <input name="tgl_kembali" id="in_tgl_kembali" type="text"
                                            class="form-control datetimepicker-input" data-target="#tgl_kembali" />
                                        <div class="input-group-append" data-target="#tgl_kembali"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i>
                                            </div>
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
                                        <input name="kota_ttd" id="kota_ttd" type="text" class="form-control">
                                        <div class="invalid-feedback error_kota_ttd"> </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Ditandatangani</label>
                                        <div class="input-group date" id="tgl_st" data-target-input="nearest">
                                            <input name="tgl_st" id="in_tgl_st" type="text"
                                                class="form-control datetimepicker-input" data-target="#tgl_st" />
                                            <div class="input-group-append" data-target="#tgl_st"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                </div>
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
                        <div class="invalid-feedback error_personil"> </div>
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
function dataEdit() {
    $.ajax({
        type: "post",
        url: "<?= site_url('surattugas/dataEdit')?>",
        data: {
            id: $('#idst').val(),
            // jenis_st: $('#jenis_st').val(),
        },
        dataType: "json",
        success: function(data) {
            $('#idst').val(data.id_st);
            $('#jenis_st').val(data.jenis_st);
            $('#nomor_st').val(data.nomor_st);
            $('#perihal').val(data.perihal);
            $('#dasar_st').val(data.dasar_st);
            $('#in_tgl_berangkat').val(data.tanggal_berangkat);
            $('#in_tgl_kembali').val(data.tanggal_kembali);
            $('#in_tgl_st').val(data.tanggal_st);
            $('#kota_ttd').val(data.kota_ttd);
            $('#jabatan_ttd').val(data.jabatan_ttd);
            $('#nama_ttd').val(data.nama_ttd);
            $('#lokasi').html(data.isi_lokasi);

            $('#div_tabel_personil').html(data.table_header + data.row_pegawai +
                data.end_table);
            $('#jabatan_ttd').html(data.jabatan_ttd);
            $('#id_lalu').html("<span class='badge badge-info'>Agenda lalu: " +
                data.agenda_terakhir + '</span>');

            $('#tabel_personil').DataTable({
                'processing': true,
                'pageLength': 10,
                'paging': true,
                "dom": 'frtp',
                'order': [
                    [1, 'asc']
                ],
            });
        },

        error: function(xhr, thrownError) {
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

$(document).ready(function() {
    dataEdit();
    $('.select2').select2();
    $('#tgl_berangkat, #tgl_kembali, #tgl_st').datetimepicker({
        // format: 'L',
        format: 'YYYY-MM-DD',
        autoclose: true,
        language: 'id'
    });
});

//button submit
$('.formsurattugas').submit(function(e) {
    e.preventDefault();

    // Iterate over all checkboxes in the table
    // dataTable.rows().nodes().to$().find('input[type="checkbox"]').each(function() {
    $('#tabel_personil ').DataTable().$('input[type="checkbox"]').each(function() {
        // If checkbox doesn't exist in DOM
        if (!$.contains(document, this)) {
            // If checkbox is checked
            if (this.checked) {
                // Create a hidden element 
                $('form').append(
                    $('<input>')
                    .attr('type',
                        'hidden')
                    .attr('name', this
                        .name)
                    .val(this.value)
                );
            }
        }
    });


    $.ajax({
        type: "post",
        url: $(this).attr('action'),
        data: $(this).serialize(), //form serialize
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
            if (response.error) {
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
                    $('#error_personil').html("* Personil belum ada yang dipilih")

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
});
</script>

<?=$this->endSection()?>