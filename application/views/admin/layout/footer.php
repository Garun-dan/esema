<footer>
    <p>
        Copyright &copy; 2024 | <?= $getMaintenance->instansi; ?> |
        All Right Reserved | Design by. Garundan
    </p>
    <div class="mobile">
        <a href="<?= base_url(); ?>"><span class="bi bi-house-fill"></span></a>
        <?php foreach ($hakAkses as $akses) : ?>
            <?php if (empty($akses['submenus'])) : ?>
                <a href="<?= base_url('admin/' . $akses['slug_menu']); ?>" <?php if ($this->uri->segment(2) == $akses['slug_menu']) echo 'id="aktif"'; ?>>
                    <span class="bi bi-<?= $akses['icon_menu']; ?>"></span>
                </a>
            <?php else : ?>
                <a href="#<?= $akses['slug_menu']; ?>" data-bs-toggle="offcanvas" data-bs-target="#menu<?= $akses['slug_menu']; ?>" aria-controls="menu<?= $akses['slug_menu']; ?>" <?php if ($this->uri->segment(2) == $akses['slug_menu']) echo 'id="aktif"'; ?>>
                    <span class="bi bi-<?= $akses['icon_menu']; ?>"></span>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

</footer>
</div>
<!-- Custom JS -->
<script src="<?= base_url('assets/'); ?>plugin/popper/popper.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugin/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugin/alert/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets/plugin/tabel/datatables.min.js'); ?>"></script>

<!-- Main JS -->
<script src="<?= base_url('assets/'); ?>tema/admin/admin.js"></script>
<script src="<?= base_url('assets/'); ?>plugin/alert/flash.js"></script>
<script src="<?= base_url('assets/'); ?>plugin/tabel/tabel.js"></script>
</body>

</html>