<?php
$pria = $this->MasterDataModel->getCountPria();
$wanita = $this->MasterDataModel->getCountWanita();
$priaRekom = $this->TNAModel->countPriaRekom();
$priaRekomPelatihan = $this->TNAModel->countPriaRekomPelatihan();
$priaRekomSeminar = $this->TNAModel->countPriaRekomSeminar();
$priaRekomWorkshop = $this->TNAModel->countPriaRekomWorkshop();
$wanitaRekom = $this->TNAModel->countWanitaRekom();
$wanitaRekomPelatihan = $this->TNAModel->countWanitaRekomPelatihan();
$wanitaRekomSeminar = $this->TNAModel->countWanitaRekomSeminar();
$wanitaRekomWorkshop = $this->TNAModel->countWanitaRekomWorkshop();
$allEvaluasi = $this->TNAModel->getAllEvaluasi();
?>
<!-- Main -->
<main style="margin-bottom: 100px">
    <!-- Bio Statistik -->
    <div class="bio-statistik">
        <!-- Biodata -->
        <div class="bio-data">
            <img src="<?= base_url('assets/upload/profile/' . $pengguna->avatar); ?>" alt="provile" class="img-fluid" />
            <div class="form-group">
                <span class="bio-nama"><?= $pengguna->nama; ?></span>
                <span class="bio-nik"><?= $pengguna->nik; ?></span>
            </div>
        </div>

        <!-- Statistik -->
        <div class="data-statistik">
            <!-- Total Nakes -->
            <div class="box-statistik" style="background: var(--danger-color)">
                <a class="judul-statistik">Total Nakes</a>
                <div class="item-statistik">
                    <div class="form-group">
                        <canvas id="totalNakes" width="100" height="100"></canvas>
                    </div>
                    <div class="form-group">
                        <span class="report">Report</span>
                        <span class="pria">Pria : <b><?= $pria; ?></b></span>
                        <span class="wanita">Wanita : <b><?= $wanita; ?></b></span>
                    </div>
                </div>
            </div>

            <!-- Total Responden -->
            <div class="box-statistik" style="background: var(--hover-menu-color)">
                <a class="judul-statistik">Total Responden</a>
                <div class="item-statistik">
                    <div class="form-group">
                        <canvas id="totalResponden" width="100" height="100"></canvas>
                    </div>
                    <div class="form-group">
                        <span class="report">Report</span>
                        <span class="pria">Pria : <b><?= $priaRekom; ?></b></span>
                        <span class="wanita">Wanita : <b><?= $wanitaRekom; ?></b></span>
                    </div>
                </div>
            </div>

            <!-- Total Pelatihan -->
            <div class="box-statistik" style="background: var(--success-color)">
                <a class="judul-statistik">Peningkatan Kompetensi</a>
                <div class="item-statistik">
                    <div class="form-group">
                        <canvas id="totalPelatihan" width="100" height="100"></canvas>
                    </div>
                    <div class="form-group">
                        <span class="report">Report</span>
                        <span class="pria">Pria : <b><?= $priaRekomPelatihan; ?></b></span>
                        <span class="wanita">Wanita : <b><?= $wanitaRekomPelatihan; ?></b></span>
                    </div>
                </div>
            </div>

            <!-- Total Seminar -->
            <div class="box-statistik" style="background: var(--warning-color)">
                <a class="judul-statistik">Kompeten</a>
                <div class="item-statistik">
                    <div class="form-group">
                        <canvas id="totalSeminar" width="100" height="100"></canvas>
                    </div>
                    <div class="form-group">
                        <span class="report">Report</span>
                        <span class="pria">Pria : <b><?= $priaRekomSeminar; ?></b></span>
                        <span class="wanita">Wanita : <b><?= $wanitaRekomSeminar; ?></b></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Statistik -->
    <div class="row mb-lg-3">
        <div class="col-lg-7 col-sm-7 mb-3">
            <div class="chart-statistik">
                <div class="chart-sidebar">
                    <li>
                        <a class="chart-aktif" data-bs-toggle="collapse" href="#jabfungDiagram" role="button" aria-expanded="true" aria-controls="jabfungDiagram">
                            <span class="bi bi-bar-chart-steps"></span>
                        </a>
                    </li>
                    <li>
                        <a data-bs-toggle="collapse" href="#jenjangDiagram" role="button" aria-expanded="false" aria-controls="jenjangDiagram"><span class="bi bi-diagram-3-fill"></span></a>
                    </li>
                    <li>
                        <a data-bs-toggle="collapse" href="#rumahDiagram" role="button" aria-expanded="false" aria-controls="rumahDiagram"><span class="bi bi-file-earmark-bar-graph-fill"></span></a>
                    </li>
                    <li>
                        <a data-bs-toggle="collapse" href="#instrumenDiagram" role="button" aria-expanded="false" aria-controls="instrumenDiagram"><span class="bi bi-file-earmark-spreadsheet-fill"></span></a>
                    </li>
                </div>
                <div class="chart-view">
                    <div class="collapse show" id="jabfungDiagram">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h4>Statistik Rekomendasi Jabatan Fungsional</h4>
                            <select name="tahun" id="tahun" class="border-0" style="background: var(--light-color)"></select>
                        </div>
                        <canvas id="barJabfung"></canvas>
                    </div>
                    <div class="collapse" id="jenjangDiagram">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h4>Statistik Rekomendasi Jenjang Jabatan</h4>
                            <select name="tahunJenjang" id="tahunJenjang" class="border-0" style="background: var(--light-color)">
                            </select>
                        </div>
                        <select name="listJabfung" id="listJabfung" class="border-0 form-control" style="background: var(--light-color); width:50%;">
                            <?php foreach ($getJabfung as $gj) { ?>
                                <option value="<?= $gj->id_jabfung; ?>"><?= $gj->nama_jabfung; ?></option>
                            <?php } ?>
                        </select>
                        <canvas id="barJenjang"></canvas>
                    </div>
                    <div class="collapse" id="rumahDiagram">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h4>Statistik Rekomendasi Rumah Jabatan</h4>
                            <select name="tahunRumah" id="tahunRumah" class="border-0" style="background: var(--light-color)">
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 mb-3">
                                <select name="listDataJabfung" id="listDataJabfung" class="border-0 form-control" style="background: var(--light-color);">
                                    <?php foreach ($getJabfung as $gj) { ?>
                                        <option value="<?= $gj->id_jabfung; ?>"><?= $gj->nama_jabfung; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-6 col-sm-6 mb-3">
                                <select name="listJenjang" id="listJenjang" class="border-0 form-control" style="background: var(--light-color);">
                                </select>
                            </div>
                        </div>
                        <canvas id="barRumah"></canvas>
                    </div>
                    <div class="collapse" id="instrumenDiagram">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h4>Statistik Instrumen</h4>
                            <select name="tahunInstrumen" id="tahunInstrumen" class="border-0" style="background: var(--light-color)">
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 mb-3">
                                <select name="listItemsJabfung" id="listItemsJabfung" class="border-0 form-control" style="background: var(--light-color);">
                                    <?php foreach ($getJabfung as $gj) { ?>
                                        <option value="<?= $gj->id_jabfung; ?>"><?= $gj->nama_jabfung; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-6 col-sm-6 mb-3">
                                <select name="listItemsJenjang" id="listItemsJenjang" class="border-0 form-control" style="background: var(--light-color);">
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <select name="listItemsInstrumen" id="listItemsInstrumen" class="border-0 form-control" style="background: var(--light-color);">
                            </select>
                        </div>
                        <?php foreach ($getRumah as $grj) { ?>
                            <div class="mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="mb-3"><?= $grj->nama_rumah; ?></h4>
                                </div>
                                <canvas id="barDIF<?= $grj->id_rumah; ?>"></canvas>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-sm-5 mb-3 mt-3">
            <div class="daftar-saran">
                <div class="form-group" style="background: var(--light-color)">
                    <a>Saran dan komentar</a>
                </div>
                <div class="form-group" style="overflow-y: auto;overflow-x: hidden;height: calc(450px - 60px);">
                    <?php foreach ($allEvaluasi as $evaluasi) {
                        $userData = $this->MasterDataModel->getOneUser(['nik' => $evaluasi->nik]);
                        if ($userData) {
                    ?>
                            <div class="saran">
                                <img src="<?= base_url('assets/upload/profile/' . $userData->avatar); ?>" alt="profile" class="img-fluid" />
                                <div class="form-group">
                                    <span class="nama-saran"><?= $userData->nama; ?></span>
                                    <span class="instansi-saran"><?= $userData->tmpt_kerja; ?></span>
                                    <span class="info-saran">Saran: <?= $evaluasi->saran; ?> <br> Kritik: <?= $evaluasi->kritik; ?>
                                        <a href="#" class="text-decoration-none" style="color: var(--link-color)">Readmore</a>
                                    </span>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="<?= base_url('assets/'); ?>plugin/chart/chart.js"></script>
<script>
    var pria = <?= $pria; ?>;
    var priaRekom = <?= $priaRekom; ?>;
    var priaRekomPelatihan = <?= $priaRekomPelatihan; ?>;
    var priaRekomSeminar = <?= $priaRekomSeminar; ?>;
    // var priaRekomWorkshop = <?= $priaRekomWorkshop; ?>;
    var wanita = <?= $wanita; ?>;
    var wanitaRekom = <?= $wanitaRekom; ?>;
    var wanitaRekomPelatihan = <?= $wanitaRekomPelatihan; ?>;
    var wanitaRekomSeminar = <?= $wanitaRekomSeminar; ?>;
    // var wanitaRekomWorkshop = <?= $wanitaRekomWorkshop; ?>;
    var getJabfung = <?= json_encode($getJabfung); ?>;
    var getJenjang = <?= json_encode($getJenjang); ?>;
    var getRekom = <?= json_encode($getRekom); ?>;
    var getRumah = <?= json_encode($getRumah); ?>;
    var getTNA = <?= json_encode($getTNA); ?>;
    var getInstrumen = <?= json_encode($getInstrumen); ?>;
    var url = "<?= base_url('admin/tna/data-tna/get-jenjang/'); ?>";
    var urlInstrumen = "<?= base_url('admin/tna/data-tna/get-instrumen/'); ?>";
</script>
<script src="<?= base_url('assets/'); ?>tema/admin/dashboard.js"></script>
<script>
    document.querySelectorAll('.chart-sidebar a').forEach(link => {
        link.addEventListener('click', function() {
            document.querySelectorAll('.chart-sidebar a').forEach(link => {
                link.classList.remove('chart-aktif');
            });
            this.classList.add('chart-aktif');

            document.querySelectorAll('.chart-view .collapse.show').forEach(collapse => {
                collapse.classList.remove('show');
            });

            const targetId = this.getAttribute('href');

            document.querySelector(targetId).classList.add('show');
        });
    });
</script>