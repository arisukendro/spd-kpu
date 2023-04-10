<!-- Modal -->
<div class="modal fade" id="modal-laporan" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?=form_open('laporan/agendaSpdBulanan', ['class'=>'form'])?>
            <?=csrf_field();?>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Pilih Formulir</label>
                    <select name="jenis_form" class="jenis_form form-control select2"
                        data-minimum-results-for-search="Infinity" style="width: 100%;">
                        <option value="">Pilih</option>
                        <option value="rekap">Rekapitulasi SPD</option>
                        <option value="rincian">Rincian SPD</option>
                        <option value="agenda">Agenda SPD</option>
                    </select>
                </div>
                <div class="form-group div-klompeg">
                    <label>Kelompok Pegawai</label>
                    <select name="klompeg" class="klompeg form-control select2"
                        data-minimum-results-for-search="Infinity" style="width: 100%;">
                        <?php foreach($klompeg as $rklompeg): ?>
                        <option value="<?=$rklompeg['id_klompeg']?>"><?=$rklompeg['nama_klompeg']?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback error_klompeg"> </div>
                </div>

                <div class="form-group">
                    <label>Periode</label>
                    <div class="input-group date" id="bulan_1" data-target-input="nearest">
                        <input name="bulan" type="text" class="form-control datetimepicker-input" data-target="#bulan_1"
                            value="<?= date('Y-m');?>" />
                        <div class="input-group-append" data-target="#bulan_1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    <div class="invalid-feedback error_bulan_1"> </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary ">Cetak</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.select2').select2();

    $('#bulan_1').datetimepicker({
        format: "YYYY-MM",
        startView: "months",
        minViewMode: "months",
        language: 'id',
        autoclose: true
    });
});

$(".jenis_form").change(function() {
    if ($(this).val() == 'agenda') { // or this.value == 'volvo'
        $('.div-klompeg').hide();

    } else {
        $('.div-klompeg').show();
    }
});

$('.form').submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: "post",
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: "json",
    });

    return false;

})
</script>