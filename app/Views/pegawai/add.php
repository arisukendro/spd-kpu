<!-- Modal -->
<div class="modal fade" id="modaltambah" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <?=form_open('pegawai/store', ['class'=>'formpegawai'])?>
            <?=csrf_field();?>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Lengkap*</label>
                    <input name="nama" id="nama" type="text" class="form-control" placeholder="Nama Lengkap & Gelar">
                    <div class="invalid-feedback error_nama"> </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kelompok Pegawai*</label>
                            <select name="klompeg" id="klompeg" class="form-control select2"
                                data-minimum-results-for-search="Infinity" style="width: 100%;">
                                <option value="">-- Pilih --</option>
                                <?php foreach($data_klompeg as $row): ?>
                                <option value="<?= $row['id_klompeg']?>"><?= $row['nama_klompeg']?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback error_klompeg"> </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pejabat Pemberi Tugas*</label>
                            <select name="setkom" id="setkom" class="form-control select2"
                                data-minimum-results-for-search="Infinity" style="width: 100%;">
                                <option value="">-- Pilih --</option>
                                <option value="ketua">Ketua</option>
                                <option value="sekretaris">Sekretaris</option>
                            </select>
                            <div class="invalid-feedback error_setkom"> </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Sub Bagian/Divisi </label>
                            <select name="subbag" id="subbag" class="form-control select2"
                                data-minimum-results-for-search="Infinity" style="width: 100%;">
                            </select>
                            <div class="invalid-feedback error_subbag"> </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jabatan</label>
                            <select name="jabatan" id="jabatan" class="form-control select2 "
                                data-minimum-results-for-search="Infinity" style="width: 100%;">
                            </select>
                            <div class="invalid-feedback error_jabatan"> </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>NIP <small class="text-muted">Optional</small></label>
                            <input name="nip" id="nip" type="text" class="form-control" placeholder="NIP PNS">
                            <div class="invalid-feedback error_nip"> </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pangkat/Golongan <small class="text-muted">Optional</small></label></label>
                            <select name="pangkat" id="pangkat" class="form-control select2">
                                <option value="">Tak Ber-NIP</option>

                                <?=option_pangkat(null)?>
                            </select>
                            <div class="invalid-feedback error_pangkat"> </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan">Simpan</button>
                <button type="button" class="btn btn-secondary " data-dismiss="modal">Batal</button>
            </div>
            <?=form_close()?>
        </div>
    </div>
</div>

<script>
function dataKlompeg() {
    $('#klompeg').change(function(e) {
        if ($('#klompeg').val().length === 0) {
            $('#subbag').html('');
            $('#jabatan').html('');
        } else {
            $.ajax({
                type: "post",
                url: "<?= site_url('chaindata/dataKlompeg')?>",
                data: {
                    klompeg: $(this).val()
                },
                dataType: "json",
                success: function(response) {
                    if (response.dataSubbag) {
                        $('#subbag').html(response.dataSubbag);
                        $('#subbag').select();
                    }

                    if (response.dataJabatan) {
                        $('#jabatan').html(response.dataJabatan);
                        $('#jabatan').select();
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                },
            });
        }

    });

}


$('.formpegawai').submit(function(e) {
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
                if (response.error.nama) {
                    $('#nama').addClass('is-invalid');
                    $('.error_nama').html(response.error.nama)
                } else {
                    $('#nama').removeClass('is-invalid');
                    $('.error_nama').html()
                }

                if (response.error.klompeg) {
                    $('#klompeg').addClass('is-invalid');
                    $('.error_klompeg').html(response.error.klompeg)
                } else {
                    $('#klompeg').removeClass('is-invalid');
                    $('.error_klompeg').html()
                }

                if (response.error.setkom) {
                    $('#setkom').addClass('is-invalid');
                    $('.error_setkom').html(response.error.setkom)
                } else {
                    $('#setkom').removeClass('is-invalid');
                    $('.error_setkom').html()
                }

                if (response.error.subbag) {
                    $('#subbag').addClass('is-invalid');
                    $('.error_subbag').html(response.error.subbag)
                } else {
                    $('#subbag').removeClass('is-invalid');
                    $('.error_subbag').html()
                }

                if (response.error.jabatan) {
                    $('#jabatan').addClass('is-invalid');
                    $('.error_jabatan').html(response.error.jabatan)
                } else {
                    $('#jabatan').removeClass('is-invalid');
                    $('.error_jabatan').html()
                }

            } else {
                Swal.fire({
                    position: 'top-end',
                    text: response.sukses,
                    showConfirmButton: false,
                    timer: 1000
                });

                $('#modaltambah').modal('hide');
                datapegawai();
            }
        },

        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },

    });

    return false;

})

$(document).ready(function() {
    dataKlompeg();
    $('.select2').select2();
});
</script>