<?php
$segments_after_admin = $this->uri->segment_array(2);
array_shift($segments_after_admin);
$redirect_url = implode("/", $segments_after_admin);
?>
<main style="margin-bottom: 100px">
    <div class="box">
        <h4 class="mb-3"><b>Halaman <?= $judul; ?></b></h4>
        <form action="<?= base_url('admin/settings/maintenance/update'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="redir" id="redir" class="form-control" value="<?= $redirect_url; ?>">
            <div class="row">
                <div class="col-lg-6 col-sm-6 mb-3">
                    <div class="form-group mb-3">
                        <label for="nama_web">Nama Website</label>
                        <input type="text" name="nama_web" id="nama_web" class="form-control" value="<?= $getMaintenance->nama_website; ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="institusi">Nama Institusi</label>
                        <input type="text" name="institusi" id="institusi" class="form-control" value="<?= $getMaintenance->instansi; ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="logo">Logo Website</label>
                        <input type="file" name="logo" id="logo" class="form-control" placeholder="Logo">
                        <div class="mt-3">
                            <img src="<?= base_url('assets/upload/logo/' . $getMaintenance->logo); ?>" alt="logo" id="p_logo" style="height: 50px; width:auto; object-fit:cover;">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 mb-3">
                    <div class="form-group mb-3">
                        <label for="slogan_web">Slogan Website</label>
                        <input type="text" name="slogan_web" id="slogan_web" class="form-control" value="<?= $getMaintenance->slogan_website; ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="api_otp">API OTP</label>
                        <input type="text" name="api_otp" id="api_otp" class="form-control" value="<?= $getMaintenance->api_otp; ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="favication">Favication Website</label>
                        <input type="file" name="favication" id="favication" class="form-control" placeholder="Favication">
                        <div class="mt-3">
                            <img src="<?= base_url('assets/upload/logo/' . $getMaintenance->favicon); ?>" alt="favicon" id="p_fav" style="height: 50px; width:auto; object-fit:cover;">
                        </div>
                    </div>

                </div>
            </div>
            <div class="d-flex align-item-center justify-content-between mb-3">
                <a href="<?= base_url('admin/settings/maintenance/reset'); ?>" class="tbl-reset text-decoration-none">Reset</a>
                <button type="submit" class="tbl-primer">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</main>

<script src="<?= base_url('assets/tema/admin/prev_logo.js'); ?>"></script>