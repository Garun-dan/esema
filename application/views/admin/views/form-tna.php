<?php
date_default_timezone_set('Asia/Jakarta');
$segments_after_admin = $this->uri->segment_array(2);
array_shift($segments_after_admin);
$redirect_url = implode("/", $segments_after_admin);
$v1 = $this->uri->segment(2);
$v2 = $this->uri->segment(3);
$redir = $v1 . '/' . $v2;
?>

<main style="margin-bottom: 100px">
  <div class="form-group row">
    <div class="col-lg-4 col-sm-4 mb-3">
      <div class="box">
        <div class="d-flex align-items-center justify-content-between">
          <h4 class="mb-3"><b>Form Tambah TNA</b></h4>
          <a href="<?= base_url('admin/' . $redir); ?>" class="tbl-info text-decoration-none text-white mb-3">Kembali</a>
        </div>
        <div class="form-group mb-3">
          <label for="jabfung">Jabatan Fungsional</label>
          <select name="jabfung" id="jabfung" class="form-control" onchange="getJenjang()">
            <option selected disabled>Pilih Jabatan Fungsional</option>
            <?php foreach ($getJabfung as $gj) { ?>
              <option value="<?= $gj->id_jabfung; ?>"><?= $gj->nama_jabfung; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group mb-3">
          <label for="jenjang">Jenjang Jabatan</label>
          <select name="jenjang" id="jenjang" class="form-control">
          </select>
        </div>
        <div class="form-group d-none" id="viewdataAllJenjang">
          <div class="form-group mb-3">
            <div id="allJenjang"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-8 col-sm-8 mb-3">
      <?php foreach ($getJenjang as $jenjang) {
        $jf = $this->MasterDataModel->getOneJabfung(['id_jabfung' => $jenjang->id_jabfung]);
        $dataInstrumen = $this->MasterDataModel->getAllInstrumen(['id_jenjang' => $jenjang->id_jenjang]);
      ?>
        <div class="collapse" id="<?= $jenjang->id_jenjang; ?>">
          <div class="box">
            <h4 class="mb-3"><b>Pengaturan Data TNA JF <?= $jf->nama_jabfung; ?> <?= $jenjang->nama_jenjang; ?></b></h4>
            <p>Pilih Rumah Jabatan</p>
            <div class="accordion" id="rumahJabatan">
              <?php foreach ($getRumah as $rumah) {
              ?>
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#dataIns<?= $rumah->id_rumah; ?>" aria-expanded="true" aria-controls="<?= $rumah->id_rumah; ?>">
                      <?= $rumah->nama_rumah; ?>
                    </button>
                  </h2>
                  <div id="dataIns<?= $rumah->id_rumah; ?>" class="accordion-collapse collapse" data-bs-parent="#rumahJabatan">
                    <div class="accordion-body">
                      <div id="itemData" class="form-group">
                        <form action="<?= base_url('admin/tna/data-tna/tambah-tna/' . $rumah->id_rumah); ?>" method="post" class="tambahdataTNA">
                          <input type="hidden" name="id_jabfung" id="id_jabfung" value="<?= $jenjang->id_jabfung; ?>">
                          <input type="hidden" name="id_jenjang" id="id_jenjang" value="<?= $jenjang->id_jenjang; ?>">
                          <h4 class="mb-3" id="rumahLabel"><b>Pilih Instrumen <?= $jenjang->nama_jenjang; ?> Untuk Rumah Jabatan <?= $rumah->nama_rumah; ?></b></h4>
                          <div class="table-responsive mt-3">
                            <table id="tabelInstrumen<?= $rumah->id_rumah; ?>" class="display table table-striped table-bordered table-hover" style="width: 100%;">
                              <thead class="table-success">
                                <tr>
                                  <th class="text-center" style="vertical-align: middle;">No</th>
                                  <th class="text-center" style="vertical-align: middle;">Instrumen</th>
                                  <th class="text-center" style="vertical-align: middle;">
                                    <input type="checkbox" id="checkAll"> Aksi
                                  </th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $i = 1;
                                foreach ($dataInstrumen as $di) { ?>
                                  <tr>
                                    <td class="text-center"><?= $i; ?></td>
                                    <td style="text-align: justify;"><?= $di->instrumen; ?></td>
                                    <td class="text-center">
                                      <input class="form-check-input checkbox-item" type="checkbox" value="<?= $di->id_instrumen; ?>" id="pil_instrumen" name="pil_instrumen[]">
                                    </td>
                                  </tr>
                                <?php $i++;
                                } ?>
                              </tbody>
                            </table>
                          </div>
                          <div class="form-group mb-3">
                            <label for="keterangan">Petunjuk Pengisian</label>
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
                          <div class="form-group text-center mb-3">
                            <button type="submit" class="tbl-primer">Simpan Data</button>
                          </div>
                        </form>
                        <h4 class="d-none" id="itemKet"><strong>Data Sudah Tersimpan</strong></h4>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</main>
<!-- <script src="https://cdn.tiny.cloud/1/xeknkmt7y7rwmr93g85hqf0tudif5yftvh9h0esxznsmojia/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script> -->
<script src="<?= base_url('assets/plugin/tiny/tinymce.min.js'); ?>"></script>
<script>
  const urlGetJenjang = "<?= base_url('admin/tna/data-tna/get-jenjang/'); ?>";
  const cekJenjang = <?= json_encode($getJenjang); ?>;
  const dataRumah = <?= json_encode($getRumah); ?>;
</script>
<script src="<?= base_url('assets/tema/admin/form_tna.js'); ?>"></script>