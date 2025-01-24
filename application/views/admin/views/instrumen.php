<?php
$segments_after_admin = $this->uri->segment_array(2);
array_shift($segments_after_admin);
$redirect_url = implode("/", $segments_after_admin);

$uri = $this->uri->segment(4);
$uri1 = $this->uri->segment(1);
$uri2 = $this->uri->segment(2);
$uri3 = $this->uri->segment(3);
$back = $uri1 . '/' . $uri2 . '/' . $uri3;

$jabfung = $this->MasterDataModel->getOneJabfung(['slug_jabfung' => $uri]);

$dataJenjang = $this->MasterDataModel->getAllJenjang(['id_jabfung' => $jabfung->id_jabfung]);
?>

<main style="margin-bottom: 100px;">
    <div class="form-group row mb-3">
        <div class="col-lg-4 col-sm-4 mb-3">
            <div class="box">
                <h2 class="mb-3"><b>Jabatan Fungsional <?= $jabfung->nama_jabfung; ?></b></h2>
                <h4 class="mb-3"><b>Form Tambah Instrumen</b></h4>
                <form action="<?= base_url('admin/master-data/data-jabfung/tambah-instrumen'); ?>" method="post" id="formInstrumen">
                    <input type="hidden" name="id_jabfung" id="id_jabfung" value="<?= $uri; ?>">
                    <div class="form-group mb-3">
                        <label for="id_jenjang">Data Jenjang</label>
                        <select name="id_jenjang" id="id_jenjang" class="form-control">
                            <?php foreach ($dataJenjang as $dj) { ?>
                                <option value="<?= $dj->id_jenjang; ?>"><?= $dj->nama_jenjang; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="instrumen">Data Intrumen</label>
                        <div id="butir-jenjang" class="mb-3"></div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="tbl-primer" id="simpanButton">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-8 col-sm-8 mb-3">
            <div class="chart-statistik m-0">
                <div class="chart-sidebar" style="width: auto;">
                    <?php foreach ($dataJenjang as $dj) { ?>
                        <li>
                            <a class="border-0 tbl-jenjang" data-bs-toggle="collapse" href="#<?= $dj->id_jenjang; ?>" role="button" aria-expanded="false" aria-controls="<?= $dj->id_jenjang; ?>">
                                <?= $dj->nama_jenjang; ?>
                            </a>
                        </li>
                    <?php } ?>
                </div>
                <div class="chart-view">
                    <?php foreach ($dataJenjang as $dj) {
                        $oneJabfung = $this->MasterDataModel->getOneJabfung(['id_jabfung' => $dj->id_jabfung]);
                    ?>
                        <div class="collapse" id="<?= $dj->id_jenjang; ?>">
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="mb-3"><b>Instrumen Jabatan Fungsional <?= $oneJabfung->nama_jabfung; ?> <?= $dj->nama_jenjang; ?></b></h4>
                                <a href="<?= base_url($back); ?>" class="tbl-info text-decoration-none">Kembali</a>
                            </div>

                            <div class="table-responsive mt-3">
                                <table id="tabelJenjang<?= $dj->id_jenjang; ?>" class="table table-striped table-bordered table-hover" style="width:100%">
                                    <thead class="table-success">
                                        <tr>
                                            <th class="text-center" style="vertical-align: middle;">No</th>
                                            <th class="text-center" style="vertical-align: middle;">Instrumen</th>
                                            <th class="text-center" style="vertical-align: middle;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        $getDataInstrumen = $this->MasterDataModel->getAllInstrumen(['id_jenjang' => $dj->id_jenjang]);
                                        foreach ($getDataInstrumen as $int) {
                                        ?>
                                            <tr>
                                                <td class="text-center" style="vertical-align: middle;"><?= $i; ?></td>
                                                <td style="vertical-align: middle; text-align:justify;"><?= $int->instrumen; ?></td>
                                                <td class="text-center" style="vertical-align: middle;">
                                                    <button type="button" class="tbl-warning mb-3" data-bs-toggle="modal" data-bs-target="#editInstrumen<?= $int->id_instrumen; ?>"><span class="bi bi-pencil-square"></span></button>
                                                    <a href="<?= base_url('admin/master-data/data-jabfung/' . $uri . '/instrumen/hapus-' . $int->id_instrumen); ?>" class="tbl-danger tbl-hapus mb-3"><span class="bi bi-trash-fill"></span></a>
                                                </td>
                                            </tr>
                                        <?php $i++;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    $(document).ready(function() {
        $("table[id^='tabelJenjang']").each(function() {
            $(this).DataTable({
                fixedHeader: true,
                paging: false,
                scrollY: 300
            });
        });

        $('.collapse').on('shown.bs.collapse', function() {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        var collapses = document.querySelectorAll('.collapse');

        collapses.forEach(function(collapse) {
            collapse.addEventListener('show.bs.collapse', function() {
                collapses.forEach(function(otherCollapse) {
                    if (otherCollapse !== collapse && otherCollapse.classList.contains('show')) {
                        otherCollapse.classList.remove('show');
                        var otherCollapseId = otherCollapse.getAttribute('id');
                        var otherLink = document.querySelector('a[href="#' + otherCollapseId + '"]');
                        otherLink.classList.remove('chart-aktif');
                    }
                });

                var jenjangId = collapse.getAttribute('id');
                var link = document.querySelector('a[href="#' + jenjangId + '"]');
                link.classList.add('chart-aktif');
            });

            collapse.addEventListener('hide.bs.collapse', function() {
                var jenjangId = collapse.getAttribute('id');
                var link = document.querySelector('a[href="#' + jenjangId + '"]');
                link.classList.remove('chart-aktif');
            });
        });

        if (collapses.length > 0) {
            collapses[0].classList.add('show');
            var firstCollapseId = collapses[0].getAttribute('id');
            var firstLink = document.querySelector('a[href="#' + firstCollapseId + '"]');
            firstLink.classList.add('chart-aktif');
        }
    });
</script>
<script src="<?= base_url('assets/tema/admin/instrumen.js'); ?>"></script>