<!-- Modal -->
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"><b>Pengeluaran <span class="text-danger"><?=$jenis_formulir?></span></b> |
                    <?=$nama?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card-body">
                    <form action="<?=site_url('spd/simpanPengeluaran')?>" method="post" class="form form-horizontal">
                        <?=csrf_field();?>
                        <input type="hidden" name="id_spd" value="<?=$id_spd?>">
                        <input type="hidden" name="id_spd_pengeluaran"
                            value="<?=isset($id_spd_pengeluaran)?$id_spd_pengeluaran:null;?>" id="id_spd_pengeluaran">

                        <dl class="row">
                            <dt class="col-sm-3">Perihal</dt>
                            <dd class="col-sm-9"><?=$perihal?></dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-sm-3">Nomor SPD</dt>
                            <dd class="col-sm-9"><?=$nomor_spd. ' - Tanggal '.tgl_id($tanggal_spd)?></dd>
                        </dl>
                        <hr>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Uang Harian
                            </label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" name="uang_harian" id="uang_harian"
                                    placeholder="Nominal Harian"
                                    value="<?=isset($uang_harian) ? $uang_harian : null;?>">
                                <div class="invalid-feedback error_uang_harian"> </div>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="ket_uang_harian" id="ket_uang_harian"
                                    placeholder="Keterangan Uang Harian"
                                    value="<?=isset($ket_uang_harian) ? $ket_uang_harian : null;?>">
                                <div class="invalid-feedback error_ket_uang_harian"> </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tiket</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" name="uang_tiket" id="uang_tiket"
                                    placeholder="Nominal Tiket" value="<?=isset($uang_tiket) ? $uang_tiket : null;?>">
                                <div class="invalid-feedback error_uang_tiket"> </div>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="ket_uang_tiket" id="ket_uang_tiket"
                                    placeholder="Keterangan Uang Tiket"
                                    value="<?=isset($ket_uang_tiket) ? $ket_uang_tiket : null;?>">
                                <div class="invalid-feedback error_ket_uang_tiket"> </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Uang Transport</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" name="uang_transport" id="uang_transport"
                                    placeholder="Nominal Transport"
                                    value="<?=isset($uang_transport) ? $uang_transport : null;?>">
                                <div class="invalid-feedback error_uang_transport"> </div>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="ket_uang_transport"
                                    id="ket_uang_transport" placeholder="Keterangan Uang Transport"
                                    value="<?=isset($ket_uang_transport) ? $ket_uang_transport : null;?>">
                                <div class="invalid-feedback error_ket_uang_transport"
                                    value="<?=isset($ket_uang_transport) ? $ket_uang_transport : null;?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Uang Penginapan</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" name="uang_penginapan" id="uang_penginapan"
                                    placeholder="Nominal Penginapan"
                                    value="<?=isset($uang_penginapan) ? $uang_penginapan : null;?>">
                                <div class="invalid-feedback error_uang_penginapan"> </div>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="ket_uang_penginapan"
                                    id="ket_uang_penginapan" placeholder="Keterangan Uang Penginapan"
                                    value="<?=isset($ket_uang_penginapan) ? $ket_uang_penginapan : null;?>">
                                <div class="invalid-feedback error_ket_uang_penginapan"> </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Lainnya (jika ada)</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" name="uang_lain" id="uang_lain"
                                    placeholder="Nominal Lainnya" value="<?=isset($uang_lain) ? $uang_lain : null;?>">
                                <div class="invalid-feedback error_uang_lain"> </div>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="ket_uang_lain"
                                    placeholder="Keterangan Uang Lainnya"
                                    value="<?=isset($ket_uang_lain) ? $ket_uang_lain : null;?>">
                                <div class="invalid-feedback error_ket_uang_lain"> </div>
                            </div>
                        </div>

                        <hr>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Uang Muka</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" name="uang_muka" id="uang_muka"
                                    placeholder="Uang Muka" value="<?=isset($uang_muka) ? $uang_muka : null;?>">
                                <div class="invalid-feedback error_uang_muka"> </div>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="ket_uang_muka" id="ket_uang_muka"
                                    placeholder="Keterangan Uang Muka"
                                    value="<?=isset($ket_uang_muka) ? $ket_uang_muka : null;?>">
                                <div class="invalid-feedback error_ket_uang_muka"> </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-3">
                                <button type="submit" class="btn-simpan btn btn-primary float-left">Simpan</button>
                            </div>
                            <div class="col-sm-6">
                                <div id="pesan_simpan"> </div>
                            </div>

                        </div>
                    </form>
                    <hr>
                    <form action="<?=site_url('spd/cetakKuitansi/')?>" target="blank" method="post"
                        class="form-cetak form-horizontal">

                        <?=csrf_field();?>
                        <input type="hidden" name="id_spd_pengeluaran2"
                            value="<?=isset($id_spd_pengeluaran)?$id_spd_pengeluaran:null;?>" id="id_spd_pengeluaran2">

                        <div class="form-group row">
                            <div class="col-sm-5">
                                <select name="jenis_cetak" class="cetak form-control select2" style="width: 100%;"
                                    data-minimum-results-for-search="Infinity">
                                    <option value="spd-rampung" selected="selected">Cetak SPD Rampung</option>
                                    <option value="uang-muka">Cetak Kuitansi Uang Muka</option>
                                </select>
                                <div class="invalid-feedback error_cetak"> </div>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="tanggal_kuitansi"
                                    placeholder="Masukan tanggal"
                                    value="<?=$ibukota.', '."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".bulan(date('m')).' '.date('Y');?>">
                            </div>
                            <div class="col-sm-3">
                                <input type="submit" id="btn-cetak" name="btn-cetak" class="btn btn-primary"
                                    value="Cetak" disabled="disabled">
                            </div>
                        </div>

                    </form>

                </div>
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

    if ($('#id_spd_pengeluaran').val() == '') {
        $('#btn-cetak').prop('disabled', 'disabled');
        console.log('disabled button');
    } else {
        $('#btn-cetak').prop('disabled', '');
    }

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
                });
                $('#id_spd_pengeluaran').val(response.id_spd_pengeluaran);
                $('#id_spd_pengeluaran2').val(response.id_spd_pengeluaran);
                $('#btn-cetak').prop('disabled', '');

            }
        },

        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },
    });

    return false;

})
</script>