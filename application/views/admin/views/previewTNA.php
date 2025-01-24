<?php foreach ($getTNA as $gt) {
    $posisi_kurung_buka = strpos($gt->judul_tna, '(');
    $atas = substr($gt->judul_tna, 0, $posisi_kurung_buka);
    $posisi_tahun = strpos($gt->judul_tna, "Tahun");
    $tengah = substr($gt->judul_tna, $posisi_kurung_buka, $posisi_tahun - $posisi_kurung_buka);
    $bawah = substr($gt->judul_tna, $posisi_tahun);
    $oneTNA = $this->TNAModel->getOneTNA(['id_tna' => $gt->id_tna]);
    $allInstrumen = json_decode($oneTNA->id_instrumen, true);
?>
    <div class="collapse" id="previewTNA<?= $gt->id_tna; ?>">
        <div class="box">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active text-dark" id="kuesioner-tab" data-bs-toggle="tab" data-bs-target="#kuesioner-tab-pane<?= $gt->id_tna; ?>" type="button" role="tab" aria-controls="kuesioner-tab-pane" aria-selected="true">Kuesioner</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-dark" id="daftarResponden-tab" data-bs-toggle="tab" data-bs-target="#daftarResponden-tab-pane<?= $gt->id_tna; ?>" type="button" role="tab" aria-controls="daftarResponden-tab-pane" aria-selected="false">Daftar Responden</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-dark" id="statistik-tab" data-bs-toggle="tab" data-bs-target="#statistik-tab-pane<?= $gt->id_tna; ?>" type="button" role="tab" aria-controls="statistik-tab-pane" aria-selected="false">Statistik</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="kuesioner-tab-pane<?= $gt->id_tna; ?>" role="tabpanel" aria-labelledby="kuesioner-tab" tabindex="0">
                    <div class="form-group text-center mt-2">
                        <h1>KUESIONER</h1>
                        <h4><?= $atas; ?><br><?= $tengah; ?><br><?= $bawah; ?></h4>

                        <div class="d-flex align-items-center justify-content-between">
                            <p>Mulai : <b><?= $gt->tgl_mulai; ?></b></p>
                            <p>Selesai : <b><?= $gt->tgl_selesai; ?></b></p>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group mb-3">
                        <?php $i = 1;
                        foreach ($allInstrumen as $item) {
                            $getDataInstrumen = $this->MasterDataModel->getOneInstrumen(['id_instrumen' => $item]);
                            if ($getDataInstrumen) {
                                $getDataSoal = $this->TNAModel->getAllSoal(['id_tna' => $gt->id_tna, 'id_instrumen' => $item]);
                                $skala = $this->MasterDataModel->getOneSkala(['id_skala' => $gt->id_skala]);
                                if ($skala) {
                                    $skala_d = json_decode($skala->skala_d);
                                    $skala_i = json_decode($skala->skala_i);
                                    $skala_f = json_decode($skala->skala_f); ?>

                                    <p><?= $i; ?>. <?= $getDataInstrumen->instrumen; ?></p>
                                    <?php foreach ($getDataSoal as $soal) { ?>
                                        <div class="form-group mb-3">
                                            <label>a. <?= $soal->soal_d; ?></label><br>
                                            <?php
                                            $a = 1;
                                            foreach ($skala_d as $index => $d) { ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="skala_d_<?= $i . '_' . $index; ?>" id="skala_d_<?= $i . '_' . $index . '_' . $a; ?>" value="<?= $a; ?>">
                                                    <label class="form-check-label" for="skala_d_<?= $i . '_' . $index . '_' . $a; ?>">
                                                        <?= $d; ?>
                                                    </label>
                                                </div>
                                            <?php $a++;
                                            } ?>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>b. <?= $soal->soal_i; ?></label><br>
                                            <?php
                                            $a = 1;
                                            foreach ($skala_i as $index => $si) { ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="skala_i_<?= $i . '_' . $index; ?>" id="skala_i_<?= $i . '_' . $index . '_' . $a; ?>" value="<?= $a; ?>">
                                                    <label class="form-check-label" for="skala_i_<?= $i . '_' . $index . '_' . $a; ?>">
                                                        <?= $si; ?>
                                                    </label>
                                                </div>
                                            <?php $a++;
                                            } ?>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>c. <?= $soal->soal_f; ?></label><br>
                                            <?php
                                            $a = 1;
                                            foreach ($skala_f as $index => $f) { ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="skala_f_<?= $i . '_' . $index; ?>" id="skala_f_<?= $i . '_' . $index . '_' . $a; ?>" value="<?= $a; ?>">
                                                    <label class="form-check-label" for="skala_f_<?= $i . '_' . $index . '_' . $a; ?>">
                                                        <?= $f; ?>
                                                    </label>
                                                </div>
                                            <?php $a++;
                                            } ?>
                                        </div>
                        <?php }
                                }
                            }
                            $i++;
                        } ?>
                    </div>

                </div>
                <div class="tab-pane fade" id="daftarResponden-tab-pane<?= $gt->id_tna; ?>" role="tabpanel" aria-labelledby="daftarResponden-tab" tabindex="0">
                    <div class="form-group mt-3">
                        <a href="<?= base_url('admin/tna/data-tna/view/item/' . $gt->slug); ?>" class="tbl-info text-decoration-none"><span class="bi bi-folder-fill"></span> Detail Data</a>
                    </div>
                    <div class="table-responsive mt-3">
                        <table id="tabels" class="display table table-striped table-bordered table-hover">
                            <thead class="table-success">
                                <tr>
                                    <th class="text-center" style="vertical-align: middle;">No</th>
                                    <th class="text-center" style="vertical-align: middle;">Responden</th>
                                    <th class="text-center" style="vertical-align: middle;">Rekomendasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                $allRespon = $this->TNAModel->getAllRekom(['id_tna' => $gt->id_tna]);
                                foreach ($allRespon as $respon) {
                                    $dataResponden = $this->MasterDataModel->getOneUser(['nik' => $respon->nik]);
                                    $slug_nama = strtolower(url_title($dataResponden->nama));
                                ?>
                                    <tr>
                                        <td class="text-center" style="vertical-align: middle;"><?= $i; ?></td>
                                        <td style="vertical-align: middle;"><?php echo base64_encode($dataResponden->nama); ?></td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <?php if ($respon->rekom != 'Kompeten') : ?>
                                                Butuh <?= $respon->rekom; ?>
                                            <?php else : ?>
                                                <?= $respon->rekom; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php $i++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="statistik-tab-pane<?= $gt->id_tna; ?>" role="tabpanel" aria-labelledby="statistik-tab" tabindex="0">
                    <canvas id="statistikItemTNA<?= $gt->id_tna; ?>"></canvas>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<script src="<?= base_url('assets/'); ?>plugin/chart/chart.js"></script>
<script>
    var dataItemTNA = <?= json_encode($getTNA); ?>;
    var dataRekomTNA = <?= json_encode($getRekom); ?>;
    document.addEventListener("DOMContentLoaded", function() {
        dataItemTNA.forEach(function(item) {
            var idTNA = item.id_tna;
            var statistikCanvas = document
                .getElementById("statistikItemTNA" + idTNA)
                .getContext("2d");
            var statistikItemTNA;

            function setCanvasSize() {
                var screensize = window.innerWidth;
                if (screensize <= 540) {
                    statistikCanvas.canvas.width = screensize;
                    statistikCanvas.canvas.height = 300 * (screensize / 540);
                } else {
                    statistikCanvas.canvas.width = 100;
                    statistikCanvas.canvas.height = 100;
                }

                if (statistikItemTNA) statistikItemTNA.destroy();

                var jumlahPelatihan = 0;
                var jumlahSeminar = 0;

                dataRekomTNA.forEach(function(rekomendasi) {
                    if (rekomendasi.id_tna === idTNA) {
                        if (rekomendasi.rekom === "Peningkatan Kompetensi") {
                            jumlahPelatihan++;
                        } else if (rekomendasi.rekom === "Kompeten") {
                            jumlahSeminar++;
                        }
                    }
                });

                statistikItemTNA = new Chart(statistikCanvas, {
                    type: "bar",
                    data: {
                        labels: ["Peningkatan Kompetensi", "Kompeten"],
                        datasets: [{
                            label: "Rekomendasi",
                            data: [jumlahPelatihan, jumlahSeminar],
                            borderWidth: 1,
                            backgroundColor: ["#b330c0", "#3e4c7a"],
                        }, ],
                    },
                    options: {
                        scales: {
                            x: {
                                align: "center",
                            },
                            y: {
                                beginAtZero: true,
                            },
                        },
                    },
                });
            }
            setCanvasSize();

            window.addEventListener("resize", setCanvasSize);
        });
    });
</script>
<script>
    $(document).ready(function() {
        var table = $("#tabels").DataTable({
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            fixedHeader: true,
            paging: false,
            scrollY: 300,
            scrollX: true,
            autoWidth: false,
            columnDefs: [{
                    width: '20%',
                    targets: 0
                },
                {
                    width: '40%',
                    targets: 1
                },
                {
                    width: '40%',
                    targets: 2
                }
            ],
            fixedColumns: true
        });

        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            table.columns.adjust().draw();
        });
    });
</script>
<style>
    .dataTables_scrollHeadInner {
        width: 100% !important;
    }

    .dataTables_scrollBody table {
        width: 100% !important;
    }
</style>
<!-- <script>
    $(document).ready(function() {
        $("#tabels.display").DataTable({
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            fixedHeader: true,
            paging: false,
            scrollY: 300,
        });

        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    });
</script> -->