<!-- Topbar -->
<div class="topbar">
    <img src="<?= base_url('assets/upload/logo/' . $getMaintenance->logo); ?>" alt="logo" id="topbar-logo" class="img-fluid" />
    <div class="topbar-menu">
        <?php
        $displayed_submenus = [];
        foreach ($hakAkses as $akses) : ?>
            <?php if ($akses['nama_menu'] == $judul) : ?>
                <li class="aktif">
                <?php else : ?>
                <li>
                <?php endif; ?>
                <?php if (empty($akses['submenus'])) : ?>
                    <a href="<?= base_url('admin/' . $akses['slug_menu']); ?>"><?= $akses['nama_menu']; ?></a>
                <?php else : ?>
                    <a href="#<?= $akses['slug_menu']; ?>" class="view-submenu"><?= $akses['nama_menu']; ?></a>
                    <div class="submenu">
                        <?php foreach ($akses['submenus'] as $submenu) : ?>
                            <?php
                            $uri = $this->uri->segment(3);
                            $submenu_slug = $akses['slug_menu'] . '/' . $submenu['slug_submenu'];
                            if (!in_array($submenu['id_submenu'], $displayed_submenus)) :
                                $displayed_submenus[] = $submenu['id_submenu'];
                            ?>
                                <a href="<?= base_url('admin/' . $submenu_slug); ?>" class="text-decoration-none <?php if ($submenu['slug_submenu'] == $uri) echo 'sub-aktif'; ?>">
                                    <?= $submenu['nama_submenu']; ?>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                </li>
            <?php endforeach; ?>
    </div>
    <li>
        <a href="#" class="view-submenu dropdown-toggle">
            <img src="<?= base_url('assets/upload/profile/' . $pengguna->avatar); ?>" alt="provile" class="img-fluid" style="width: 30px; height:30px; border-radius:50%; object-fit:cover;" />
        </a>
        <div class="submenu">
            <a href="<?= base_url(); ?>" class="text-decoration-none" style="font-size: 12px;">
                <span class="bi bi-house-check-fill me-2">Home</span>
            </a>
            <a href="<?= base_url('admin/session/logout/halaman'); ?>" class="logout tbl-logout" style="font-size: 12px;">
                <span class="bi bi-door-open-fill me-2">Logout</span>
            </a>
        </div>
    </li>

</div>

<script src="<?= base_url('assets/tema/admin/logo.js'); ?>"></script>