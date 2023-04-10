<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <?=form_open('spd/update/'.$id_spd, ['class'=>'form'])?>
            <?=csrf_field();?>
            <input type="hidden" name="id_spd" value="<?=$id_spd?>">
            <div class="modal-header">
                <h5 class="modal-title"><b>Ubah Data SPD | </b> <?=$nama?>
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
                            <input name="nomor_spd" type="text" class="nomor_spd form-control" value="<?=$nomor_spd?>"
                                readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tingkat biaya perjalanan </label>
                                <select name="tingkat_spd" class="tingkat_spd form-control select2" style="width: 100%;"
                                    data-minimum-results-for-search="Infinity">
                                    <option value="Tingkat C" <?=$tingkat_spd == 'Tingkat C' ? 'selected':''; ?>
                                        selected>Tingkat C</option>
                                    <option value="Tingkat B" <?=$tingkat_spd == 'Tingkat B' ? 'selected':''; ?>>Tingkat
                                        B</option>
                                    <option value="Tingkat A" <?=$tingkat_spd == 'Tingkat A' ? 'selected':''; ?>>Tingkat
                                        A</option>
                                </select>
                                <div class="invalid-feedback error_tingkat_spd"> </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Sumber dana/anggaran</label>
                                <select name="sumber_dana" class="sumber_dana form-control select2" style="width: 100%;"
                                    data-minimum-results-for-search="Infinity">
                                    <option value="APBN" <?=$sumber_dana == 'APBN' ? 'selected':''; ?>>APBN</option>
                                    <option value="Hibah Pilbup" <?=$sumber_dana == 'Hibah Pilbup' ? 'selected':''; ?>>
                                        Hibah Pilbup</option>
                                    <option value="Hibah Pilgub" <?=$sumber_dana == 'Hibah Pilgub' ? 'selected':''; ?>>
                                        Hibah Pilgub</option>
                                    <option value="">{kosongi}</option>
                                </select>
                                <div class="invalid-feedback error_sumber_dana"> </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Akun</label>
                                <input type="text" name="akun" class="akun form-control" value="<?=$akun?>">
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
                                    <option value="Kendaraan" <?=$kendaraan == 'Kendaraan' ? 'selected':''; ?>>Kendaraan
                                    </option>
                                    <option value="Kendaraan Dinas"
                                        <?=$kendaraan == 'Kendaraan Dinas' ? 'selected':''; ?>>Kendaraan Dinas</option>
                                    <option value="Kendaraan Umum"
                                        <?=$kendaraan == 'Kendaraan Umum' ? 'selected':''; ?>>Kendaraan Umum</option>
                                    <option value="Kendaraan Pribadi"
                                        <?=$kendaraan == 'Kendaraan Pribadi' ? 'selected':''; ?>>Kendaraan Pribadi
                                    </option>
                                    <option value="" <?=$kendaraan == NULL ? 'selected':''; ?>>{kosongi}</option>
                                </select>
                                <div class="invalid-feedback error_kendaraan"> </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Jenis Formulir</label>
                                <select name="formulir" class="formulir form-control select2" style="width: 100%;"
                                    data-minimum-results-for-search="Infinity">
                                    <option value="SPD" <?=$jenis_formulir == "SPD" ? 'selected':''; ?>>SPD</option>
                                    <option value="Lembar Konfirmasi"
                                        <?=$jenis_formulir == "Lembar Konfirmasi" ? 'selected':''; ?>>Lembar Konfirmasi
                                    </option>
                                </select>
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
$(document).ready(function() {
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

                $('#modaledit').modal('hide');
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