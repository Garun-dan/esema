<?php
$segments_after_admin = $this->uri->segment_array(2);
array_shift($segments_after_admin);
$redirect_url = implode("/", $segments_after_admin);
?>
<main style="margin-bottom: 100px">
    <div class="form-group row mb-3">
        <div class="col-lg-6 col-sm-6 mb-3">
            <div class="box">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h4><b>Daftar Role Akses</b></h4>
                    <button type="button" class="tbl-primer" data-bs-toggle="collapse" data-bs-target="#tambahRole" aria-expanded="false" aria-controls="tambahRole">Tambah</button>
                </div>

                <div class="collapse" id="tambahRole">
                    <div class="card card-body">
                        <form action="<?= base_url('admin/settings/hak-akses/tambah-role'); ?>" method="post">
                            <input type="hidden" name="redir" id="redir" class="form-control" value="<?= $redirect_url; ?>">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="form-group mb-3 col-lg-9">
                                    <label for="role">Nama Role</label>
                                    <input type="text" name="role" id="role" class="form-control" required>
                                </div>
                                <div class="form-group mb-3 my-auto">
                                    <button type="submit" class="tbl-primer">Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive mt-3">
                    <table id="tabel" class="display table table-striped table-bordered table-hover">
                        <thead class="table-success">
                            <tr>
                                <th class="text-center" style="vertical-align: middle;">No</th>
                                <th class="text-center" style="vertical-align: middle;">Role Akses</th>
                                <th class="text-center" style="vertical-align: middle;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($getRole as $gr) { ?>
                                <tr>
                                    <td class="text-center" style="vertical-align: middle;"><?= $i; ?></td>
                                    <td style="vertical-align: middle;"><?= $gr->nama_role; ?></td>
                                    <td class="text-center" style="vertical-align: middle;">
                                        <button type="button" class="tbl-warning" data-bs-toggle="offcanvas" data-bs-target="#editRole<?= $gr->id_role; ?>" aria-controls="editRole"><span class="bi bi-pencil-square"></span></button>
                                        <button type="button" class="tbl-info" data-bs-toggle="collapse" data-bs-target="#hakAkses<?= $gr->id_role; ?>" aria-expanded="false" aria-controls="hakAkses"><span class="bi bi-shield-lock-fill"></span></button>
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
            <?php foreach ($getRole as $gr) : ?>
                <div class="collapse" id="hakAkses<?= $gr->id_role; ?>">
                    <div class="card card-body border-0" style="box-shadow: 4px 4px 4px rgba(0,0,0,0.2);">
                        <h4 class="mb-3"><b>Hak Akses <?= $gr->nama_role; ?></b></h4>
                        <div class="table-responsive mt-3">
                            <table id="tabelAkses<?= $gr->id_role; ?>" class="table table-striped table-bordered table-hover nowrap" style="width:100%">
                                <thead class="table-success">
                                    <tr>
                                        <th class="text-center" style="vertical-align: middle;">No</th>
                                        <th class="text-center" style="vertical-align: middle;">Menu</th>
                                        <th class="text-center" style="vertical-align: middle;">Submenu</th>
                                        <th class="text-center" style="vertical-align: middle;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php $allAdminMenu = $this->SettingsModel->getAllMenu(['posisi_menu' => 'admin']); ?>
                                    <?php foreach ($allAdminMenu as $admin) : ?>
                                        <tr>
                                            <td class="text-center" style="vertical-align: middle;"><?= $i; ?></td>
                                            <td style="vertical-align: middle;"><?= $admin->nama_menu; ?></td>
                                            <td style="vertical-align: middle;">
                                                <?php $allsub = $this->SettingsModel->getAllSubmenu(['id_menu' => $admin->id_menu]); ?>
                                                <?php foreach ($allsub as $sub) : ?>
                                                    <?= $sub->nama_submenu; ?><br>
                                                <?php endforeach; ?>
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                <?php if (!empty($allsub)) : ?>
                                                    <?php foreach ($allsub as $item) : ?>
                                                        <?php $cekData = $this->SettingsModel->cekAkses($gr->id_role, $item->id_menu, $item->id_submenu); ?>
                                                        <?php if (empty($cekData)) : ?>
                                                            <button class="tbl-danger give-access mb-1" data-role="<?= $gr->id_role ?>" data-menu="<?= $item->id_menu ?>" data-submenu="<?= $item->id_submenu ?>"><span class="bi bi-lock-fill"></span></button><br>
                                                        <?php else : ?>
                                                            <button class="tbl-primer give-access mb-1" data-role="<?= $gr->id_role ?>" data-menu="<?= $item->id_menu ?>" data-submenu="<?= $item->id_submenu ?>"><span class="bi bi-unlock-fill"></span></button><br>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <?php $subValue = '0'; ?>
                                                    <?php $subValues = ''; ?>
                                                    <?php $cekData = $this->SettingsModel->cekAkses($gr->id_role, $admin->id_menu, $subValues); ?>
                                                    <?php if (empty($cekData)) : ?>
                                                        <button class="tbl-danger give-access mb-1" data-role="<?= $gr->id_role ?>" data-menu="<?= $admin->id_menu ?>" data-submenu="<?= $subValue ?>"><span class="bi bi-lock-fill"></span></button><br>
                                                    <?php else : ?>
                                                        <button class="tbl-primer give-access mb-1" data-role="<?= $gr->id_role ?>" data-menu="<?= $admin->id_menu ?>" data-submenu="<?= $subValue ?>"><span class="bi bi-unlock-fill"></span></button><br>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<script>
    $(document).ready(function() {
        $("table[id^='tabelAkses']").each(function() {
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

        $(".give-access").on("click", function(event) {
            event.preventDefault();
            var $button = $(this);
            var role = $button.data("role");
            var menu = $button.data("menu");
            var submenu = $button.data("submenu");
            var url =
                "<?= base_url('admin/settings/hak-akses/beri-akses/'); ?>" + role + "/" + menu + "/" + submenu;
            $button.toggleClass("tbl-danger tbl-primer");
            $button.children("span.bi").toggleClass("bi-lock-fill bi-unlock-fill");
            console.log(url);

            $.post(url, function(response) {});
        });

        $(".tbl-info").on("click", function(event) {
            event.preventDefault();
            var targetCollapseId = $(this).data("target");
            $(".collapse.show").removeClass("show");
            $(targetCollapseId).addClass("show");
        });
    });
</script>