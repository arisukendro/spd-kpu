<!-- Modal -->
<div class="modal fade" id="modal-view" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Profile Image -->
            <div class="modal-body">
                <div class="box-profile">
                    <h3 class="profile-username text-center"><?= $username ?></h3>

                    <p class="text-muted text-center">Level <?= $group_description ?></p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Email</b> <a class="float-right"><?= $email ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Status User</b> <a class="float-right"><?= $active == 1 ? 'Aktif' : 'Non Aktif'?></a>
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