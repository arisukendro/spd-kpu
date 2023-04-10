<!-- Modal -->
<div class="modal fade" id="modalspd" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <?=form_open('spd/simpan', ['class'=>'form'])?>
            <?=csrf_field();?>
            <input type="hidden" name="id_personil" value="<?=$id?>">
            <div class="modal-header">
                <h5 class="modal-title"><b>Buat SPD | </b> <?=$nama?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="card-body">
                    <div class="form-group">
                        <label>Perihal</label> | <?=$perihal?>

                    </div>
                    <div class=" form-group">
                        <div class="row">
                            <div class="col-md-6"><label>Nomor SPD</label></div>
                            <div class="col-md-6">
                                <div class="agenda_lalu text-right pull-right "></div>
                            </div>
                        </div>
                        <div class="input-group ">
                            <input name="nomor_spd" type="text" class="nomor_spd form-control">
                            <span class="input-group-append">
                                <button type="button" class="reload_nomor btn btn-warning btn-sm"><i
                                        class="fa fa-sync"></i></button>
                            </span>
                            <div class="invalid-feedback error_nomor_spd"> </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tingkat biaya perjalanan </label>
                                <select name="tingkat_spd" class="tingkat_spd form-control select2" style="width: 100%;"
                                    data-minimum-results-for-search="Infinity">
                                    <option value="Tingkat C" selected="selected">Tingkat C</option>
                                    <option value="Tingkat B">Tingkat B</option>
                                    <option value="Tingkat A">Tingkat A</option>
                                </select>
                                <div class="invalid-feedback error_tingkat_spd"> </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Sumber dana/anggaran</label>
                                <select name="sumber_dana" class="sumber_dana form-control select2" style="width: 100%;"
                                    data-minimum-results-for-search="Infinity">
                                    <option value="APBN" selected="selected">APBN</option>
                                    <option value="Hibah Pilbup">Hibah Pilbup</option>
                                    <option value="Hibah Pilgub">Hibah Pilgub</option>
                                    <option value="">{kosongi}</option>
                                </select>
                                <div class="invalid-feedback error_sumber_dana"> </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Akun</label>
                                <input type="text" name="akun" class="akun form-control">
                                <div class="invalid-feedback error_akun"> </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Kendaraan </label>
                                <select name="kendaraan" class="kendaraan form-control select2" style="width: 100%;"
                                    data-minimum-results-for-search="Infinity">
                                    <option value="Kendaraan" selected="selected">Kendaraan</option>
                                    <option value="Kendaraan Dinas">Kendaraan Dinas</option>
                                    <option value="Kendaraan Umum">Kendaraan Umum</option>
                                    <option value="Kendaraan Pribadi">Kendaraan Pribadi</option>
                                    <option value="">{kosongi}</option>
                                </select>
                                <div class="invalid-feedback error_kendaraan"> </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Jenis Formulir</label>
                                <select name="formulir" class="formulir form-control select2" style="width: 100%;"
                                    data-minimum-results-for-search="Infinity">
                                    <option value="SPD" selected="selected">SPD</option>
                                    <option value="Lembar Konfirmasi">Lembar Konfirmasi</option>
                                </select>
                                <div class="invalid-feedback error_formulir"> </div>
                            </div>
                        </div>
                    </div>


                    <div class="border rounded border-warning p-2">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kota Ditandatangani</label>
                                    <input name="kota_ttd" id="kota_ttd" type="text" class="form-control"
                                        value="<?=$kota_ttd?>">
                                    <div class="invalid-feedback error_kota_ttd"> </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Ditandatangani</label>
                                    <div class="input-group date" id="tgl_ttd" data-target-input="nearest">
                                        <input name="tgl_ttd" type="text" class="form-control datetimepicker-input"
                                            data-target="#tgl_ttd" value="<?=$tgl_ttd;?>" />
                                        <div class="input-group-append" data-target="#tgl_ttd"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback error_tgl_ttd"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btnsimpan btn btn-primary ">Simpan</button>
                </div>

                <?=form_close()?>
            </div>
        </div>
    </div>
</div>

<script>
function reloadSpd() {
    $.ajax({
        type: "post",
        url: "<?= site_url('spd/nomorSpd')?>",
        data: {},
        dataType: "json",
        success: function(data) {
            $('.agenda_lalu').html("Agenda Sebelumnya: " + data.no_agenda_lalu);
            $('.nomor_spd').val(data.no_agenda);
        },

        error: function(xhr, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },
    });
}

$(".reload_nomor").click(function() {
    reloadSpd();
});

$(document).ready(function() {
    reloadSpd();

    $('#tgl_ttd').datetimepicker({
        format: 'YYYY-MM-DD',
        autoclose: true,
        language: 'id'
    });
});

$('.form').submit(function(e) {
    e.preventDefault();
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
            if (response.error) {
                if (response.error.nomor_spd) {
                    $('.nomor_spd').addClass('is-invalid');
                    $('.error_nomor_spd').html(response.error.nomor_spd)
                } else {
                    $('.nomor_spd').removeClass('is-invalid');
                    $('.error_nomor_spd').html()
                }

                if (response.error.kota_ttd) {
                    $('#kota_ttd').addClass('is-invalid');
                    $('.error_kota_ttd').html(response.error.kota_ttd)
                } else {
                    $('#kota_ttd').removeClass('is-invalid');
                    $('.error_kota_ttd').html()
                }

                if (response.error.tgl_ttd) {
                    $('#tgl_ttd').addClass('is-invalid');
                    $('.error_tgl_ttd').html(response.error.tgl_ttd)
                } else {
                    $('#tgl_ttd').removeClass('is-invalid');
                    $('.error_tgl_ttd').html()
                }

            } else {
                // alert(response.sukses);
                Swal.fire({
                    position: 'top-end',
                    text: response.sukses,
                    showConfirmButton: false,
                    timer: 1000
                })

                $('#modalspd').modal('hide');
                dataDetil();
            }
        },

        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },
    });

    return false;

})
</script>