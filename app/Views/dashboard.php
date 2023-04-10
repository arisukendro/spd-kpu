<?=$this->extend('themes/'.config('site')->themes.'/default')?>

<?=$this->section('content')?>


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">

    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">


            <div class="col-md-3">
                <div class="col-12 col-sm-6 col-md-12">
                    <img src="<?=base_url()?>/public/img/logo.png" alt="SPD KPU"
                        class="brand-image img-circle elevation-3"
                        style="opacity: .9; width:200px; align:center; padding:10px 10px; margin:0px 10px 10px 10px;">
                </div>
                <div class="col-12 col-sm-6 col-md-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Surat Tugas</span>
                            <span class="info-box-number">
                                <small><?=$jml_st_bulan_ini.'/'?></small>
                                <?=$jml_st?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <div class="col-12 col-sm-6 col-md-12">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-car"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">SPD</span>
                            <span class="info-box-number">
                                <small><?=$jml_spd_bulan_ini.'/'?></small>
                                <?=$jml_spd?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-12">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-map"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Lokasi</span>
                            <span class="info-box-number"><?=$jml_lokasi?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-12">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pegawai</span>
                            <span class="info-box-number"><?=$jml_pegawai?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

            </div>

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header border-transparent bg-warning">
                        <h3 class="card-title text-bold">Surat Tugas</h3>

                        <a href="<?=site_url('surattugas/tambah')?>" class="btn btn-sm btn-default float-right">Buat
                            Baru</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                    <tr>

                                        <th colspan="2">Tgl ST</th>
                                        <th>Perihal</th>
                                        <th>Nomor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($st_terbaru as $r_st): ?>
                                    <tr>
                                        <td>
                                            <?=$r_st['tanggal_st']?>
                                        </td>
                                        <td colspan="2"><?=$r_st['perihal_st']?>
                                        </td>
                                        <td><span class="badge badge-success"><?=ucfirst($r_st['jenis_st']) ?></span>
                                            <br>
                                            <?=$r_st['nomor_st']?>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">

                        <a href="<?=site_url('surattugas')?>" class="btn btn-sm btn-secondary float-right">Tampilkan
                            Semua</a>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    </div>



</div>
<!-- /.container-fluid -->
</div>
<!-- /.content -->


<?=$this->endSection()?>