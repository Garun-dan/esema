<?php
$segments_after_admin = $this->uri->segment_array(2);
array_shift($segments_after_admin);
$redirect_url = implode("/", $segments_after_admin);
?>
<main style="margin-bottom: 100px">
    <div class="box">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="daftarUser-tab" data-bs-toggle="tab" data-bs-target="#daftarUser" type="button" role="tab" aria-controls="daftarUser" aria-selected="true">Daftar User</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="daftarPangkat-tab" data-bs-toggle="tab" data-bs-target="#daftarPangkat" type="button" role="tab" aria-controls="daftarPangkat" aria-selected="false">Daftar Pangkat</button>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="daftarUser" role="tabpanel" aria-labelledby="daftarUser-tab" tabindex="0">
                <div class="row mb-3 mt-3">
                    <div class="col-lg-4 col-sm-4 mb-3 border-end">
                        <h4 class="mb-3"><b>Form Tambah User</b></h4>
                        <form action="<?= base_url('admin/master-data/data-user/simpan'); ?>" method="post" id="formUser">
                            <input type="hidden" name="redir" id="redir" class="form-control" value="<?= $redirect_url; ?>">
                            <div class="form-group mb-3">
                                <label for="tipe_data">Tipe Input Data</label>
                                <select name="tipe_data" id="tipe_data" class="form-control">
                                    <option selected>Pilih Tipe Input</option>
                                    <option value="manual">Manual</option>
                                    <option value="api">API</option>
                                </select>
                            </div>
                            <div id="view-tipe" class="d-none"></div>
                            <div class="text-center mt-3">
                                <button type="submit" class="tbl-primer" id="simpanButton">Tambah</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-8 col-sm-8 mb-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h4 class="mb-3"><b>Daftar User</b></h4>
                        </div>
                        <div class="table-responsive mt-3">
                            <table id="tabels" class="display table table-striped table-bordered table-hover nowrap" style="width:100%">
                                <thead class="table-success">
                                    <tr>
                                        <th class="text-center" style="vertical-align: middle;">No</th>
                                        <th class="text-center" style="vertical-align: middle;">Nama User</th>
                                        <th class="text-center" style="vertical-align: middle;">Status Role</th>
                                        <th class="text-center" style="vertical-align: middle;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($getUser as $gu) {
                                        $dataRole = $this->SettingsModel->getOneRole(['id_role' => $gu->id_role]);
                                    ?>
                                        <?php if (empty($gu->id_role)) : ?>
                                            <tr class="table-warning">
                                            <?php else : ?>
                                            <tr>
                                            <?php endif; ?>
                                            <td class="text-center" style="vertical-align: middle;"><?= $i; ?></td>
                                            <td style="vertical-align: middle;"><?= $gu->nama; ?></td>
                                            <td style="vertical-align: middle;">
                                                <?php if (!empty($gu->id_role)) : ?>
                                                    <?= $dataRole->nama_role; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                <?php if ($gu->id_role != 'role-1') : ?>
                                                    <button type="button" class="tbl-warning" data-bs-toggle="offcanvas" data-bs-target="#editPengguna<?= $gu->id_user; ?>" aria-controls="editPengguna">Edit</button>
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
            </div>
            <div class="tab-pane" id="daftarPangkat" role="tabpanel" aria-labelledby="daftarPangkat-tab" tabindex="0">
                <div class="row mb-3 mt-3">
                    <div class="col-lg-4 col-sm-4 mb-3 border-end">
                        <h4 class="mb-3"><b>Form Tambah Pangkat</b></h4>
                        <form action="<?= base_url('admin/master-data/data-user/simpan-pangkat'); ?>" method="post">
                            <input type="hidden" name="redir" id="redir" class="form-control" value="<?= $redirect_url; ?>">
                            <div class="form-group mb-3">
                                <label for="pangkat">Nama Pangkat</label>
                                <input type="text" name="pangkat" id="pangkat" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="golongan">Type Golongan</label>
                                <input type="text" name="golongan" id="golongan" class="form-control" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="tbl-primer">Tambah</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-8 col-sm-8 mb-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h4 class="mb-3"><b>Daftar Pangkat</b></h4>
                        </div>
                        <div class="table-responsive mt-3">
                            <table id="tabels" class="display table table-striped table-bordered table-hover nowrap" style="width:100%">
                                <thead class="table-success">
                                    <tr>
                                        <th class="text-center" style="vertical-align: middle;">No</th>
                                        <th class="text-center" style="vertical-align: middle;">Nama Pangkat</th>
                                        <th class="text-center" style="vertical-align: middle;">Type Golongan</th>
                                        <th class="text-center" style="vertical-align: middle;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($getPangkat as $pk) { ?>
                                        <tr>
                                            <td class="text-center" style="vertical-align: middle;"><?= $i; ?></td>
                                            <td style="vertical-align: middle;"><?= $pk->pangkat; ?></td>
                                            <td class="text-center" style="vertical-align: middle;"><?= $pk->golongan; ?></td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                <button type="button" class="tbl-warning" data-bs-toggle="modal" data-bs-target="#editPangkat<?= $pk->id_pangkat; ?>">
                                                    <span class="bi bi-pencil-square"></span>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php $i++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    $(document).ready(function() {
        $("#tabels.display").DataTable({
            fixedHeader: true,
            paging: false,
            scrollY: 300,
        });

        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    });
</script>

<script src="<?= base_url('assets/tema/admin/user.js'); ?>"></script>