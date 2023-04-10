<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <?=form_open('template/simpandata', ['class'=>'formtemplate'])?>
            <?=csrf_field();?>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Dasar Surat Tugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Nomor Urut*</label>
                            <input name="nomor_urut" id="nomor_urut" type="number" class="form-control">
                            <div class="invalid-feedback error_nomor_urut"> </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Keterangan Dasar ST*</label>
                    <input name="keterangan" id="keterangan" type="text" class="form-control">
                    <div class="invalid-feedback error_keterangan"> </div>
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
$(document).ready(function() {
    $('.formtemplate').submit(function(e) {
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
                    if (response.error.nomor_urut) {
                        $('#nomor_urut').addClass('is-invalid');
                        $('.error_nomor_urut').html(response.error.nomor_urut)
                    } else {
                        $('#nomor_urut').removeClass('is-invalid');
                        $('.error_nomor_urut').html()
                    }

                    if (response.error.keterangan) {
                        $('#keterangan').addClass('is-invalid');
                        $('.error_keterangan').html(response.error.keterangan)
                    } else {
                        $('#keterangan').removeClass('is-invalid');
                        $('.error_keterangan').html()
                    }

                } else {
                    // alert(response.sukses);
                    Swal.fire({
                        position: 'top-end',
                        text: response.sukses,
                        showConfirmButton: false,
                        timer: 1000
                    })

                    $('#modaltambah').modal('hide');
                    datatemplate();
                }
            },

            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            },

        });

        return false;

    })
});
</script>