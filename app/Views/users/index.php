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
                    <button type="button" class="btn btn-primary btnTambah"><i class="fa fa-plus-circle"
                            data-toggle="modal" data-target="#modal-view"></i> Tambah</button>
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
function listData() {
    $.ajax({
        url: "<?=site_url('users/listData')?>",
        dataType: "json",
        success: function(response) {
            $('.viewdata').html(response.data)
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

function password(id_user) {
    $.ajax({
        type: "post",
        url: "<?=site_url('users/formPassword')?>",
        data: {
            id_user: id_user
        },
        dataType: "json",

        success: function(response) {
            if (response.sukses) {
                $('.viewmodal').html(response.sukses).show();
                $('#modal-form').modal('show');
            }
        },

        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },
    });
}

function edit(id_user) {
    $.ajax({
        type: "post",
        url: "<?=site_url('users/edit')?>",
        data: {
            id_user: id_user
        },
        dataType: "json",

        success: function(response) {
            if (response.sukses) {
                $('.viewmodal').html(response.sukses).show();
                $('#modal-edit').modal('show');
            }
        },

        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },

    });
}

function del(id_user) {
    Swal.fire({
        title: 'Konfirmasi Penghapusan [ID = ' + id_user + ']',
        text: 'Data yang dihapus tidak bisa dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'

    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: "<?=site_url('users/delete/')?>" + id_user,
                data: {
                    id_user: id_user
                },
                dataType: "json",

                success: function(response) {
                    if (response.sukses) {
                        Swal.fire({
                            position: 'top-end',
                            text: response.sukses,
                            showConfirmButton: false,
                            timer: 1000,

                        })
                    }
                    listData();
                },

                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                },

            });
        }
    })
};

$('.btnTambah').click(function(e) {
    e.preventDefault();
    $.ajax({
        url: "<?=site_url('users/add')?>",
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

$(document).ready(function() {
    listData();
    $('.select2').select2();
});
</script>

<?=$this->endSection()?>