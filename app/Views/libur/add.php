<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?=form_open('libur/store', ['class'=>'form'])?>
            <?=csrf_field();?>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Libur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Tanggal Ditandatangani</label>
                    <div class="input-group date" id="tglLibur" data-target-input="nearest">
                        <input name="tglLibur" type="text" class="form-control datetimepicker-input"
                            data-target="#tglLibur" value="<?=date('Y-m-d');?>" />
                        <div class="input-group-append" data-target="#tglLibur" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    <div class="invalid-feedback error_tglLibur"> </div>
                </div>

                <div class="form-group">
                    <label>Keterangan*</label>
                    <input name="keterangan" id="keterangan" type="text" class="form-control"
                        placeholder="Tidak boleh kosong">
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

                if (response.error.tglLibur) {
                    $('#tglLibur').addClass('is-invalid');
                    $('.error_tglLibur').html(response.error.tglLibur)
                } else {
                    $('#tglLibur').removeClass('is-invalid');
                    $('.error_tglLibur').html()
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
                listData();
            }
        },

        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },

    });

    return false;

})
$(document).ready(function() {
    $(' #tglLibur').datetimepicker({
        // format: 'L',
        format: 'YYYY-MM-DD',
        autoclose: true,
        language: 'id',
    });

});
</script>