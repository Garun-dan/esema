<?php
$segments_after_admin = $this->uri->segment_array(2);
array_shift($segments_after_admin);
$redirect_url = implode("/", $segments_after_admin);

$uri = $this->uri->segment(6);

$uri1 = $this->uri->segment(1);
$uri2 = $this->uri->segment(2);
$uri3 = $this->uri->segment(3);
$back = $uri1 . '/' . $uri2 . '/' . $uri3;

$dataTNA = $this->TNAModel->getOneTNA(['slug' => $uri]);
$listKuesioner = $this->TNAModel->getAllKuesioner(['id_tna' => $dataTNA->id_tna]);
?>
<main style="margin-bottom: 100px">
    <div class="box mb-3">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h4 class="mb-3"><b>Data <?= $dataTNA->judul_tna; ?></b></h4>
            <a href="<?= base_url($back); ?>" class="tbl-info text-decoration-none">Kembali</a>
        </div>

        <div class="table-responsive mt-3">
            <table id="exportTable" class="displayExport table table-striped table-bordered table-hover">
                <thead class="table-success">
                    <tr>
                        <th class="text-center" style="vertical-align: middle;">Responden</th>
                        <th class="text-center" style="vertical-align: middle;">Instrumen</th>
                        <th class="text-center" style="vertical-align: middle;">Nilai D</th>
                        <th class="text-center" style="vertical-align: middle;">Nilai I</th>
                        <th class="text-center" style="vertical-align: middle;">Nilai F</th>
                        <th class="text-center" style="vertical-align: middle;">Rata-rata</th>
                        <th class="text-center" style="vertical-align: middle;">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($listKuesioner as $item) {
                        $itemUser = $this->MasterDataModel->getOneUser(['nik' => $item->nik]);
                        $itemSoal = $this->TNAModel->getOneSoal(['id_soal' => $item->id_soal]);
                        $itemInstrumen = $this->MasterDataModel->getOneInstrumen(['id_instrumen' => $itemSoal->id_instrumen]);
                        $nilai = number_format($item->total, 2);
                    ?>
                        <tr>
                            <td class="text-center" style="vertical-align: middle;"><?= base64_encode($itemUser->nama); ?></td>
                            <td style="vertical-align: middle;"><?= $itemInstrumen->instrumen; ?></td>
                            <td class="text-center" style="vertical-align: middle;"><?= $item->jwb_d; ?></td>
                            <td class="text-center" style="vertical-align: middle;"><?= $item->jwb_i; ?></td>
                            <td class="text-center" style="vertical-align: middle;"><?= $item->jwb_f; ?></td>
                            <td class="text-center" style="vertical-align: middle;"><?= $nilai; ?></td>
                            <td class="text-center" style="vertical-align: middle;"><?= $item->rekom; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
    $(document).ready(function() {
        $("#exportTable.displayExport").DataTable({
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            fixedHeader: true,
            paging: false,
            scrollY: 300,
        });
    });
</script>