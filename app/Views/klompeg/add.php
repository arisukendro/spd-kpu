<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?=form_open('klompeg/simpandata', ['class'=>'formklompeg'])?>
            <?=csrf_field();?>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Klompeg/Kelompok Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Klompeg/Kelompok Pegawai*</label>
                    <input name="nama_klompeg" id="nama_klompeg" type="text" class="form-control">
                    <div class="invalid-feedback error_nama_klompeg"> </div>
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
    $('.formklompeg').submit(function(e) {
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
                    if (response.error.nama_klompeg) {
                        $('#nama_klompeg').addClass('is-invalid');
                        $('.error_nama_klompeg').html(response.error.nama_klompeg)
                    } else {
                        $('#nama_klompeg').removeClass('is-invalid');
                        $('.error_nama_klompeg').html()
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
                    dataklompeg();
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