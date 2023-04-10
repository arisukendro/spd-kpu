<?=$this->extend('themes/'.config('site')->themes.'/default')?>

<?=$this->section('content')?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pejabat Penandatangan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">

            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <?=form_open('penandatangan/update', ['class'=>'form'])?>
            <?=csrf_field();?>
            <input type="hidden" name="id_penandatangan" value="<?=$id_penandatangan?>">
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Ketua</label>
                            <input name="ketua" id="ketua" type="text" class="form-control" value="<?=$ketua?>"
                                placeholder="Nama Ketua">
                            <div class="invalid-feedback error_ketua"> </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Plt. Ketua</label>
                            <input name="plt_ketua" id="plt_ketua" type="text" class="form-control"
                                value="<?=$plt_ketua?>" placeholder="Nama Plt Ketua">
                            <div class="invalid-feedback error_plt_ketua"> </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Plh. Ketua</label>
                            <input name="plh_ketua" id="plh_ketua" type="text" class="form-control"
                                value="<?=$plh_ketua?>" placeholder="Nama Plh Ketua">
                            <div class="invalid-feedback error_plh_ketua"> </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sekretaris</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input name="sekretaris" id="sekretaris" type="text" class="form-control"
                                        value="<?=$sekretaris?>" placeholder="Nama Sekretaris">
                                    <div class="invalid-feedback error_sekretaris"> </div>
                                </div>
                                <div class="col-md-6">
                                    <input name="nip_sekretaris" id="nip_sekretaris" type="text" class="form-control"
                                        value="<?=$nip_sekretaris?>" placeholder="NIP sekretaris">
                                    <div class="invalid-feedback error_nip_sekretaris"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Plt. Sekretaris</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input name="plt_sekretaris" id="plt_sekretaris" type="text" class="form-control"
                                        value="<?=$plt_sekretaris?>" placeholder="Nama Plt. Sekretaris">
                                    <div class="invalid-feedback error_plt_sekretaris"> </div>
                                </div>
                                <div class="col-md-6">
                                    <input name="nip_plt_sekretaris" id="nip_plt_sekretaris" type="text"
                                        class="form-control" value="<?=$nip_plt_sekretaris?>"
                                        placeholder="NIP Plt Sekretaris">
                                    <div class="invalid-feedback error_nip_plt_sekretaris"> </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Plh. Sekretaris</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input name="plh_sekretaris" id="plh_sekretaris" type="text" class="form-control"
                                        value="<?=$plh_sekretaris?>" placeholder="Plh. Sekretaris">
                                    <div class="invalid-feedback error_plh_sekretaris"> </div>
                                </div>
                                <div class="col-md-6">
                                    <input name="nip_plh_sekretaris" id="nip_plh_sekretaris" type="text"
                                        class="form-control" value="<?=$nip_plh_sekretaris?>"
                                        placeholder="NIP Plh. Sekretaris">
                                    <div class="invalid-feedback error_nip_plh_sekretaris"> </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Pejabat Pembuat Komitmen (PPKom)</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input name="ppkom" id="ppkom" type="text" class="form-control" value="<?=$ppkom?>"
                                        placeholder="Nama PPkom">
                                    <div class="invalid-feedback error_ppkom"> </div>
                                </div>
                                <div class="col-md-6">
                                    <input name="nip_ppkom" id="nip_ppkom" type="text" class="form-control"
                                        value="<?=$nip_ppkom?>" placeholder="NIP PPKom">
                                    <div class="invalid-feedback error_nip_ppkom"> </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Bendahara</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input name="bendahara" id="bendahara" type="text" class="form-control"
                                        value="<?=$bendahara?>" placeholder="Nama Bendahara">
                                    <div class="invalid-feedback error_bendahara"> </div>
                                </div>
                                <div class="col-md-6">
                                    <input name="nip_bendahara" id="nip_bendahara" type="text" class="form-control"
                                        value="<?=$nip_bendahara?>" placeholder="NIP Bendahara">
                                    <div class="invalid-feedback error_nip_bendahara"> </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btnsimpan">Simpan</button>
            </div>
            <!-- /.card-footer -->
            <?=form_close()?>

        </div>
        <!-- /.card -->
    </div>
</div>



<script>
$(document).ready(function() {
    //Initialize Select2 Elements
    $('.select2').select2()
    $('.select2bs4').select2();
});

$('.form').submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: "post",
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: "json",

        success: function(response) {
            if (response.error) {
                if (response.error.ketua) {
                    $('#ketua').addClass('is-invalid');
                    $('.error_ketua').html(response.error.ketua)
                } else {
                    $('#ketua').removeClass('is-invalid');
                    $('.error_ketua').html()
                }

                if (response.error.plt_ketua) {
                    $('#plt_ketua').addClass('is-invalid');
                    $('.error_plt_ketua').html(response.error.plt_ketua)
                } else {
                    $('#plt_ketua').removeClass('is-invalid');
                    $('.error_plt_ketua').html()
                }

                if (response.error.plh_ketua) {
                    $('#plh_ketua').addClass('is-invalid');
                    $('.error_plh_ketua').html(response.error.plh_ketua)
                } else {
                    $('#plh_ketua').removeClass('is-invalid');
                    $('.error_plh_ketua').html()
                }

                if (response.error.sekretaris) {
                    $('#sekretaris').addClass('is-invalid');
                    $('.error_sekretaris').html(response.error.sekretaris)
                } else {
                    $('#sekretaris').removeClass('is-invalid');
                    $('.error_sekretaris').html()
                }

                if (response.error.nip_sekretaris) {
                    $('#nip_sekretaris').addClass('is-invalid');
                    $('.error_nip_sekretaris').html(response.error.nip_sekretaris)
                } else {
                    $('#nip_sekretaris').removeClass('is-invalid');
                    $('.error_nip_sekretaris').html()
                }

                if (response.error.plt_sekretaris) {
                    $('#plt_sekretaris').addClass('is-invalid');
                    $('.error_plt_sekretaris').html(response.error.plt_sekretaris)
                } else {
                    $('#plt_sekretaris').removeClass('is-invalid');
                    $('.error_plt_sekretaris').html()
                }

                if (response.error.nip_plt_sekretaris) {
                    $('#nip_plt_sekretaris').addClass('is-invalid');
                    $('.error_nip_plt_sekretaris').html(response.error.nip_plt_sekretaris)
                } else {
                    $('#nip_plt_sekretaris').removeClass('is-invalid');
                    $('.error_nip_plt_sekretaris').html()
                }

                if (response.error.plh_sekretaris) {
                    $('#plh_sekretaris').addClass('is-invalid');
                    $('.error_plh_sekretaris').html(response.error.plh_sekretaris)
                } else {
                    $('#plh_sekretaris').removeClass('is-invalid');
                    $('.error_plh_sekretaris').html()
                }

                if (response.error.nip_plh_sekretaris) {
                    $('#nip_plh_sekretaris').addClass('is-invalid');
                    $('.error_nip_plh_sekretaris').html(response.error.nip_plh_sekretaris)
                } else {
                    $('#nip_plh_sekretaris').removeClass('is-invalid');
                    $('.error_nip_plh_sekretaris').html()
                }

                if (response.error.ppkom) {
                    $('#ppkom').addClass('is-invalid');
                    $('.error_ppkom').html(response.error.ppkom)
                } else {
                    $('#ppkom').removeClass('is-invalid');
                    $('.error_ppkom').html()
                }

                if (response.error.nip_ppkom) {
                    $('#nip_ppkom').addClass('is-invalid');
                    $('.error_nip_ppkom').html(response.error.nip_ppkom)
                } else {
                    $('#nip_ppkom').removeClass('is-invalid');
                    $('.error_nip_ppkom').html()
                }

                if (response.error.bendahara) {
                    $('#bendahara').addClass('is-invalid');
                    $('.error_bendahara').html(response.error.bendahara)
                } else {
                    $('#bendahara').removeClass('is-invalid');
                    $('.error_bendahara').html()
                }

                if (response.error.nip_bendahara) {
                    $('#nip_bendahara').addClass('is-invalid');
                    $('.error_nip_bendahara').html(response.error.nip_bendahara)
                } else {
                    $('#nip_bendahara').removeClass('is-invalid');
                    $('.error_nip_bendahara').html()
                }

            } else {
                // alert(response.sukses);
                Swal.fire({
                    position: 'top-end',
                    text: response.sukses,
                    showConfirmButton: false,
                    timer: 1000
                });

                datapenandatangan();
            }
        },

        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },
    });

    return false;

});
</script>

<?=$this->endSection()?>