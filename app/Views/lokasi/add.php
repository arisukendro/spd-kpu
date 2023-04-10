<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?=form_open('lokasi/store', ['class'=>'form'])?>
            <?=csrf_field();?>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Lokasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Lokasi*</label>
                    <input name="nama_lokasi" id="nama_lokasi" type="text" class="form-control"
                        placeholder="Contoh: Kantor Kecamatan Nusawungu">
                    <div class="invalid-feedback error_nama_lokasi"> </div>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input name="alamat" id="alamat" type="text" class="form-control" placeholder="Jln. Rusak Parah">
                </div>
                <div class="form-group">
                    <label>Kota Lokasi*</label>
                    <input name="kota_lokasi" id="kota_lokasi" type="text" class="form-control"
                        placeholder="Contoh: Nusawungu">
                    <div class="invalid-feedback error_kota_lokasi"> </div>

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
                if (response.error.nama_lokasi) {
                    $('#nama_lokasi').addClass('is-invalid');
                    $('.error_nama_lokasi').html(response.error.nama_lokasi)
                } else {
                    $('#nama_lokasi').removeClass('is-invalid');
                    $('.error_nama_lokasi').html()
                }

                if (response.error.kota_lokasi) {
                    $('#kota_lokasi').addClass('is-invalid');
                    $('.error_kota_lokasi').html(response.error.kota_lokasi)
                } else {
                    $('#kota_lokasi').removeClass('is-invalid');
                    $('.error_kota_lokasi').html()
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
</script>