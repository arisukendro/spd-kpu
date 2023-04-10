<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?=form_open('jabatan/store', ['class'=>'form'])?>
            <?=csrf_field();?>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jabatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Klompeg/Kelompok Pegawai*</label>
                    <select name="klompeg" id="klompeg" class="form-control select2">
                        <option value="">-- Pilih --</option>
                        <?php
                        foreach($dataKlompeg as $row): 
                        ?>
                        <option value="<?= $row['id_klompeg'] ?>"><?= $row['nama_klompeg'] ?></option>
                        <?php
                        endforeach ?>
                    </select>
                    <div class="invalid-feedback error_klompeg"> </div>
                </div>

                <div class="form-group">
                    <label>Nama Bagian*</label>
                    <input name="nama_jabatan" id="nama_jabatan" type="text" class="form-control"
                        placeholder="Tidak boleh kosong">
                    <div class="invalid-feedback error_nama_jabatan"> </div>
                </div>
                <div class="form-group">
                    <label>Nomor Urut*</label>
                    <input name="urutan_tampil" id="urutan_tampil" type="number" class="form-control"
                        placeholder="Tidak boleh kosong">
                    <div class="invalid-feedback error_urutan_tampil"> </div>
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

                    if (response.error.klompeg) {
                        $('#klompeg').addClass('is-invalid');
                        $('.error_klompeg').html(response.error.klompeg)
                    } else {
                        $('#klompeg').removeClass('is-invalid');
                        $('.error_klompeg').html()
                    }
                    if (response.error.nama_jabatan) {
                        $('#nama_jabatan').addClass('is-invalid');
                        $('.error_nama_jabatan').html(response.error.nama_jabatan)
                    } else {
                        $('#nama_jabatan').removeClass('is-invalid');
                        $('.error_nama_jabatan').html()
                    }
                    if (response.error.urutan_tampil) {
                        $('#urutan_tampil').addClass('is-invalid');
                        $('.error_urutan_tampil').html(response.error.urutan_tampil)
                    } else {
                        $('#urutan_tampil').removeClass('is-invalid');
                        $('.error_urutan_tampil').html()
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
});
</script>