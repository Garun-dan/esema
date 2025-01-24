<?php
date_default_timezone_set('Asia/Jakarta');
$segments_after_admin = $this->uri->segment_array(2);
array_shift($segments_after_admin);
$redirect_url = implode("/", $segments_after_admin);
?>
<main style="margin-bottom: 100px">
    <div class="form-group mb-3 row">
        <div class="col-lg-4 col-sm-4 mb-3">
            <div class="box">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="mb-3"><b>Form Tambah TNA</b></h4>
                    <a href="<?= base_url('admin/tna/data-tna/form-tna'); ?>" class="tbl-primer text-decoration-none text-white mb-3">Tambah</a>
                </div>
                <div class="table-responsive mb-3">
                    <table id="tabel" class="display table table-striped table-bordere table-hover" style="width: 100%;">
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
                                $getDataSoal = $this->TNAModel->getOneSoal(['id_tna' => $tna->id_tna]);
                                $today = date('Y-m-d H:i:s');

                                if ($today < $tna->tgl_mulai) {
                                    $colour = '';
                                } elseif ($today >= $tna->tgl_mulai && $today <= $tna->tgl_selesai) {
                                    if ($tna->status !== 'Tutup') {
                                        $colour = 'table-success';
                                    } else {
                                        $colour = 'table-danger';
                                    }
                                } else {
                                    $colour = 'table-danger';
                                }
                            ?>
                                <tr class="<?= $colour; ?>">
                                    <td class="text-center" style="vertical-align: middle;"><?= $i; ?></td>
                                    <td style="vertical-align: middle;"><?= $tna->judul_tna; ?></td>
                                    <td class="text-center" style="vertical-align: middle; white-space: nowrap;">
                                        <?php if (!$getDataSoal) : ?>
                                            <button type="button" class="tbl-info prev_soal" data-bs-toggle="collapse" data-bs-target="#prev_soal<?= $tna->id_tna; ?>" aria-expanded="false" aria-controls="prev_soal"><span class="bi bi-receipt-cutoff"></span></button>
                                            <a href="<?= base_url('admin/tna/data-tna/hapus-data/' . $tna->id_tna); ?>" class="tbl-danger tbl-hapus"><span class="bi bi-trash-fill"></span></a>
                                        <?php else : ?>
                                            <?php if ($today <= $tna->tgl_selesai && $tna->status !== 'Tutup') : ?>
                                                <button type="button" class="tbl-warning" data-bs-toggle="collapse" data-bs-target="#editTNA<?= $tna->id_tna; ?>" aria-expanded=" false" aria-controls="editTNA"><span class="bi bi-pencil-square"></span></button>
                                            <?php endif; ?>
                                            <button type="button" class="tbl-info previewTNA" data-bs-toggle="collapse" data-bs-target="#previewTNA<?= $tna->id_tna; ?>" aria-expanded="false" aria-controls="previewTNA"><span class="bi bi-eye-fill"></span></button>
                                        <?php endif; ?>

                                    </td>
                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-sm-8 mb-3">
            <?php $this->load->view('admin/views/rekomendasi-soal'); ?>
            <?php $this->load->view('admin/views/editTNA'); ?>
            <?php $this->load->view('admin/views/previewTNA'); ?>
        </div>
    </div>
</main>
<script src="<?= base_url('assets/tema/admin/'); ?>off_collapse.js"></script>