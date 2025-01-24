<?php
$segments_after_admin = $this->uri->segment_array(2);
array_shift($segments_after_admin);
$redirect_url = implode("/", $segments_after_admin);

$uri = $this->uri->segment(4);
$oneTNA = $this->TNAModel->getOneTNA(['slug' => $uri]);
$listSoal = $this->TNAModel->getAllSoal(['id_tna' => $oneTNA->id_tna]);
$listSkala = $this->MasterDataModel->getOneSkala(['id_skala' => $oneTNA->id_skala]);

preg_match('/\((.*?)\)/', $oneTNA->judul_tna, $matches);
$parenthesis_text = isset($matches[0]) ? $matches[0] : '';
$first_line = substr($oneTNA->judul_tna, 0, strpos($oneTNA->judul_tna, $parenthesis_text));
$second_line = $parenthesis_text;
$third_line = substr($oneTNA->judul_tna, strpos($oneTNA->judul_tna, $parenthesis_text) + strlen($parenthesis_text));
?>
<main style="margin-bottom: 100px">
    <div style="display: flex; justify-content:center; margin-bottom:20px;">
        <div class="box" style="width: 70vw; max-width:80%;">
            <div class="text-center mb-3">
                <h1><?= $first_line; ?><br><?= $second_line; ?><br><?= $third_line; ?></h1>
            </div>
            <hr>
            <div class="mb-3" id="formSoal">
                <?php
                foreach ($listSoal as $soal) {
                    $dataInstrumen = $this->MasterDataModel->getOneInstrumen(['id_instrumen' => $soal->id_instrumen]);
                    $skala_d = json_decode($listSkala->skala_d);
                    $skala_i = json_decode($listSkala->skala_i);
                    $skala_f = json_decode($listSkala->skala_f);
                ?>
                    <form id="form_soal_<?= $soal->id_soal; ?>" class="form_soal">
                        <input type="hidden" name="itemIdTNA" id="itemIdTNA" value="<?= $oneTNA->id_tna; ?>">
                        <input type="hidden" name="itemIdSoal" id="itemIdSoal" value="<?= $soal->id_soal; ?>">
                        <p id="instrumen_text" style="text-align: justify;"><b><?= $dataInstrumen->instrumen; ?></b></p>
                        <div class="form-group mb-3">
                            <label id="soal_container_d">a. <?= $soal->soal_d; ?></label>
                            <?php
                            $a = 1;
                            $group_name = "skala_d_" . $soal->id_soal;
                            foreach ($skala_d as $index => $d) { ?>
                                <div class="form-check" style="margin-left: 20px;">
                                    <input class="form-check-input" type="radio" name="<?= $group_name; ?>" id="<?= $group_name . '_' . $a; ?>" value="<?= $a; ?>">
                                    <label class="form-check-label" for="<?= $group_name . '_' . $a; ?>">
                                        <?= $d; ?>
                                    </label>
                                </div>
                            <?php $a++;
                            } ?>
                        </div>
                        <div class="form-group mb-3">
                            <label id="soal_container_i">b. <?= $soal->soal_i; ?></label>
                            <?php
                            $a = 1;
                            $group_name = "skala_i_" . $soal->id_soal;
                            foreach ($skala_i as $index => $im) { ?>
                                <div class="form-check" style="margin-left: 20px;">
                                    <input class="form-check-input" type="radio" name="<?= $group_name; ?>" id="<?= $group_name . '_' . $a; ?>" value="<?= $a; ?>">
                                    <label class="form-check-label" for="<?= $group_name . '_' . $a; ?>">
                                        <?= $im; ?>
                                    </label>
                                </div>
                            <?php $a++;
                            } ?>
                        </div>
                        <div class="form-group mb-3">
                            <label id="soal_container_f">c. <?= $soal->soal_f; ?></label>
                            <?php
                            $a = 1;
                            $group_name = "skala_f_" . $soal->id_soal;
                            foreach ($skala_f as $index => $f) { ?>
                                <div class="form-check" style="margin-left: 20px;">
                                    <input class="form-check-input" type="radio" name="<?= $group_name; ?>" id="<?= $group_name . '_' . $a; ?>" value="<?= $a; ?>">
                                    <label class="form-check-label" for="<?= $group_name . '_' . $a; ?>">
                                        <?= $f; ?>
                                    </label>
                                </div>
                            <?php $a++;
                            } ?>
                        </div>

                        <div class="mb-3 text-right" style="display: flex;justify-content: flex-end;">
                            <button type="button" class="btnLanjutkan btn btn-success" data-form="form_soal_<?= $soal->id_soal; ?>">Lanjutkan</button>
                        </div>
                    </form>
                <?php
                } ?>
            </div>
            <div id="evaluasi_form" style="display: none;">
                <h3 class="mb-3">Form Evaluasi</h3>
                <form action="<?= base_url('admin/tna/kuesioner/evaluasi/responden'); ?>" method="post">
                    <input type="hidden" name="id_tna" id="id_tna" value="<?= $oneTNA->id_tna; ?>">
                    <div class="form-group mb-3">
                        <div class="emoji-container">
                            <label>
                                <input type="radio" name="satisfaction" value="1">
                                <span class="emoji">😡</span>
                            </label>
                            <label>
                                <input type="radio" name="satisfaction" value="2">
                                <span class="emoji">😐</span>
                            </label>
                            <label>
                                <input type="radio" name="satisfaction" value="3">
                                <span class="emoji">😊</span>
                            </label>
                            <label>
                                <input type="radio" name="satisfaction" value="4">
                                <span class="emoji">😃</span>
                            </label>
                            <label>
                                <input type="radio" name="satisfaction" value="5">
                                <span class="emoji">🤩</span>
                            </label>
                        </div>
                        <div class="form-group mb-3">
                            <label for="saran">Saran</label>
                            <textarea name="saran" rows="4" cols="50" class="form-control mb-3" required></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="kritik">Kritik</label>
                            <textarea name="kritik" rows="4" cols="50" class="form-control mb-3" required></textarea>
                        </div>
                        <button id="selesai_button" type="submit" class="btn btn-success">Selesai</button>
                </form>
            </div>

        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var currentSoal = 0;
        var totalSoal = <?= count($listSoal); ?>;

        function displaySoal(soalIndex) {
            var allForms = document.querySelectorAll('.form_soal');
            allForms.forEach(function(form, index) {
                form.style.display = index === soalIndex ? 'block' : 'none';
            });

            if (soalIndex === totalSoal) {
                document.getElementById('evaluasi_form').style.display = 'block';
                document.getElementById('formSoal').style.display = 'none';
            } else {
                document.getElementById('evaluasi_form').style.display = 'none';
                document.getElementById('formSoal').style.display = 'block';
            }
        }

        displaySoal(currentSoal);

        document.querySelectorAll('.btnLanjutkan').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var formId = this.getAttribute('data-form');
                var form = document.getElementById(formId);
                var selectedD = $("#" + formId).find('input[name^="skala_d"]:checked').val();
                var selectedI = $("#" + formId).find('input[name^="skala_i"]:checked').val();
                var selectedF = $("#" + formId).find('input[name^="skala_f"]:checked').val();

                if (!selectedD || !selectedI || !selectedF) {
                    alert('Mohon pilih semua skala sebelum melanjutkan.');
                    return;
                }

                var id_tna = $("#" + formId).find('input[name="itemIdTNA"]').val();
                var id_soal = $("#" + formId).find('input[name="itemIdSoal"]').val();
                var jwb_d = selectedD;
                var jwb_i = selectedI;
                var jwb_f = selectedF;

                var formData = {
                    id_tna: id_tna,
                    id_soal: id_soal,
                    jwb_d: jwb_d,
                    jwb_i: jwb_i,
                    jwb_f: jwb_f
                };

                console.log(formData);

                $.ajax({
                    url: "<?= base_url('admin/tna/kuesioner/simpan/data-soal'); ?>",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        console.log('Data soal tersimpan.');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });

                currentSoal++;
                displaySoal(currentSoal);
            });
        });

        const emojis = document.querySelectorAll('.emoji');
        emojis.forEach(emoji => {
            emoji.addEventListener('click', function() {
                emojis.forEach(e => e.classList.remove('selected'));
                emoji.classList.add('selected');
            });
        });
    });
</script>