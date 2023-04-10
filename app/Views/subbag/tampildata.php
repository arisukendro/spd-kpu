<?=$this->extend('themes/'.config('site')->themes.'/default')?>


<?=$this->section('content')?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?=$title_page?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <div class="breadcrumb float-sm-right">
                    <button type="button" class="btn btn-primary tomboltambah"><i class="fa fa-plus-circle"
                            data-toggle="modal" data-target="#viewmodal"></i> Tambah</button>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="card-text viewdata">

                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<!-- Page specific script -->
<script>
function datasubbag() {
    $.ajax({
        url: "<?=site_url('subbag/ambildata')?>",
        dataType: "json",
        success: function(response) {
            $('.viewdata').html(response.data)
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

$(document).ready(function() {
    datasubbag();

    $('.tomboltambah').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?=site_url('subbag/formtambah')?>",
            dataType: "json",
            success: function(response) {
                $('.viewmodal').html(response.data).show();
                $('#modaltambah').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });

});
</script>

<?=$this->endSection()?>