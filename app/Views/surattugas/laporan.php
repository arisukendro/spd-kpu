<?=$this->extend('themes/'.config('site')->themes.'/default')?>

<?=$this->section('content')?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3><?=$title_page?></h3>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-3">
                <div class="card card-danger">

                    <div class="card-header">
                        <h3 class="card-title">Agenda Surat Tugas </h3>
                    </div>
                    <!-- /.card-header -->
                    <?=form_open('laporan/stAgenda', ['class'=>'form', 'target' => '_blank'])?>
                    <?=csrf_field();?>

                    <div class="card-body">

                        <div class="form-group">
                            <label>Pilih Tahun</label>
                            <div class="input-group date" id="tahun" data-target-input="nearest">
                                <input name="tahun" type="text" class="form-control datetimepicker-input"
                                    data-target="#tahun" value="<?= date('Y');?>" />
                                <div class="input-group-append" data-target="#tahun" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <div class="invalid-feedback error_tahun"> </div>

                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-danger">Cetak</button>
                    </div>
                    <!-- /.card-footer-->
                    <?=form_close()?>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>

    </div>
</div>

<script>
$(document).ready(function() {

    $('.select2').select2()

    //Date picker
    $('#bulan_1, #bulan_2').datetimepicker({
        format: "YYYY-MM",
        startView: "months",
        minViewMode: "months",
        language: 'id',
        autoclose: true
    });
    $('#tahun').datetimepicker({
        format: "YYYY",
        startView: "years",
        minViewMode: "years",
        language: 'id',
        autoclose: true
    });

});
</script>

<?=$this->endSection()?>