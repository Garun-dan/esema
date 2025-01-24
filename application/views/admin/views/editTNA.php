<?php
$segments_after_admin = $this->uri->segment_array(2);
array_shift($segments_after_admin);
$redirect_url = implode("/", $segments_after_admin);

foreach ($getTNA as $tna) {
    $dataJabfung = $this->MasterDataModel->getOneJabfung(['id_jabfung' => $tna->id_jabfung]);
    $dataJenjang = $this->MasterDataModel->getOneJenjang(['id_jenjang' => $tna->id_jenjang]);
    $getsJenjang = $this->MasterDataModel->getAllJenjang(['id_jabfung' => $tna->id_jabfung]);
    $dataRumah = $this->MasterDataModel->getOneRumah(['id_rumah' => $tna->id_rumah]);
    $dataSkala = $this->MasterDataModel->getOneSkala(['id_skala' => $tna->id_skala]);
    $dataInstrumen = json_decode($tna->id_instrumen, true);
?>
    <div class="collapse" id="editTNA<?= $tna->id_tna; ?>">
        <div class="box">
            <form action="<?= base_url('admin/tna/data-tna/edit-tna/' . $tna->id_tna); ?>" method="post">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h4><b>Edit <?= $tna->judul_tna; ?></b></h4>
                    <button type="submit" class="tbl-primer">Simpan Perubahan</button>
                </div>
                <hr>
                <input type="hidden" name="redir" id="redir" class="form-control" value="<?= $redirect_url; ?>">
                <div class="form-group mb-3">
                    <label for="judul_tna">Judul TNA</label>
                    <input type="text" name="judul_tna" id="judul_tna" class="form-control" value="<?= $tna->judul_tna; ?>" required>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="id_jabfung">Jabatan Fungsional</label>
                            <select name="id_jabfung" id="id_jabfung" class="form-control">
                                <option value="<?= $tna->id_jabfung; ?>">
                                    <?= $dataJabfung->nama_jabfung; ?>
                                </option>
                                <?php foreach ($getJabfung as $gj) { ?>
                                    <?php if ($gj->id_jabfung != $tna->id_jabfung) : ?>
                                        <option value="<?= $gj->id_jabfung; ?>"><?= $gj->nama_jabfung; ?></option>
                                    <?php endif; ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="id_jenjang">Jenjang Jabatan</label>
                            <select name="id_jenjang" id="id_jenjang" class="form-control">
                                <option value="<?= $tna->id_jenjang; ?>">
                                    <?= $dataJenjang->nama_jenjang; ?>
                                </option>
                                <?php foreach ($getsJenjang as $gjj) { ?>
                                    <?php if ($gjj->id_jenjang != $tna->id_jenjang) : ?>
                                        <option value="<?= $gjj->id_jenjang; ?>"><?= $gjj->nama_jenjang; ?></option>
                                    <?php endif; ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="id_rumah">Rumah Jabatan</label>
                            <select name="id_rumah" id="id_rumah" class="form-control">
                                <option value="<?= $tna->id_rumah; ?>">
                                    <?= $dataRumah->nama_rumah; ?>
                                </option>
                                <?php foreach ($getRumah as $gr) { ?>
                                    <?php if ($gr->id_rumah != $tna->id_rumah) : ?>
                                        <option value="<?= $gr->id_rumah; ?>"><?= $gr->nama_rumah; ?></option>
                                    <?php endif; ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="id_skala">Skala Likert</label>
                            <select name="id_skala" id="id_skala" class="form-control">
                                <option value="<?= $tna->id_skala; ?>">
                                    <?= $dataSkala->nama_skala; ?>
                                </option>
                                <?php foreach ($getSkala as $gs) { ?>
                                    <?php if ($gs->id_skala != $tna->id_skala) : ?>
                                        <option value="<?= $gs->id_skala; ?>"><?= $gs->nama_skala; ?></option>
                                    <?php endif; ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="tgl_mulai">Tanggal Mulai</label>
                            <input type="datetime-local" name="tgl_mulai" id="tgl_mulai" class="form-control" value="<?= $tna->tgl_mulai; ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="tgl_selesai">Tanggal Selesai</label>
                            <input type="datetime-local" name="tgl_selesai" id="tgl_selesai" class="form-control" value="<?= $tna->tgl_selesai; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="min_respon">Minimal Responden</label>
                            <input type="number" name="min_respon" id="min_respon" class="form-control" value="<?= $tna->min_respon; ?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <?php if ($tna->status == 'Aktif') : ?>
                                    <option value="<?= $tna->status; ?>"><?= $tna->status; ?></option>
                                    <option value="Belum Tervalidasi">Belum Tervalidasi</option>
                                    <option value="Valid">Valid</option>
                                    <option value="Tutup">Tutup</option>
                                <?php elseif ($tna->status == 'Tutup') : ?>
                                    <option value="<?= $tna->status; ?>"><?= $tna->status; ?></option>
                                    <option value="Belum Tervalidasi">Belum Tervalidasi</option>
                                    <option value="Valid">Valid</option>
                                    <option value="Aktif">Aktif</option>
                                <?php elseif ($tna->status == 'Valid') : ?>
                                    <option value="<?= $tna->status; ?>"><?= $tna->status; ?></option>
                                    <option value="Belum Tervalidasi">Belum Tervalidasi</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tutup">Tutup</option>
                                <?php else : ?>
                                    <option value="<?= $tna->status; ?>"><?= $tna->status; ?></option>
                                    <option value="Valid">Valid</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tutup">Tutup</option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <textarea name="keterangan" id="keterangan" cols="" rows="10" class="form-control"><?= $tna->keterangan; ?></textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php } ?>
<!-- <script src="https://cdn.tiny.cloud/1/xeknkmt7y7rwmr93g85hqf0tudif5yftvh9h0esxznsmojia/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script> -->
<script src="<?= base_url('assets/plugin/tiny/tinymce.min.js'); ?>"></script>
<script>
    tinymce.init({
        selector: "textarea",
        plugins: "anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount",
        toolbar: "undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat",
    });
</script>