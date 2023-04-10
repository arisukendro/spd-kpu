<table id="tabeldata" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No Urut</th>
            <th>Kelompok Pegawai</th>
            <th>Jabatan</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
    // $nomor=0;
    foreach($tampildata as $row):
        // $nomor++;
    ?>
        <tr>
            <td><?=$row['urutan_tampil'];?></td>
            <td><?=$row['nama_klompeg']?></td>
            <td><?=$row['nama_jabatan']?></td>
            <td align="center">
                <button type="button" class="btn btn-warning btn-sm" onclick="edit('<?=$row['id_jabatan']?>')"><i
                        class="fa fa-edit"></i></button>
                <button type="button" class="btn btn-danger btn-sm" onclick="del('<?=$row['id_jabatan']?>')"><i
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
    });

});
</script>