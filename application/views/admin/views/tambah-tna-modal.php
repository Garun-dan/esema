<!-- Tambah TNA -->
<?php foreach ($getJenjang as $j) { ?>
    <?php foreach ($getRumah as $gr) {
        $dataInstrumen = $this->MasterDataModel->getAllInstrumen(['id_jenjang' => $j->id_jenjang]);
    ?>
        <div class="modal fade" id="rumahModal_<?= $j->id_jenjang; ?>_<?= $gr->id_rumah; ?>" tabindex="-1" aria-labelledby="rumahLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="rumahLabel">Pilih Instrumen <?= $j->nama_jenjang; ?> Untuk Rumah Jabatan <?= $gr->nama_rumah; ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url('admin/tna/data-tna/tambah-tna'); ?>" method="post" class="tambahdataTNA">
                        <input type="hidden" name="id_jabfung" id="id_jabfung" value="<?= $j->id_jabfung; ?>">
                        <input type="hidden" name="id_jenjang" id="id_jenjang" value="<?= $j->id_jenjang; ?>">
                        <input type="hidden" name="id_rumah" id="id_rumah" value="<?= $gr->id_rumah; ?>">
                        <div class="modal-body">
                            <div class="form-group row mb-3">
                                <div class="col-lg-8 col-sm-8 mb-3">
                                    <div class="table-responsive mt-3">
                                        <table id="tabel" class="display table table-striped table-bordered table-hover">
                                            <thead class="table-success">
                                                <tr>
                                                    <th class="text-center" style="vertical-align: middle;">No</th>
                                                    <th class="text-center" style="vertical-align: middle;">Instrumen</th>
                                                    <th class="text-center" style="vertical-align: middle;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1;
                                                foreach ($dataInstrumen as $di) { ?>
                                                    <tr>
                                                        <td class="text-center"><?= $i; ?></td>
                                                        <td style="text-align: justify;"><?= $di->instrumen; ?></td>
                                                        <td class="text-center">
                                                            <input class="form-check-input" type="checkbox" value="<?= $di->id_instrumen; ?>" id="pil_instrumen" name="pil_instrumen[]">
                                                        </td>
                                                    </tr>
                                                <?php $i++;
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 mb-3">
                                    <div class="form-group mb-3">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" cols="" rows="10" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="tgl_mulai">Tanggal Mulai</label>
                                        <input type="datetime-local" name="tgl_mulai" id="tgl_mulai" class="form-control" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="tgl_selesai">Tanggal Selesai</label>
                                        <input type="datetime-local" name="tgl_selesai" id="tgl_selesai" class="form-control" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="min_respon">Minimal Responden</label>
                                        <input type="number" name="min_respon" id="min_respon" class="form-control" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="jenis_skala">Jenis Skala</label>
                                        <select name="jenis_skala" id="jenis_skala" class="form-control">
                                            <?php foreach ($getSkala as $gs) { ?>
                                                <option value="<?= $gs->id_skala; ?>"><?= $gs->nama_skala; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>
<script src="https://cdn.tiny.cloud/1/xeknkmt7y7rwmr93g85hqf0tudif5yftvh9h0esxznsmojia/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });

    $(document).ready(function() {
        $(".tambahdataTNA").submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            var modal = $(this).closest(".modal");
            $.post($(this).attr("action"), formData, function(response) {
                modal.modal("hide");
                $(".modal-backdrop").remove();
            });
        });
    });
</script>