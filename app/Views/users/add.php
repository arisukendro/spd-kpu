<!-- Modal -->
<div class="modal fade" id="modaltambah" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?= view('Myth\Auth\Views\_message_block') ?>

            <form action="<?=site_url('users/store') ?>" method="post" class="form">
                <div class="modal-body">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="username form-control " name="username">
                                <div class="invalid-feedback error_username"> </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="realname">Nama Lengkap</label>
                                <input type="text" class="realname form-control " name="realname">
                                <div class="invalid-feedback error_urealname"> </div>
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

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email"><?=lang('Auth.email')?></label>
                                <input type="email" class="email form-control" name="email">
                                <div class="invalid-feedback error_email"> </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Level User</label>
                                <select name="group_level" id="group_name" class="form-control">
                                    <?php foreach($group as $r_group): ?>
                                    <option value=<?=$r_group['id']?>>
                                        <?=$r_group['description'] ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary "><?=lang('Auth.register')?></button>
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
                if (response.error.username) {
                    $('.username').addClass('is-invalid');
                    $('.error_username').html(response.error.username)
                } else {
                    $('.username').removeClass('is-invalid');
                    $('.error_username').html()
                }
                if (response.error.realname) {
                    $('.realname').addClass('is-invalid');
                    $('.error_realname').html(response.error.realname)
                } else {
                    $('.realname').removeClass('is-invalid');
                    $('.error_realname').html()
                }

                if (response.error.email) {
                    $('.email').addClass('is-invalid');
                    $('.error_email').html(response.error.email)
                } else {
                    $('.email').removeClass('is-invalid');
                    $('.error_email').html()
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
                    position: 'top-end',
                    text: response.sukses,
                    showConfirmButton: false,
                    timer: 1000
                });

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
    $('.select2').select2()
});
</script>