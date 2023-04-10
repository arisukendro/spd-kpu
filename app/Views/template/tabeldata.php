<table id="tabeldata" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nomor Urut</th>
            <th>Keterangan</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($tampildata as $row):?>
        <tr>
            <td><?=$row['nomor_urut']?></td>
            <td><?=$row['keterangan']?></td>
            <td align="center">
                <button type="button" class="btn btn-warning btn-sm" onclick="edit('<?=$row['id_template_st']?>')"><i
                        class="fa fa-edit"></i></button>
                <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?=$row['id_template_st']?>')"><i
                        class="fa fa-trash"></i></button>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>

</table>
<!-- Page specific script -->


<script>
$(document).ready(function() {

    $("#tabeldata").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "print"]
    }).buttons().container().appendTo('#tabeldata_wrapper .col-md-6:eq(0)');
});

function edit(id_template_st) {
    $.ajax({
        type: "post",
        url: "<?=site_url('template/formedit')?>",
        data: {
            id_template_st: id_template_st
        },
        dataType: "json",

        success: function(response) {
            if (response.sukses) {
                $('.viewmodal').html(response.sukses).show();
                $('#modaledit').modal('show');
            }
        },

        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        },

    });
}

function hapus(id_template_st) {
    Swal.fire({
        title: 'Konfirmasi Penghapusan [ID=' + id_template_st + ']',
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
                url: "<?=site_url('template/hapusdata/')?>" + id_template_st,
                data: {
                    id_template_st: id_template_st
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
                    datatemplate();
                },

                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                },

            });
        }
    })
}
</script>