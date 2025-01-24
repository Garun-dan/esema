<?php
$segments_after_admin = $this->uri->segment_array(2);
array_shift($segments_after_admin);
$redirect_url = implode("/", $segments_after_admin);
?>
<main style="margin-bottom: 100px">
    <div class="form-group row">
        <div class="col-lg-6 col-sm-6 mb-3">
            <div class="box">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h4><b>Daftar Skala</b></h4>
                    <a class="tbl-primer text-decoration-none" data-bs-toggle="collapse" href="#tambahSkala" role="button" aria-expanded="false" aria-controls="tambahSkala">Tambah</a>
                </div>
                <div class="table-responsive mt-3">
                    <table id="tabel" class="display table table-striped table-bordered table-hover">
                        <thead class="table-success">
                            <tr>
                                <th class="text-center" style="vertical-align: middle;">No</th>
                                <th class="text-center" style="vertical-align: middle;">Skala</th>
                                <th class="text-center" style="vertical-align: middle;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($getSkala as $gs) { ?>
                                <tr>
                                    <td class="text-center" style="vertical-align: middle;"><?= $i; ?></td>
                                    <td style="vertical-align: middle;">
                                        <?php if ($gs->range_skala == 5) : ?>
                                            <?= $gs->nama_skala; ?> (Default)
                                        <?php else : ?>
                                            <?= $gs->nama_skala; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center" style="vertical-align: middle;">
                                        <button type="button" class="tbl-warning" data-bs-toggle="collapse" data-bs-target="#editSkala<?= $gs->id_skala; ?>" aria-expanded="false" aria-controls="editSkala"><span class="bi bi-pencil-square"></span></button>
                                    </td>
                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 mb-3">
            <div class="collapse" id="tambahSkala">
                <div class="card card-body border-0" style="box-shadow: 4px 4px 4px rgba(0,0,0, 0.2);">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="mb-3"><b>Form Tambah Skala</b></h4>
                        <a type="button" id="closeCollapseButton" style="background-color: none; border:0; font-size:12px;"><span class="bi bi-x"></span></a>
                    </div>
                    <form action="<?= base_url('admin/master-data/data-skala/tambah'); ?>" method="post">
                        <input type="hidden" name="redir" id="redir" class="form-control" value="<?= $redirect_url; ?>">
                        <?php $cekSkala = $this->MasterDataModel->getOneSkala(['range_skala' => 5]);
                        if (empty($cekSkala)) :
                        ?>
                            <div class="form-group mb-3">
                                <label for="nama_skala">Nama Skala</label>
                                <input type="text" name="nama_skala" id="nama_skala" class="form-control" value="Skala Likert 5" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="range_skala">Range Skala</label>
                                <input type="number" name="range_skala" id="range_skala" class="form-control" value="5" readonly>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-4 col-sm-4 mb-3">
                                    <div class="form-group mb-3">
                                        <label for="label_d1" style="font-size: 12px;">Tingkat Kesulitan 1 <span class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Persentase Keberhasilan Lebih Dari 95%"></span></label>
                                        <input type="text" name="label_d1" id="label_d1" class="form-control" value="Sangat Mudah" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="label_d2" style="font-size: 12px;">Tingkat Kesulitan 2 <span class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Persentase Keberhasilan Lebih Dari 85%"></span></label>
                                        <input type="text" name="label_d2" id="label_d2" class="form-control" value="Mudah" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="label_d3" style="font-size: 12px;">Tingkat Kesulitan 3 <span class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Persentase Keberhasilan Lebih Dari 80%"></span></label>
                                        <input type="text" name="label_d3" id="label_d3" class="form-control" value="Sedang" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="label_d4" style="font-size: 12px;">Tingkat Kesulitan 4 <span class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Persentase Keberhasilan Kurang Dari 50%"></span></label>
                                        <input type="text" name="label_d4" id="label_d4" class="form-control" value="Sulit" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="label_d5" style="font-size: 12px;">Tingkat Kesulitan 5 <span class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Persentase Keberhasilan Kurang Dari 15%"></span></label>
                                        <input type="text" name="label_d5" id="label_d5" class="form-control" value="Sangat Sulit" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 mb-3">
                                    <div class="form-group mb-3">
                                        <label for="label_i1" style="font-size: 12px;">Tingkat Kepentingan 1 <span class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Dampak Kegagalan Kesalahan Tugas Mudah Diperbaiki"></span></label>
                                        <input type="text" name="label_i1" id="label_i1" class="form-control" value="Sangat Tidak Penting" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="label_i2" style="font-size: 12px;">Tingkat Kepentingan 2 <span class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Dampak Kegagalan Kesalahan Tugas Tidak Mengancam Nyawa"></span></label>
                                        <input type="text" name="label_i2" id="label_i2" class="form-control" value="Tidak Penting" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="label_i3" style="font-size: 12px;">Tingkat Kepentingan 3 <span class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Dampak Kegagalan Kesalahan Tugas Sulit Diperbaiki Tapi Tidak Mengancam Nyawa"></span></label>
                                        <input type="text" name="label_i3" id="label_i3" class="form-control" value="Cukup Penting" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="label_i4" style="font-size: 12px;">Tingkat Kepentingan 4 <span class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Dampak Kegagalan Kesalahan Tugas Mengancam Nyawa Dan Sulit Diperbaiki"></span></label>
                                        <input type="text" name="label_i4" id="label_i4" class="form-control" value="Penting" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="label_i5" style="font-size: 12px;">Tingkat Kepentingan 5 <span class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Dampak Kegagalan Kesalahan Tugas Sangat Mengancam Nyawa"></span></label>
                                        <input type="text" name="label_i5" id="label_i5" class="form-control" value="Sangat Penting" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4">
                                    <div class="form-group mb-3">
                                        <label for="label_f1" style="font-size: 12px;">Tingkat Keseringan 1 <span class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hampir Tidak Pernah Dikerjakan"></span></label>
                                        <input type="text" name="label_f1" id="label_f1" class="form-control" value="Sangat Jarang" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="label_f2" style="font-size: 12px;">Tingkat Keseringan 2 <span class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Dikerjakan kurang dari 1 kali seminggu"></span></label>
                                        <input type="text" name="label_f2" id="label_f2" class="form-control" value="Jarang" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="label_f3" style="font-size: 12px;">Tingkat Keseringan 3 <span class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Dikerjakan kurang dari 1 kali sehari atau 1 kali dalam seminggu"></span></label>
                                        <input type="text" name="label_f3" id="label_f3" class="form-control" value="Cukup Sering" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="label_f4" style="font-size: 12px;">Tingkat Keseringan 4 <span class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Dikerjakan lebih dari 1 kali sehari"></span></label>
                                        <input type="text" name="label_f4" id="label_f4" class="form-control" value="Sering" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="label_f5" style="font-size: 12px;">Tingkat Keseringan 5 <span class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Dikerjakan tiap hari"></span></label>
                                        <input type="text" name="label_f5" id="label_f5" class="form-control" value="Sangat Sering" required>
                                    </div>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="form-group mb-3">
                                <label for="nama_skala">Nama Skala</label>
                                <input type="text" name="nama_skala" id="nama_skala" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="range_skala">Range Skala</label>
                                <input type="number" name="range_skala" id="range_skala" class="form-control" required>
                            </div>
                            <div class="row d-none" id="item-range">
                                <div class="col-lg-4 col-sm-4 mb-3">
                                    <div class="form-group mb-3" id="skala_d">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 mb-3">
                                    <div class="form-group mb-3" id="skala_i">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 mb-3">
                                    <div class="form-group mb-3" id="skala_f">
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="text-center mb-3">
                            <button type="submit" class="tbl-primer">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            <?php foreach ($getSkala as $gs) {
                $difficult = json_decode($gs->skala_d, true);
                $important = json_decode($gs->skala_i, true);
                $frequency = json_decode($gs->skala_f, true);
            ?>
                <div class="collapse" id="editSkala<?= $gs->id_skala; ?>">
                    <div class="card card-body border-0" style="box-shadow: 4px 4px 4px rgba(0,0,0,0.2);">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="mb-3"><b>Form Edit <?= $gs->nama_skala; ?></b></h4>
                        </div>
                        <form action="<?= base_url('admin/master-data/data-skala/edit-skala-' . $gs->id_skala); ?>" method="post">
                            <input type="hidden" name="redir" id="redir" class="form-control" value="<?= $redirect_url; ?>">
                            <div class="form-group mb-3">
                                <label for="nama_skala_edit">Nama Skala</label>
                                <input type="text" name="nama_skala_edit" id="nama_skala_edit" class="form-control" value="<?= $gs->nama_skala; ?>" required>
                            </div>
                            <?php if ($gs->range_skala != 5) : ?>
                                <div class="form-group mb-3">
                                    <label for="range_skala_edit">Range Skala</label>
                                    <input type="number" name="range_skala_edit" id="range_skala_edit" class="form-control" value="<?= $gs->range_skala; ?>" required>
                                </div>
                            <?php endif; ?>
                            <div class="row mb-3">
                                <div class="col-lg-4 col-sm-4 mb-3">
                                    <?php $a = 1;
                                    foreach ($difficult as $sulit) { ?>
                                        <div class="form-group mb-3">
                                            <label for="skala_d_edit_<?= $a; ?>" style="font-size: 12px;">Tingkat Kesulitan <?= $a; ?></label>
                                            <input type="text" name="skala_d_edit[]" id="skala_d_edit_<?= $a; ?>" class="form-control" value="<?= $sulit; ?>" required>
                                        </div>
                                    <?php $a++;
                                    } ?>
                                </div>
                                <div class="col-lg-4 col-sm-4 mb-3">
                                    <?php $a = 1;
                                    foreach ($important as $penting) { ?>
                                        <div class="form-group mb-3">
                                            <label for="skala_i_edit_<?= $a; ?>" style="font-size: 12px;">Tingkat Kepentingan <?= $a; ?></label>
                                            <input type="text" name="skala_i_edit[]" id="skala_i_edit_<?= $a; ?>" class="form-control" value="<?= $penting; ?>" required>
                                        </div>
                                    <?php $a++;
                                    } ?>
                                </div>
                                <div class="col-lg-4 col-sm-4 mb-3">
                                    <?php $a = 1;
                                    foreach ($frequency as $sering) { ?>
                                        <div class="form-group mb-3">
                                            <label for="skala_f_edit_<?= $a; ?>" style="font-size: 12px;">Tingkat Keseringan <?= $a; ?></label>
                                            <input type="text" name="skala_f_edit[]" id="skala_f_edit_<?= $a; ?>" class="form-control" value="<?= $sering; ?>" required>
                                        </div>
                                    <?php $a++;
                                    } ?>
                                </div>
                            </div>
                            <div class="text-center mb-3">
                                <button type="submit" class="tbl-primer">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</main>
<script src="<?= base_url('assets/'); ?>plugin/popper/popper.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugin/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        $("#closeCollapseButton").click(function() {
            $("#tambahSkala").collapse('hide');
        });
    });

    $(document).ready(function() {
        $(".tbl-warning").on("click", function(event) {
            event.preventDefault();
            var targetCollapseId = $(this).data("target");
            $(".collapse.show").removeClass("show");
            $(targetCollapseId).addClass("show");
        });
    });
</script>

<script src="<?= base_url('assets/tema/admin/data_skala.js'); ?>"></script>
<script>
    var rangeSkalaEdit = document.querySelectorAll('[id^=range_skala_edit]');
    rangeSkalaEdit.forEach(function(range) {
        range.addEventListener('input', function() {
            var valueRange = parseInt(range.value);
            var formContainer = range.closest('.collapse').querySelector('.row');
            var skalaDEditForms = formContainer.querySelectorAll('[id^=skala_d_edit]');
            var skalaIEditForms = formContainer.querySelectorAll('[id^=skala_i_edit]');
            var skalaFEditForms = formContainer.querySelectorAll('[id^=skala_f_edit]');

            [skalaDEditForms, skalaIEditForms, skalaFEditForms].forEach(function(forms) {
                var currentForms = forms.length;
                for (var i = currentForms; i < valueRange; i++) {
                    var newForm = document.createElement('div');
                    newForm.classList.add('form-group', 'mb-3');
                    var labelPrefix = (forms === skalaDEditForms) ? 'Tingkat Kesulitan ' : (forms === skalaIEditForms) ? 'Tingkat Kepentingan ' : 'Tingkat Keseringan ';
                    newForm.innerHTML = '<label for="' + forms[0].id.replace(/[0-9]+$/, '') + (i + 1) + '" style="font-size: 12px;">' + labelPrefix + (i + 1) + '</label>' +
                        '<input type="text" name="' + forms[0].name + '" id="' + forms[0].id.replace(/[0-9]+$/, '') + (i + 1) + '" class="form-control" value="" required>';
                    formContainer.querySelector('.col-lg-4.col-sm-4.mb-3:nth-child(' + ((forms === skalaIEditForms) ? '2' : (forms === skalaFEditForms) ? '3' : '1') + ')').appendChild(newForm);
                }
                for (var i = currentForms - 1; i >= valueRange; i--) {
                    forms[i].remove();
                }
            });

            var labelPrefixes = ['Tingkat Kesulitan ', 'Tingkat Kepentingan ', 'Tingkat Keseringan '];
            for (var j = 0; j < 3; j++) {
                var forms = (j === 0) ? skalaDEditForms : (j === 1) ? skalaIEditForms : skalaFEditForms;
                for (var i = 0; i < forms.length; i++) {
                    forms[i].querySelector('label').textContent = labelPrefixes[j] + (i + 1);
                }
            }
        });
    });
</script>