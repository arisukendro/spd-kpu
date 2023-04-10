<!-- Modal -->
<div class="modal fade" id="modalview" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Profile Image -->
            <div class="modal-body">
                <div class="box-profile">
                    <h3 class="profile-username text-center"><?= $nama ?></h3>

                    <p class="text-muted text-center"><?= $nama_jabatan.' / '. $nama_klompeg ?></p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>NIP</b> <a class="float-right"><?= $nip ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Pangkat/Gol</b> <a class="float-right"><?= $pangkat.'/'.$golongan?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Subbag/Divisi</b> <a class="float-right"><?= $nama_subbag?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Status</b> <a class="float-right"><?= $aktif==1?'Aktif':'Non Aktif' ?></a>
                        </li>
                    </ul>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary " data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>