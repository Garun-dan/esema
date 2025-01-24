<?php
date_default_timezone_set('Asia/Jakarta');
$segments_after_admin = $this->uri->segment_array(2);
array_shift($segments_after_admin);
$redirect_url = implode("/", $segments_after_admin);
$pelatihan = $this->TNAModel->getCountJenis($pengguna->nik, 'Peningkatan Kompetensi');
$seminar = $this->TNAModel->getCountJenis($pengguna->nik, 'Kompeten');

$itemPangkat = $this->MasterDataModel->getOnePangkat(['id_pangkat' => $pengguna->id_pangkat]);
$itemDataJabfung = $this->MasterDataModel->getOneJabfung(['id_jabfung' => $pengguna->id_jabfung]);
$itemDataJenjang = $this->MasterDataModel->getOneJenjang(['id_jenjang' => $pengguna->id_jenjang]);
$itemDataRumah = $this->MasterDataModel->getOneRumah(['id_rumah' => $pengguna->id_rumah]);
?>
<main style="margin-bottom: 100px">
    <div class="bio-profile">
        <div class="bio-avatar">
            <?php if (empty($pengguna->avatar)) : ?>
                <img src="<?= base_url('assets/'); ?>upload/profile/pria.png" alt="provile" class="img-fluid" />
            <?php else : ?>
                <img src="<?= base_url('assets/upload/profile/' . $pengguna->avatar); ?>" alt="provile" class="img-fluid" />
            <?php endif; ?>
        </div>

        <div class="data-profile">
            <div class="form-group mb-3 my-auto">
                <span class="text-center judul-item">Total TNA</span>
                <span class="text-center jumlah-item"><?= $countRekom; ?></span>
            </div>
            <div class="form-group mb-3 my-auto">
                <span class="text-center judul-item">Peningkatan Kompetensi</span>
                <span class="text-center jumlah-item"><?= $pelatihan; ?></span>
            </div>
            <div class="form-group mb-3 my-auto">
                <span class="text-center judul-item">Kompeten</span>
                <span class="text-center jumlah-item"><?= $seminar; ?></span>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-lg-5 col-sm-5 mb-3">
            <div class="box">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h4><b>Biodata</b></h4>
                    <button type="button" class="tbl-warning" data-bs-toggle="modal" data-bs-target="#editBiodataPengguna"><span class="bi bi-pencil-square"></span></button>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 col-sm-6 mb-3">
                        <div class="form-group mb-3">
                            <h6>Nama Lengkap</h6>
                            <h3><?= $pengguna->nama; ?></h3>
                        </div>
                        <div class="form-group mb-3">
                            <h6>NIP</h6>
                            <h3><?= $pengguna->nip; ?></h3>
                        </div>
                        <div class="form-group mb-3">
                            <h6>Jenis Kelamin</h6>
                            <h3><?= $pengguna->gender; ?></h3>
                        </div>
                        <?php if ($pengguna->id_role == 'role-4') : ?>
                            <div class="form-group mb-3">
                                <h6>Status Kepegawaian</h6>
                                <h3><?= $pengguna->status_asn; ?></h3>
                            </div>
                            <div class="form-group mb-3">
                                <h6>Jabatan Fungsional</h6>
                                <h3>
                                    <?php if (!empty($pengguna->id_jabfung)) : ?>
                                        <?= $itemDataJabfung->nama_jabfung; ?>
                                    <?php endif; ?>
                                </h3>
                            </div>
                            <div class="form-group mb-3">
                                <h6>Rumah Jabatan</h6>
                                <h3>
                                    <?php if (!empty($pengguna->id_jabfung)) : ?>
                                        <?= $itemDataRumah->nama_rumah; ?>
                                    <?php endif; ?>
                                </h3>
                            </div>
                            <div class="form-group mb-3">
                                <h6>Alamat Tempat Kerja</h6>
                                <h3><?= $pengguna->alamat_kerja; ?></h3>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-6 col-sm-6 mb-3">
                        <div class="form-group mb-3">
                            <h6>NIK</h6>
                            <h3><?= $pengguna->nik; ?></h3>
                        </div>
                        <div class="form-group mb-3">
                            <h6>Tempat/ Tanggal Lahir</h6>
                            <h3><?= $pengguna->tmpt_lahir; ?> / <?= $pengguna->tgl_lahir; ?></h3>
                        </div>
                        <?php if ($pengguna->id_role == 'role-4') : ?>
                            <div class="form-group mb-3">
                                <h6>Pendidikan</h6>
                                <h3><?= $pengguna->pdd_terakhir; ?></h3>
                            </div>
                            <div class="form-group mb-3">
                                <h6>Pangkat/ Golongan</h6>
                                <?php if (!empty($pengguna->id_pangkat)) : ?>
                                    <h3><?= $itemPangkat->pangkat; ?> - <?= $itemPangkat->golongan; ?></h3>
                                <?php endif; ?>
                            </div>
                            <div class="form-group mb-3">
                                <h6>Jenjang Jabatan</h6>
                                <h3>
                                    <?php if (!empty($pengguna->id_jabfung)) : ?>
                                        <?= $itemDataJenjang->nama_jenjang; ?>
                                    <?php endif; ?>
                                </h3>
                            </div>
                            <div class="form-group mb-3">
                                <h6>Tempat Kerja</h6>
                                <h3><?= $pengguna->tmpt_kerja; ?></h3>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-sm-7 mb-3">
            <div class="box">
                <h4 class="mb-3"><b>Riwayat</b></h4>
                <div class="table-responsive mt-3">
                    <table id="tabel" class="display table table-striped table-bordered table-hover">
                        <thead class="table-success">
                            <tr>
                                <th class="text-center" style="vertical-align: middle;">No</th>
                                <th class="text-center" style="vertical-align: middle;">Judul TNA</th>
                                <th class="text-center" style="vertical-align: middle;">Rekomendasi</th>
                                <th class="text-center" style="vertical-align: middle;">Tanggal Pelaksanaan</th>
                                <th class="text-center" style="vertical-align: middle;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            $itemDatRekom = $this->TNAModel->getAllRekom(['nik' => $pengguna->nik]);
                            foreach ($itemDatRekom as $rekom) { ?>
                                <?php if ($rekom) :
                                    $tna = $this->TNAModel->getOneTNA(['id_tna' => $rekom->id_tna]);
                                    if ($rekom->rekom == 'Kompeten') {
                                        $text = 'Tidak Butuh Peningkatan Kompetensi';
                                    } else {
                                        $text = 'Butuh Peningkatan Kompetensi';
                                    }
                                ?>
                                    <tr>
                                        <td class="text-center" style="vertical-align: middle;"><?= $i; ?></td>
                                        <td style="vertical-align: middle;"><?= $tna->judul_tna; ?></td>
                                        <td class="text-center" style="vertical-align: middle;"><b>
                                                <?= $text; ?>
                                            </b></td>
                                        <td class="text-center" style="vertical-align: middle;"><?= $rekom->tgl_validasi; ?></td>
                                        <td class="text-center" style="vertical-align: middle; flex-wrap: nowrap;">
                                            <button type="button" class="tbl-info mb-3" data-bs-toggle="modal" data-bs-target="#detailTNA<?= $rekom->id; ?>">Detail</button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
$itemRekom = $this->TNAModel->getOneRekom(['nik' => $pengguna->nik]);
if (!empty($itemRekom)) :
    $tna = $this->TNAModel->getOneTNA(['id_tna' => $itemRekom->id_tna]);
    $rekomendasi = strtoupper($itemRekom->rekom);
    $skala = $this->MasterDataModel->getOneSkala(['id_skala' => $tna->id_skala]);
    $skalaD = json_decode($skala->skala_d, true);
    $skalaI = json_decode($skala->skala_i, true);
    $skalaF = json_decode($skala->skala_f, true);

    if ($itemRekom->rekom == 'Kompeten') {
        $text = 'Tidak Butuh Peningkatan Kompetensi';
    } else {
        $text = 'Butuh Peningkatan Kompetensi';
    }

?>
    <div class="modal fade" id="detailTNA<?= $itemRekom->id; ?>" tabindex="-1" aria-labelledby="detailTNALabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="detailTNALabel">Detail Rekomendasi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-3" style="text-align: justify;">Terimakasih anda telah menyelesaikan <b><?= $tna->judul_tna; ?></b> dengan baik dan tanpa ada kendala. Dari kuesioner yang anda kerjakan berikut rekomendasi yang dapat kami berikan.</p>
                    <div class="d-flex align-items-center justify-content-around">
                        <div class="text-center">
                            <h1 class="mb-3">Rekomendasi</h1>
                            <span class="mb-3" style="font-size: 36px;"><b><?= $text; ?></b></span><br>
                        </div>
                    </div>
                    <p class="mb-3 mt-3" style="text-align: justify;">Namun, jika terdapat di salah satu butir kegiatan/instrumen yang belum kompeten, maka akan jadi pertimbangan bagi kami. Berikut preview jawaban yang anda berikan</p>
                    <div class="table-responsive mt-3">
                        <table id="tabels<?= $itemRekom->id; ?>" class="display table table-striped table-bordered table-hover" style="width:100%;">
                            <thead class="table-success">
                                <tr>
                                    <th class="text-center" style="vertical-align: middle;" rowspan="2">Instrumen</th>
                                    <th class="text-center" style="vertical-align: middle;" colspan="2">Tingkat Kesulitan</th>
                                    <th class="text-center" style="vertical-align: middle;" colspan="2">Tingkat Kepentingan</th>
                                    <th class="text-center" style="vertical-align: middle;" colspan="2">Tingkat Keseringan</th>
                                    <th class="text-center" style="vertical-align: middle;" rowspan="2">Rata-Rata</th>
                                    <th class="text-center" style="vertical-align: middle;" rowspan="2">Keterangan</th>
                                </tr>
                                <tr>
                                    <?php for ($i = 0; $i < 3; $i++) { ?>
                                        <th class="text-center" style="vertical-align: middle;">Angka</th>
                                        <th class="text-center" style="vertical-align: middle;">Keterangan</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $itemsKuesioner = $this->TNAModel->getAllKuesioner(['nik' => $pengguna->nik, 'id_tna' => $tna->id_tna]);
                                foreach ($itemsKuesioner as $ik) {
                                    $itemSoal = $this->TNAModel->getOneSoal(['id_soal' => $ik->id_soal]);
                                    $itemInstrumen = $this->MasterDataModel->getOneInstrumen(['id_instrumen' => $itemSoal->id_instrumen]);
                                    $total = number_format($ik->total, 2);

                                    if ($ik->rekom != 'Kompeten') {
                                        $color = "table-warning";
                                    } else {
                                        $color = "";
                                    }
                                ?>
                                    <tr class="<?= $color; ?>">
                                        <td style="vertical-align: middle;"><?= $itemInstrumen->instrumen; ?></td>
                                        <td class="text-center" style="vertical-align: middle;"><?= $ik->jwb_d; ?></td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <?php if (array_key_exists(($ik->jwb_d - 1), $skalaD)) : ?>
                                                <?= $skalaD[$ik->jwb_d - 1]; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center" style="vertical-align: middle;"><?= $ik->jwb_i; ?></td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <?php if (array_key_exists(($ik->jwb_i - 1), $skalaI)) : ?>
                                                <?= $skalaI[$ik->jwb_i - 1]; ?>
                                            <?php endif; ?></td>
                                        <td class="text-center" style="vertical-align: middle;"><?= $ik->jwb_f; ?></td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <?php if (array_key_exists(($ik->jwb_f - 1), $skalaF)) : ?>
                                                <?= $skalaF[$ik->jwb_f - 1]; ?>
                                            <?php endif; ?></td>
                                        </td>
                                        <td class="text-center" style="vertical-align: middle;"><?= $total; ?></td>
                                        <td class="text-center" style="vertical-align: middle;"><?= $ik->rekom; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <script>
                            $(document).ready(function() {
                                $("table[id^='tabels']").each(function() {
                                    $(this).DataTable({
                                        fixedHeader: true,
                                        paging: false,
                                        scrollY: 300,
                                        autoWidth: true
                                    });
                                });

                                $('.modal').on('shown.bs.modal', function() {
                                    $($.fn.dataTable.tables(true)).DataTable()
                                        .columns.adjust();
                                });
                            });
                        </script>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>