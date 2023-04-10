<table id="tabeldata" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Lokasi</th>
            <th>Alamat</th>
            <th>Kota</th>
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
            <td><?=$row['nama_lokasi']?></td>
            <td><?=$row['alamat']?></td>
            <td><?=$row['kota_lokasi']?></td>
            <td align="center">
                <button type="button" class="btn btn-warning btn-sm" onclick="edit('<?=$row['id_lokasi']?>')"><i
                        class="fa fa-edit"></i></button>
                <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?=$row['id_lokasi']?>')"><i
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
    });

});
</script>