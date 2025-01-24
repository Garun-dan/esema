<!-- Topbar -->
<div id="topbar">
    <a href="<?= base_url(); ?>">
        <img src="<?= base_url('assets/upload/logo/' . $tampilan->logo); ?>" alt="logo" class="img-fluid" />
    </a>
    <div id="menu-tophome">
        <?php foreach ($getMenu as $menu) {
            if ($menu->slug_menu != 'home') :
                $is_homepage = false;
                $current_url = current_url();
                if ($current_url === base_url()) {
                    $is_homepage = true;
                }
        ?>
                <?php if ($is_homepage) : ?>
                    <?php if ($menu->slug_menu != 'sambutan') : ?>
                        <a href="<?= base_url($menu->slug_menu); ?>"><?= $menu->nama_menu; ?></a>
                    <?php endif; ?>
                <?php else : ?>
                    <?php if ($menu->nama_menu == $judul) : ?>
                        <a href="<?= base_url($menu->slug_menu); ?>" class="aktif" style="color: var(--text-color);"><?= $menu->nama_menu; ?></a>
                    <?php else : ?>
                        <a href="<?= base_url($menu->slug_menu); ?>" style="color: var(--text-color);"><?= $menu->nama_menu; ?></a>
                    <?php endif; ?>
                <?php endif; ?>
        <?php endif;
        } ?>
        <?php if ($this->session->userdata('nik')) : ?>
            <a href="<?= base_url('admin/settings/profile'); ?>">Profile</a>
            <?php if ($is_homepage) : ?>
                <a href="<?= base_url('admin/session/logout/halaman'); ?>" class="logout tbl-logout tbl-login text-dark">
                    <i class="bi bi-door-open-fill"></i>
                </a>
            <?php else : ?>
                <a href="<?= base_url('admin/session/logout/halaman'); ?>" class="logout tbl-logout tbl-login text-dark" style="background-color: var(--primary-color); color:var(--item-color)">
                    <i class="bi bi-door-open-fill"></i>
                </a>
            <?php endif; ?>

        <?php else : ?>
            <?php if ($is_homepage) : ?>
                <button type="button" class="tbl-login" data-bs-toggle="modal" data-bs-target="#login">Login</button>
            <?php else : ?>
                <button type="button" class="tbl-login" data-bs-toggle="modal" data-bs-target="#login" style="background-color: var(--primary-color); color:var(--item-color)">Login</button>
            <?php endif; ?>
        <?php endif; ?>

    </div>
    <button id="item-menu" class="btn border-0">
        <span class="bi bi-list"></span>
    </button>

</div>