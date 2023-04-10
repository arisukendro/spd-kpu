<!-- Modal -->
<div class="modal fade" id="modal-form" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ganti Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?=site_url('users/changePassword') ?>" method="post" class="form">
                <div class="modal-body">
                    <?= csrf_field() ?>
                    <input type="hidden" name="user_id" id="user_id" value="<?=$user_id?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input name="username" id="username" type="text" class="form-control"
                                    value="<?=$username?>" readonly>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password"><?=lang('Auth.password')?></label>
                                <input type="password" name="password" class="password form-control" autocomplete="off">
                                <div class="invalid-feedback error_password"> </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pass_confirm"><?=lang('Auth.repeatPassword')?></label>
                                <input type="password" name="pass_confirm" class="pass_confirm form-control"
                                    autocomplete="off">
                                <div class="invalid-feedback error_pass_confirm"> </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btnsimpan btn btn-primary ">Simpan</button>
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
                if (response.error.old_password) {
                    $('.old_password').addClass('is-invalid');
                    $('.error_old_password').html(response.error.old_password)
                } else {
                    $('.old_password').removeClass('is-invalid');
                    $('.error_old_password').html()
                }
                if (response.error.password) {
                    $('.password').addClass('is-invalid');
                    $('.error_password').html(response.error.password)
                } else {
                    $('.password').removeClass('is-invalid');
                    $('.error_password').html()
                }

                if (response.error.pass_confirm) {
                    $('.pass_confirm').addClass('is-invalid');
                    $('.error_pass_confirm').html(response.error.pass_confirm)
                } else {
                    $('.pass_confirm').removeClass('is-invalid');
                    $('.error_pass_confirm').html()
                }

            } else {
                Swal.fire({
                    icon: 'success',
                    title: response.sukses,
                    showConfirmButton: false,
                    timer: 1500
                });

                $('#modal-form').modal('hide');
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