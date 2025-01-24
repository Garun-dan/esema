<?php
$segments_after_admin = $this->uri->segment_array(2);
array_shift($segments_after_admin);
$redirect_url = implode("/", $segments_after_admin);
?>

<main style="margin-bottom: 100px">
    <div class="form-group row">
        <!-- Menu -->
        <div class="col-lg-6 col-sm-6 mb-3">
            <div class="box">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h4><b>Daftar Menu</b></h4>
                    <button type="button" class="tbl-primer" data-bs-toggle="collapse" data-bs-target="#tambahMenu" aria-expanded="false" aria-controls="tambahMenu">Tambah</button>
                </div>
                <div class="collapse" id="tambahMenu">
                    <div class="card card-body">
                        <form action="<?= base_url('admin/settings/menu/tambah-menu'); ?>" method="post">
                            <input type="hidden" name="redir" id="redir" class="form-control" value="<?= $redirect_url; ?>">

                            <div class="row">
                                <div class="col-lg-4 col-sm-4 mb-3">
                                    <label for="nama_menu">Nama Menu</label>
                                    <input type="text" name="nama_menu" id="nama_menu" class="form-control" placeholder="Nama Menu..." required>
                                </div>
                                <div class="col-lg-4 col-sm-4 mb-3">
                                    <label for="icon_menu">Icon Menu</label>
                                    <input type="text" name="icon_menu" id="icon_menu" class="form-control" placeholder="Icon Menu..." required>
                                    cek icon : <a href="https://icons.getbootstrap.com/" target="_blank" rel="noopener noreferrer">Cek Icon</a>
                                </div>
                                <div class="col-lg-4 col-sm-4 mb-3">
                                    <label for="posisi_menu">Posisi Menu</label>
                                    <select name="posisi_menu" id="posisi_menu" class="form-control">
                                        <option value="home">Home</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="tbl-primer">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive mt-3">
                    <table id="tabel" class="display table table-striped table-bordered table-hover">
                        <thead class="table-success">
                            <tr>
                                <th class="text-center" style="vertical-align: middle;">No</th>
                                <th class="text-center" style="vertical-align: middle;">Menu</th>
                                <th class="text-center" style="vertical-align: middle;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($getMenu as $gm) { ?>
                                <tr>
                                    <td class="text-center" style="vertical-align: middle;"><?= $i; ?></td>
                                    <td style="vertical-align: middle;"><?= $gm->nama_menu; ?></td>
                                    <td class="text-center" style="vertical-align: middle;">
                                        <a type="button" class="tbl-warning text-decoration-none" data-bs-toggle="offcanvas" data-bs-target="#editMenu<?= $gm->id_menu; ?>" aria-controls="editMenu"><span class="bi bi-pencil-square"></span></a>
                                    </td>
                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Submenu -->
        <div class="col-lg-6 col-sm-6 mb-3">
            <div class="box">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h4><b>Daftar Submenu</b></h4>
                    <button type="button" class="tbl-primer" data-bs-toggle="collapse" data-bs-target="#tambahSubmenu" aria-expanded="false" aria-controls="tambahSubmenu">Tambah</button>
                </div>

                <div class="collapse" id="tambahSubmenu">
                    <div class="card card-body">
                        <form action="<?= base_url('admin/settings/menu/tambah-submenu'); ?>" method="post">
                            <input type="hidden" name="redir" id="redir" class="form-control" value="<?= $redirect_url; ?>">

                            <div class="row">
                                <div class="col-lg-6 col-sm-6 mb-3">
                                    <label for="nama_submenu">Nama Submenu</label>
                                    <input type="text" name="nama_submenu" id="nama_submenu" class="form-control" placeholder="Nama Menu..." required>
                                </div>
                                <div class="col-lg-6 col-sm-6 mb-3">
                                    <label for="menu">Menu</label>
                                    <select name="id_menu" id="id_menu" class="form-control">
                                        <?php foreach ($getMenu as $gm) { ?>
                                            <option value="<?= $gm->id_menu; ?>"><?= $gm->nama_menu; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="tbl-primer">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive mt-3">
                    <table id="tabel" class="display table table-striped table-bordered table-hover">
                        <thead class="table-success">
                            <tr>
                                <th class="text-center" style="vertical-align: middle;">No</th>
                                <th class="text-center" style="vertical-align: middle;">Submenu</th>
                                <th class="text-center" style="vertical-align: middle;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($getSubmenu as $gsm) { ?>
                                <tr>
                                    <td class="text-center" style="vertical-align: middle;"><?= $i; ?></td>
                                    <td style="vertical-align: middle;"><?= $gsm->nama_submenu; ?></td>
                                    <td class="text-center" style="vertical-align: middle;">
                                        <a type="button" class="tbl-warning text-decoration-none" data-bs-toggle="offcanvas" data-bs-target="#editSubmenu<?= $gsm->id_submenu; ?>" aria-controls="editSubmenu"><span class="bi bi-pencil-square"></span></a>
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
</main>