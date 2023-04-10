<table id="tabeldata" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kelompok Pegawai</th>
            <th>Subbag/Divisi</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
    $nomor=0;
    foreach($tampildata as $row):
        $nomor++;
    ?>
        <tr>
            <td><?=$nomor;?></td>
            <td><?=$row['nama']?></td>
            <td><?=$row['nama_klompeg']?></td>
            <td><?=$row['nama_subbag']?></td>
            <td><?=$row['aktif']==1?'<span class="badge badge-success">Aktif</span>':'<span class="badge badge-danger">Non-Aktif</span>'?>
            </td>
            <td align="center">
                <button type="button" class="btn btn-success btn-sm" onclick="view('<?=$row['id_pegawai']?>')"><i
                        class="fa fa-eye"></i></button>
                <button type="button" class="btn btn-warning btn-sm" onclick="edit('<?=$row['id_pegawai']?>')"><i
                        class="fa fa-edit"></i></button>
                <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?=$row['id_pegawai']?>')"><i
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
</script>