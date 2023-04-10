<!-- Modal -->
<div class="modal fade " id="modal-edit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?=form_open('users/update', ['class'=>'form'])?>
            <?=csrf_field();?>
            <input type="hidden" name="user_id" value="<?=$user_id?>">
            <div class="modal-header">
                <h5 class="modal-title">Edit Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Username</label>
                            <input name="username" id="username" type="text" class="form-control" value="<?=$username?>"
                                readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input name="realname" id="realname" type="text" class="form-control"
                                value="<?=$realname?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Level User</label>
                            <select name="group_level" id="group_name" class="form-control">
                                <?php foreach($group as $r_group): ?>
                                <option value=<?=$r_group['id']?>
                                    <?= $r_group['name'] == $group_name ? 'selected' : '' ?>>
                                    <?=$r_group['description'] ?>
                                </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="active" id="aktif" class="form-control select">
                                <option value="1" <?= $active == 1 ? 'selected' : '' ?>>Aktif</option>
                                <option value="0" <?= $active == 0 ? 'selected' : '' ?>>Non Aktif</option>
                            </select>
                            <div class="invalid-feedback error_aktif"> </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan">Update</button>
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
            $('.btnsimpan').html('Update');
        },

        success: function(response) {

            Swal.fire({
                position: 'top-end',
                text: response.sukses,
                showConfirmButton: false,
                timer: 1000
            })

            $('#modal-edit').modal('hide');
            listData();
        },

        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },
    });

    return false;

});
</script>