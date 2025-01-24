<?php
$segments_after_admin = $this->uri->segment_array(2);
array_shift($segments_after_admin);
$redirect_url = implode("/", $segments_after_admin);
?>

<!-- Menu Mobile -->
<?php foreach ($hakAkses as $akses) : ?>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="menu<?= $akses['slug_menu']; ?>" aria-labelledby="menu<?= $akses['slug_menu']; ?>Label">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title text-black" id="menu<?= $akses['slug_menu']; ?>Label">
                <b>Menu <?= $akses['nama_menu']; ?></b>
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav flex-column">
                <?php foreach ($akses['submenus'] as $submenu) : ?>
                    <?php if ($this->uri->segment(3) == $submenu['slug_submenu']) : ?>
                        <li class="nav-item" style="background: var(--primary-color)">
                            <a href="<?= base_url('admin/' . $akses['slug_menu'] . '/' . $submenu['slug_submenu']); ?>" class="nav-link text-white text-decoration-none"><?= $submenu['nama_submenu']; ?></a>
                        <?php else : ?>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/' . $akses['slug_menu'] . '/' . $submenu['slug_submenu']); ?>" class="nav-link text-dark text-decoration-none"><?= $submenu['nama_submenu']; ?></a>
                        <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php endforeach; ?>

<!-- Edit SubMenu -->
<?php foreach ($getSubmenu as $gsm) { ?>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="editSubmenu<?= $gsm->id_submenu; ?>" aria-labelledby="editSubmenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="editSubmenuLabel">Edit Submenu <?= $gsm->nama_submenu; ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form action="<?= base_url('admin/settings/menu/edit-submenu/' . $gsm->id_submenu); ?>" method="post">
                <input type="hidden" name="redir" id="redir" class="form-control" value="<?= $redirect_url; ?>">
                <div class="form-group mb-3">
                    <label for="nama_submenu">Nama Submenu</label>
                    <input type="text" name="nama_submenu" id="nama_submenu" class="form-control" value="<?= $gsm->nama_submenu; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="id_menu">Nama Menu</label>
                    <select name="id_menu" id="id_menu" class="form-control">
                        <option value="<?= $gsm->id_menu; ?>">
                            <?php $namaMenu = $this->SettingsModel->joinSubtoMenu($gsm->id_menu); ?>
                            <?= $namaMenu->nama_menu; ?>
                        </option>
                        <?php foreach ($getMenu as $gm) { ?>
                            <?php if ($gm->id_menu != $gsm->id_menu) : ?>
                                <option value="<?= $gm->id_menu; ?>"><?= $gm->nama_menu; ?></option>
                            <?php endif; ?>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="is_active">Status Menu</label>
                    <select name="is_active" id="is_active" class="form-control">
                        <?php if ($gsm->is_active == 'Aktif') :
                        ?>
                            <option value="<?= $gsm->is_active; ?>"><?= $gsm->is_active; ?></option>
                            <option value="Non Aktif">Non Aktif</option>
                        <?php else : ?>
                            <option value="<?= $gsm->is_active; ?>"><?= $gsm->is_active; ?></option>
                            <option value="Aktif">Aktif</option>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <button type="submit" class="tbl-primer">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
<?php } ?>

<!-- Edit Menu -->
<?php foreach ($getMenu as $gm) { ?>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="editMenu<?= $gm->id_menu; ?>" aria-labelledby="editMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="editMenuLabel">Edit Menu <?= $gm->nama_menu; ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form action="<?= base_url('admin/settings/menu/edit-menu/' . $gm->id_menu); ?>" method="post">
                <input type="hidden" name="redir" id="redir" class="form-control" value="<?= $redirect_url; ?>">
                <div class="form-group mb-3">
                    <label for="nama_menu">Nama Menu</label>
                    <input type="text" name="nama_menu" id="nama_menu" class="form-control" value="<?= $gm->nama_menu; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="icon_menu">Icon Menu</label>
                    <input type="text" name="icon_menu" id="icon_menu" class="form-control" value="<?= $gm->icon_menu; ?>" required>
                    cek icon : <a href="https://icons.getbootstrap.com/" target="_blank" rel="noopener noreferrer">Cek Icon</a>
                </div>
                <div class="form-group mb-3">
                    <label for="posisi_menu">Posisi Menu</label>
                    <select name="posisi_menu" id="posisi_menu" class="form-control">
                        <?php if ($gm->posisi_menu == 'home') :
                            $posisi = ucwords($gm->posisi_menu);
                        ?>
                            <option value="<?= $gm->posisi_menu; ?>"><?= $posisi; ?></option>
                            <option value="admin">Admin</option>
                        <?php else : ?>
                            <option value="<?= $gm->posisi_menu; ?>"><?= $posisi; ?></option>
                            <option value="home">Home</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="is_active">Status Menu</label>
                    <select name="is_active" id="is_active" class="form-control">
                        <?php if ($gm->is_active == 'Aktif') :
                        ?>
                            <option value="<?= $gm->is_active; ?>"><?= $gm->is_active; ?></option>
                            <option value="Non Aktif">Non Aktif</option>
                        <?php else : ?>
                            <option value="<?= $gm->is_active; ?>"><?= $gm->is_active; ?></option>
                            <option value="Aktif">Aktif</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <button type="submit" class="tbl-primer">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
<?php } ?>

<!-- Edit Role -->
<?php foreach ($getRole as $gr) { ?>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="editRole<?= $gr->id_role; ?>" aria-labelledby="editRoleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="editRoleLabel">Edit Role <?= $gr->nama_role; ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form action="<?= base_url('admin/settings/hak-akses/edit-role/' . $gr->id_role); ?>" method="post">
                <input type="hidden" name="redir" id="redir" class="form-control" value="<?= $redirect_url; ?>">
                <div class="form-group mb-3">
                    <label for="role">Nama Role</label>
                    <input type="text" name="role" id="role" class="form-control" value="<?= $gr->nama_role; ?>" required>
                </div>
                <div class="form-group mb-3 my-auto">
                    <button type="submit" class="tbl-primer">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
<?php } ?>

<!-- Tambah Jabfung -->
<div class="modal fade" id="tambahJabfung" tabindex="-1" aria-labelledby="tambahJabfungLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahJabfungLabel">Form Tambah Jabfung</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/master-data/data-jabfung/tambah-jabfung'); ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="redir" id="redir" class="form-control" value="<?= $redirect_url; ?>">
                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-6 mb-3">
                            <label for="nama_jabfung" style="font-size:12px;">Nama Jabfung</label>
                            <input type="text" name="nama_jabfung" id="nama_jabfung" class="form-control" required>
                        </div>
                        <div class="col-lg-6 col-sm-6 mb-3">
                            <label for="tot_jenjang" style="font-size:12px;">Jumlah Jenjang</label>
                            <input type="number" name="tot_jenjang" id="tot_jenjang" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-lg-6 col-sm-6 mb-3">
                            <div id="item-jenjang" class="d-none"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            <script src="<?= base_url('assets/tema/admin/jabfung.js'); ?>"></script>
        </div>
    </div>
</div>

<!-- Edit Jabfung -->
<?php foreach ($getJabfung as $gj) { ?>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="editJabfung<?= $gj->id_jabfung; ?>" aria-labelledby="editJabfungLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="editJabfungLabel">Edit Jabfung <?= $gj->nama_jabfung; ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form action="<?= base_url('admin/master-data/data-jabfung/edit-data-jabfung-' . $gj->id_jabfung); ?>" method="post">
                <input type="hidden" name="redir" id="redir" class="form-control" value="<?= $redirect_url; ?>">

                <div class="mb-3">
                    <label for="nama_jabfung">Nama Jabfung</label>
                    <input type="text" name="nama_jabfung" id="nama_jabfung" class="form-control" value="<?= $gj->nama_jabfung; ?>" required>
                </div>
                <button type="submit" class="tbl-primer">Simpan Perubahan</button>
            </form>
        </div>
    </div>
<?php } ?>

<!-- Edit Instrumen -->
<?php foreach ($getInstrumen as $gi) {
    $uri = $this->uri->segment(4);
?>
    <div class="modal fade" id="editInstrumen<?= $gi->id_instrumen; ?>" tabindex="-1" aria-labelledby="editInstrumenLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editInstrumenLabel">Edit Instrumen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('admin/master-data/data-jabfung/instrumen/edit-' . $gi->id_instrumen); ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id_jabfung" id="id_jabfung" class="form-control" value="<?= $uri; ?>">
                        <textarea name="instrumen" id="instrumen" cols="30" rows="10" class="form-control"><?= $gi->instrumen; ?></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Edit Jenjang -->
<?php foreach ($getJenjang as $gj) { ?>
    <div class="modal fade" id="editJJ<?= $gj->id_jenjang; ?>" tabindex="-1" aria-labelledby="editJJLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editJJLabel">Edit Jenjang <?= $gj->nama_jenjang; ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('admin/master-data/data-jabfung/edit-jenjang/' . $gj->id_jenjang . '/' . $gj->id_jabfung); ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="redir" id="redir" class="form-control" value="<?= $redirect_url; ?>">
                        <label for="nama_jenjang">Nama Jenjang</label>
                        <select name="nama_jenjang" id="nama_jenjang" class="form-control" required>
                            <option value="<?= $gj->nama_jenjang; ?>"><?= $gj->nama_jenjang; ?></option>
                            <?php if ($gj->nama_jenjang == 'Terampil') : ?>
                                <option value="Mahir">Mahir</option>
                                <option value="Penyelia">Penyelia</option>
                                <option value="Ahli Pertama">Ahli Pertama</option>
                                <option value="Ahli Muda">Ahli Muda</option>
                                <option value="Ahli Madya">Ahli Madya</option>
                                <option value="Ahli Utama">Ahli Utama</option>
                            <?php elseif ($gj->nama_jenjang == 'Mahir') : ?>
                                <option value="Terampil">Terampil</option>
                                <option value="Penyelia">Penyelia</option>
                                <option value="Ahli Pertama">Ahli Pertama</option>
                                <option value="Ahli Muda">Ahli Muda</option>
                                <option value="Ahli Madya">Ahli Madya</option>
                                <option value="Ahli Utama">Ahli Utama</option>
                            <?php elseif ($gj->nama_jenjang == 'Penyelia') : ?>
                                <option value="Terampil">Terampil</option>
                                <option value="Mahir">Mahir</option>
                                <option value="Ahli Pertama">Ahli Pertama</option>
                                <option value="Ahli Muda">Ahli Muda</option>
                                <option value="Ahli Madya">Ahli Madya</option>
                                <option value="Ahli Utama">Ahli Utama</option>
                            <?php elseif ($gj->nama_jenjang == 'Ahli Pertama') : ?>
                                <option value="Terampil">Terampil</option>
                                <option value="Mahir">Mahir</option>
                                <option value="Penyelia">Penyelia</option>
                                <option value="Ahli Muda">Ahli Muda</option>
                                <option value="Ahli Madya">Ahli Madya</option>
                                <option value="Ahli Utama">Ahli Utama</option>
                            <?php elseif ($gj->nama_jenjang == 'Ahli Muda') : ?>
                                <option value="Terampil">Terampil</option>
                                <option value="Mahir">Mahir</option>
                                <option value="Penyelia">Penyelia</option>
                                <option value="Ahli Pertama">Ahli Pertama</option>
                                <option value="Ahli Madya">Ahli Madya</option>
                                <option value="Ahli Utama">Ahli Utama</option>
                            <?php elseif ($gj->nama_jenjang == 'Ahli Madya') : ?>
                                <option value="Terampil">Terampil</option>
                                <option value="Mahir">Mahir</option>
                                <option value="Penyelia">Penyelia</option>
                                <option value="Ahli Pertama">Ahli Pertama</option>
                                <option value="Ahli Muda">Ahli Muda</option>
                                <option value="Ahli Utama">Ahli Utama</option>
                            <?php else : ?>
                                <option value="Terampil">Terampil</option>
                                <option value="Mahir">Mahir</option>
                                <option value="Penyelia">Penyelia</option>
                                <option value="Ahli Pertama">Ahli Pertama</option>
                                <option value="Ahli Muda">Ahli Muda</option>
                                <option value="Ahli Madya">Ahli Madya</option>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Modal Edit Biodata -->
<div class="modal fade" id="editBiodataPengguna" tabindex="-1" aria-labelledby="editBiodataPenggunaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editBiodataPenggunaLabel">Edit Biodata</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/settings/profile/update'); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="redir" id="redir" class="form-control" value="<?= $redirect_url; ?>">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-lg-4 col-sm-4 mb-3">
                            <div class="form-group text-center mb-3">
                                <?php if (empty($pengguna->avatar)) : ?>
                                    <img src="<?= base_url('assets/'); ?>upload/profile/pria.png" alt="provile" id="p_provile" class="img-fluid" style="width: 100px; height:100px; border-radius:50%;" />
                                <?php else : ?>
                                    <img src="<?= base_url('assets/upload/profile/' . $pengguna->avatar); ?>" alt="provile" id="p_provile" class="img-fluid" style="width: 100px; height:100px; border-radius:50%;" />
                                <?php endif; ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="<?= $pengguna->nama; ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nik">NIK</label>
                                <input type="text" name="nik" id="nik" class="form-control" value="<?= $pengguna->nik; ?>" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nip">NIP</label>
                                <input type="text" name="nip" id="nip" class="form-control" value="<?= $pengguna->nip; ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="gender">Jenis Kelamin</label>
                                <select name="gender" id="gender" class="form-control">
                                    <?php if ($pengguna->gender) : ?>
                                        <?php if ($pengguna->gender == 'Pria') : ?>
                                            <option value="<?= $pengguna->gender; ?>"><?= $pengguna->gender; ?></option>
                                            <option value="Wanita">Wanita</option>
                                        <?php else : ?>
                                            <option value="<?= $pengguna->gender; ?>"><?= $pengguna->gender; ?></option>
                                            <option value="Pria">Pria</option>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <option value="Pria">Pria</option>
                                        <option value="Wanita">Wanita</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6 col-sm-6 mb-3">
                                    <label for="tmpt_lahir">Tempat Lahir</label>
                                    <input type="text" name="tmpt_lahir" id="tmpt_lahir" class="form-control" value="<?= $pengguna->tmpt_lahir; ?>" required>
                                </div>
                                <div class=" col-lg-6 col-sm-6 mb-3">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <?php if (!empty($pengguna->tgl_lahir)) : ?>
                                        <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" value="<?= $pengguna->tgl_lahir; ?>" required>
                                    <?php else : ?>
                                        <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" required>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if ($pengguna->id_role == 'role-4') : ?>
                                <div class=" form-group mb-3">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" cols="" rows="5" class="form-control" required><?= $pengguna->alamat; ?></textarea>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-4 col-sm-4 mb-3">

                            <div class="form-group mb-3">
                                <label for="no_hp">Nomor HP</label>
                                <input type="text" name="no_hp" id="no_hp" class="form-control" value="<?= $pengguna->no_hp; ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="avatar">Profile</label>
                                <?php if (empty($pengguna->avatar)) : ?>
                                    <input type="file" name="avatar" id="avatar" class="form-control" value="<?= $pengguna->avatar; ?>" required>
                                <?php else : ?>
                                    <input type="file" name="avatar" id="avatar" class="form-control" value="<?= $pengguna->avatar; ?>">
                                <?php endif; ?>
                            </div>
                            <?php if ($pengguna->id_role == 'role-4') :
                                $itemPangkat = $this->MasterDataModel->getOnePangkat(['id_pangkat' => $pengguna->id_pangkat]);
                                $itemDataJabfung = $this->MasterDataModel->getOneJabfung(['id_jabfung' => $pengguna->id_jabfung]);
                                $getJenjangs = $this->MasterDataModel->getAllJenjang(['id_jabfung' => $pengguna->id_jabfung]);
                                $itemDataJenjang = $this->MasterDataModel->getOneJenjang(['id_jenjang' => $pengguna->id_jenjang]);
                                $itemDataRumah = $this->MasterDataModel->getOneRumah(['id_rumah' => $pengguna->id_rumah]);
                            ?>
                                <div class="form-group mb-3">
                                    <label for="golongan">Golongan</label>
                                    <select name="golongan" id="golongan" class="form-control">
                                        <?php if (empty($pengguna->id_pangkat)) : ?>
                                            <option selected>Pilih Pangkat/ Golongan</option>
                                        <?php else : ?>
                                            <option value="<?= $pengguna->id_pangkat; ?>"><?= $itemPangkat->golongan; ?></option>
                                        <?php endif; ?>
                                        <?php foreach ($getPangkat as $gp) {
                                            if ($gp->id_pangkat != $pengguna->id_pangkat) {
                                        ?>
                                                <option value="<?= $gp->id_pangkat; ?>"><?= $gp->golongan; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="itemJabfung">Jabatan Fungsional</label>
                                    <select name="itemJabfung" id="itemJabfung" class="form-control" onchange="getitemJenjang()">
                                        <?php if (empty($pengguna->id_jabfung)) : ?>
                                            <option selected>Pilih Jabatan Fungsional</option>
                                        <?php else : ?>
                                            <option value="<?= $pengguna->id_jabfung; ?>"><?= $itemDataJabfung->nama_jabfung; ?></option>
                                        <?php endif; ?>
                                        <?php foreach ($getJabfung as $itemJabfung) {
                                            if ($itemJabfung->id_jabfung != $pengguna->id_jabfung) {
                                        ?>
                                                <option value="<?= $itemJabfung->id_jabfung; ?>"><?= $itemJabfung->nama_jabfung; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="itemsJenjang">Jenjang Jabatan</label>
                                    <select name="itemsJenjang" id="itemsJenjang" class="form-control">
                                        <?php if (!empty($pengguna->id_jenjang)) : ?>
                                            <option value="<?= $pengguna->id_jenjang; ?>"><?= $itemDataJenjang->nama_jenjang; ?></option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="itemRumah">Rumah Jabatan</label>
                                    <select name="itemRumah" id="itemRumah" class="form-control">
                                        <?php if (!empty($pengguna->id_rumah)) : ?>
                                            <option value="<?= $pengguna->id_rumah; ?>"><?= $itemDataRumah->nama_rumah; ?></option>
                                        <?php endif; ?>
                                        <?php foreach ($getRumah as $gr) {
                                            if ($gr->id_rumah != $pengguna->id_rumah) {
                                        ?>
                                                <option value="<?= $gr->id_rumah; ?>"><?= $gr->nama_rumah; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tmpt_kerja">Tempat Kerja</label>
                                    <input type="text" name="tmpt_kerja" id="tmpt_kerja" class="form-control" value="<?= $pengguna->tmpt_kerja; ?>" required>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-4 col-sm-4 mb-3">
                            <?php if ($pengguna->id_role == 'role-4') : ?>
                                <div class=" form-group mb-3">
                                    <label for="alamat_kerja">Alamat Kerja</label>
                                    <textarea name="alamat_kerja" id="alamat_kerja" cols="" rows="5" class="form-control" required><?= $pengguna->alamat_kerja; ?></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="pdd_terakhir">Pendidikan Terakhir</label>
                                    <select name="pdd_terakhir" id="pdd_terakhir" class="form-control">
                                        <option value="<?= $pengguna->pdd_terakhir; ?>"><?= $pengguna->pdd_terakhir; ?></option>
                                        <?php if ($pengguna->pdd_terakhir == 'D1') : ?>
                                            <option value="D2">D2</option>
                                            <option value="D3">D3</option>
                                            <option value="S1">S1</option>
                                            <option value="S2">S2</option>
                                            <option value="S3">S3</option>
                                        <?php elseif ($pengguna->pdd_terakhir == 'D2') : ?>
                                            <option value="D1">D1</option>
                                            <option value="D3">D3</option>
                                            <option value="S1">S1</option>
                                            <option value="S2">S2</option>
                                            <option value="S3">S3</option>
                                        <?php elseif ($pengguna->pdd_terakhir == 'D3') : ?>
                                            <option value="D1">D1</option>
                                            <option value="D2">D2</option>
                                            <option value="S1">S1</option>
                                            <option value="S2">S2</option>
                                            <option value="S3">S3</option>
                                        <?php elseif ($pengguna->pdd_terakhir == 'S1') : ?>
                                            <option value="D1">D1</option>
                                            <option value="D2">D2</option>
                                            <option value="D3">D3</option>
                                            <option value="S2">S2</option>
                                            <option value="S3">S3</option>
                                        <?php elseif ($pengguna->pdd_terakhir == 'S2') : ?>
                                            <option value="D1">D1</option>
                                            <option value="D2">D2</option>
                                            <option value="D3">D3</option>
                                            <option value="S1">S1</option>
                                            <option value="S3">S3</option>
                                        <?php else : ?>
                                            <option value="D1">D1</option>
                                            <option value="D2">D2</option>
                                            <option value="D3">D3</option>
                                            <option value="S1">S1</option>
                                            <option value="S2">S2</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="jurusan">Jurusan</label>
                                    <input type="text" name="jurusan" id="jurusan" class="form-control" value="<?= $pengguna->jurusan; ?>" required>

                                </div>
                                <div class="form-group mb-3">
                                    <label for="status_asn">Status ASN</label>
                                    <select name="status_asn" id="status_asn" class="form-control">
                                        <option value="ASN">ASN</option>
                                        <option value="Non ASN">Non ASN</option>
                                    </select>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            <script>
                function getitemJenjang() {
                    var idJabfung = document.getElementById('itemJabfung').value;
                    var xhr = new XMLHttpRequest();
                    xhr.open("GET", "<?= base_url('admin/settings/profile/get-jenjang/') ?>" + idJabfung, true);
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            var options = JSON.parse(xhr.responseText);
                            populateJenjangDropdown(options);
                        } else {
                            console.error("Permintaan gagal. Status: " + xhr.status);
                        }
                    };
                    xhr.send();
                }

                function populateJenjangDropdown(options) {
                    var jenjangSelect = document.getElementById("itemsJenjang");
                    jenjangSelect.innerHTML = "";

                    var defaultOption = document.createElement("option");
                    defaultOption.textContent = "Pilih Jenjang Jabatan";
                    defaultOption.disabled = true;
                    defaultOption.selected = true;
                    jenjangSelect.appendChild(defaultOption);

                    options.forEach(function(option) {
                        var optionElement = document.createElement("option");
                        optionElement.value = option.id_jenjang;
                        optionElement.textContent = option.nama_jenjang;
                        jenjangSelect.appendChild(optionElement);
                    });
                }
            </script>
            <script src="<?= base_url('assets/tema/admin/prev_avatar.js'); ?>"></script>
        </div>
    </div>
</div>

<!-- Modal Edit Pangkat -->
<?php foreach ($getPangkat as $pk) { ?>
    <div class="modal fade" id="editPangkat<?= $pk->id_pangkat; ?>" tabindex="-1" aria-labelledby="editPangkatLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editPangkatLabel">Edit Pangkat <?= $pk->pangkat; ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('admin/master-data/data-user/update-pangkat/' . $pk->id_pangkat); ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="redir" id="redir" class="form-control" value="<?= $redirect_url; ?>">
                        <div class="form-group mb-3">
                            <label for="pangkat">Nama Pangkat</label>
                            <input type="text" name="pangkat" id="pangkat" class="form-control" value="<?= $pk->pangkat; ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="golongan">Type Golongan</label>
                            <input type="text" name="golongan" id="golongan" class="form-control" value="<?= $pk->golongan; ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Edit Pengguna -->
<?php foreach ($getUser as $gu) { ?>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="editPengguna<?= $gu->id_user; ?>" aria-labelledby="editPenggunaLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="editPenggunaLabel">Edit Data <?= $gu->nama; ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form action="<?= base_url('admin/master-data/data-user/update-date/' . $gu->id_user); ?>" method="post">
                <input type="hidden" name="redir" id="redir" class="form-control" value="<?= $redirect_url; ?>">
                <div class="form-group mb-3">
                    <label for="no_hp">Nomor WhatsAPP</label>
                    <input type="number" name="no_hp" id="no_hp" class="form-control" value="<?= $gu->no_hp; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="id_role">Jenis User Role</label>
                    <select name="id_role" id="id_role" class="form-control">
                        <?php foreach ($getRole as $dataRole) { ?>
                            <option value="<?= $dataRole->id_role; ?>"><?= $dataRole->nama_role; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <button type="submit" class="tbl-primer">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
<?php } ?>

<!-- Rekomendasi -->