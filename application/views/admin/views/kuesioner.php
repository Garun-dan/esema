<?php
date_default_timezone_set('Asia/Jakarta');
$segments_after_admin = $this->uri->segment_array(2);
array_shift($segments_after_admin);
$redirect_url = implode("/", $segments_after_admin);
?>
<main style="margin-bottom: 100px">
    <div class="form-group row mb-3">
        <div class="col-lg-5 col-sm-5 mb-3">
            <div class="box">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h4><b>Daftar TNA</b></h4>
                </div>
                <div class="table-responsive mt-3">
                    <table id="tabel" class="display table table-striped table-bordered table-hover">
                        <thead class="table-success">
                            <tr>
                                <th class="text-center" style="vertical-align: middle;">No</th>
                                <th class="text-center" style="vertical-align: middle;">Judul TNA</th>
                                <th class="text-center" style="vertical-align: middle;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($getTNA as $tna) {
                                $today = date('Y-m-d H:i:s');
                                $getDataSoal = $this->TNAModel->getOneSoal(['id_tna' => $tna->id_tna]);
                                $getsRekom = $this->TNAModel->getOneRekom(['nik' => $pengguna->nik, 'id_tna' => $tna->id_tna]);
                                if (!$getsRekom) :
                            ?>
                                    <?php if ($pengguna->id_role == 'role-4' && $pengguna->id_jabfung == $tna->id_jabfung && $pengguna->id_jenjang == $tna->id_jenjang && $pengguna->id_rumah == $tna->id_rumah) : ?>
                                        <?php if ($today < $tna->tgl_mulai) : ?>
                                            <tr>
                                                <td class="text-center" style="vertical-align: middle;"><?= $i; ?></td>
                                                <td style="vertical-align: middle;"><?= $tna->judul_tna; ?></td>
                                                <td class="text-center" style="vertical-align: middle; white-space: nowrap;">
                                                    <button type="button" class="tbl-info">Belum Mulai</button>
                                                </td>
                                            <?php elseif ($today >= $tna->tgl_mulai && $today <= $tna->tgl_selesai) : ?>
                                            <tr class="table-success">
                                                <td class="text-center" style="vertical-align: middle;"><?= $i; ?></td>
                                                <td style="vertical-align: middle;"><?= $tna->judul_tna; ?></td>
                                                <td class="text-center" style="vertical-align: middle; white-space: nowrap;">
                                                    <?php if (!$getDataSoal) : ?>
                                                        <button type="button" class="tbl-info">Belum Mulai</button>
                                                    <?php else : ?>
                                                        <button type="button" class="tbl-primer" data-bs-toggle="collapse" data-bs-target="#kuesioner<?= $tna->id_tna; ?>" aria-expanded="false" aria-controls="kuesioner">Mulai</button>
                                                    <?php endif; ?>

                                                </td>
                                            <?php else : ?>
                                            <?php endif; ?>
                                            </tr>
                                        <?php endif; ?>
                                <?php
                                endif;
                                $i++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-sm-7 mb-3">
            <?php foreach ($getTNA as $tna) {
                preg_match('/\((.*?)\)/', $tna->judul_tna, $matches);
                $parenthesis_text = isset($matches[0]) ? $matches[0] : '';
                $first_line = substr($tna->judul_tna, 0, strpos($tna->judul_tna, $parenthesis_text));
                $second_line = $parenthesis_text;
                $third_line = substr($tna->judul_tna, strpos($tna->judul_tna, $parenthesis_text) + strlen($parenthesis_text));
            ?>
                <div class="collapse" id="kuesioner<?= $tna->id_tna; ?>">
                    <div class="box">
                        <h1 class="text-center mb-3"><?= $first_line; ?><br><?= $second_line; ?><br><?= $third_line; ?><br></h1>
                        <hr>
                        <h1 class="text-center mb-3">Petunjuk Pengisian</h1>
                        <p class="mb-3">Sebelum memulai pengisian <b><?= $tna->judul_tna; ?></b>, silahkan simak petunjuk pengisian dibawah ini!</p>
                        <p class="mb-3"><?= $tna->keterangan; ?></p>
                        <div class="text-center mb-3">
                            <a href="<?= base_url('admin/tna/kuesioner/' . $tna->slug); ?>" type="button" class="tbl-primer text-decoration-none">Mulai</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</main>