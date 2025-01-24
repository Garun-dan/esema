<?php
$segments_after_admin = $this->uri->segment_array(2);
array_shift($segments_after_admin);
$redirect_url = implode("/", $segments_after_admin);

$getHome = $this->SettingsModel->getAllMenu(['posisi_menu' => 'home']);
?>
<main style="margin-bottom: 100px">
    <div class="chart-statistik">
        <div class="chart-sidebar">
            <?php foreach ($getHome as $gh) {
                $oneHome = $this->SettingsModel->getOneMenu(['id_menu' => $gh->id_menu]);
            ?>
                <li style="text-align:right;">
                    <a type="button" class="border-0 tabhomemenu chart-aktif" data-id-menu="<?= $gh->id_menu; ?>" onclick="viewOpen(event,'<?= $gh->id_menu; ?>')">
                        <?= $gh->nama_menu; ?>
                    </a>
                </li>
            <?php } ?>
        </div>
        <div class="chart-view">
            <?php foreach ($getHome as $gh) {
                $setHome = $this->SettingsModel->getOneSet(['id_menu' => $gh->id_menu]);
                if ($setHome) {
                    $id = $setHome->id_sethome;
                    $id_menu = $setHome->id_menu;
                    $h1 = $setHome->h1;
                    $h3 = $setHome->h3;
                    $p = $setHome->p;
                    $media = $setHome->media;
                } else {
                    $id = '';
                    $id_menu = '';
                    $h1 = '';
                    $h3 = '';
                    $p = '';
                    $media = '';
                }
            ?>
                <div class="menuview mb-3" id="<?= $gh->id_menu; ?>" style="display: none;">
                    <div class="form-group row mb-3">
                        <div class="col-lg-5 col-sm-5 mb-3">
                            <form action="<?= base_url('admin/settings/homepage/simpan-' . $gh->id_menu); ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="redir" id="redir" class="form-control" value="<?= $redirect_url; ?>">
                                <div class="form-group mb-3">
                                    <label for="judul_h1">Judul H1</label>
                                    <input type="text" name="judul_h1_<?= $gh->id_menu; ?>" id="judul_h1" class="form-control" value="<?= $h1; ?>" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="judul_h3">Judul H3</label>
                                    <input type="text" name="judul_h3_<?= $gh->id_menu; ?>" id="judul_h3" class="form-control" value="<?= $h3; ?>" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="ket">Keterangan</label>
                                    <textarea name="ket_<?= $gh->id_menu; ?>" id="ket" cols="" rows="5" class="form-control"><?= $p; ?></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="background">File Upload</label>
                                    <input type="file" name="background_<?= $gh->id_menu; ?>[]" id="background" class="form-control" multiple>
                                </div>
                                <div class="form-group mb-3">
                                    <button type="submit" class="tbl-primer">Simpan</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-7 col-sm-7 mb-3">
                            <div class="form-group row">
                                <?php if (json_decode($media, true)) : ?>
                                    <?php foreach (json_decode($media, true) as $m) {
                                        $ekstensi = pathinfo($m, PATHINFO_EXTENSION);
                                        $namaFile = pathinfo($m, PATHINFO_FILENAME);
                                        if (in_array($ekstensi, ['jpg', 'png', 'jpeg'])) {
                                            $src = base_url('assets/upload/media/' . $m);
                                            $content = "<img src='$src' id='v_bc' alt='background' class='position-relative' style='width: 300px; height:300px; object-fit:cover;'>";
                                        } else {
                                            $src = base_url('assets/upload/media/' . $namaFile . '.jpg');
                                            $content = "<img src='$src' id='v_bc' alt='background' class='position-relative' style='height:250px; object-fit:cover;'>";
                                        }
                                    ?>
                                        <?php if ($gh->slug_menu === 'home') : ?>
                                            <?= $content; ?>
                                            <div class="position-absolute" style="width: 50%; left: 50%; top: 25%;">
                                                <div id="v_h1" class="d-none"></div>
                                                <div id="v_h3" class="d-none"></div>
                                                <div id="v_ket" class="d-none"></div>
                                            </div>
                                        <?php else : ?>
                                            <div class="col-lg-4 col-sm-4 mb-3">
                                                <div class="card text-bg-dark">
                                                    <?= $content; ?>
                                                    <div class="card-img-overlay">
                                                        <h5 class="card-title"><?= $namaFile; ?></h5>
                                                        <div class="form-group">
                                                            <button type="button" class="tbl-info mb-2" data-bs-toggle="offcanvas" data-bs-target="#media-<?= $m; ?>" aria-controls="media"><span class="bi bi-zoom-in"></span></button>
                                                            <a href="<?= base_url('admin/settings/homepage/hapus-media/' . urlencode($m) . '/' . $setHome->id_sethome); ?>" class="tbl-danger tbl-hapus"><span class="bi bi-trash-fill"></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <div class="offcanvas offcanvas-end" tabindex="-1" id="media-<?= $m; ?>" aria-labelledby="mediaLabel">
                                            <div class="offcanvas-header">
                                                <h5 class="offcanvas-title" id="mediaLabel">Media <?= $namaFile; ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                            </div>
                                            <div class="offcanvas-body">
                                                <?php
                                                $file_extension = pathinfo($m, PATHINFO_EXTENSION);
                                                if (in_array($file_extension, ['jpg', 'png', 'jpeg'])) {
                                                ?>
                                                    <img src="<?= base_url('assets/upload/media/' . $m); ?>" alt="background" id="v_bc" class="position-relative" style="width: 250px; height:auto; object-fit:cover;">
                                                <?php } elseif ($file_extension === 'pdf') {
                                                ?>
                                                    <iframe src="<?= base_url('assets/upload/media/' . $m); ?>" frameborder="0" width="100%" height="500"></iframe>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>

                                <?php else : ?>
                                    <?php if ($gh->slug_menu === 'home') : ?>
                                        <img src='<?= base_url('assets/upload/media/' . $media); ?>' id='v_bc' alt='background' class='position-relative' style='width: 300px; height:300px; object-fit:cover;'>
                                        <div class="position-absolute" style="width: 50%; left: 50%; top: 25%;">
                                            <div id="v_h1" class="d-none"></div>
                                            <div id="v_h3" class="d-none"></div>
                                            <div id="v_ket" class="d-none"></div>
                                        </div>
                                        <?php else :
                                        if ($id) :
                                        ?>
                                            <div class="col-lg-6 col-sm-6 mb-3">
                                                <div class="card text-bg-dark">
                                                    <img src='<?= base_url('assets/upload/media/' . $media); ?>' id='v_bc' alt='background' class='position-relative' style='width: 300px; height:300px; object-fit:cover;'>
                                                    <div class="card-img-overlay">
                                                        <h5 class="card-title"><?= $media; ?></h5>
                                                        <div class="form-group">
                                                            <button type="button" class="tbl-info mb-2" data-bs-toggle="offcanvas" data-bs-target="#media-<?= $media; ?>" aria-controls="media"><span class="bi bi-zoom-in"></span></button>
                                                            <a href="<?= base_url('admin/settings/homepage/hapus-media/' . urlencode($media) . '/' . $id); ?>" class="tbl-danger tbl-hapus"><span class="bi bi-trash-fill"></span></a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                    <?php endif;
                                    endif; ?>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    </div>
</main>

<script src="https://cdn.tiny.cloud/1/xeknkmt7y7rwmr93g85hqf0tudif5yftvh9h0esxznsmojia/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    function viewOpen(event, idMenu) {
        var i, menuview, tabhomemenu;

        menuview = document.getElementsByClassName("menuview");

        for (i = 0; i < menuview.length; i++) {
            menuview[i].style.display = "none";
        }

        tabhomemenu = document.getElementsByClassName("tabhomemenu");
        for (i = 0; i < tabhomemenu.length; i++) {
            tabhomemenu[i].classList.remove("chart-aktif");
        }

        document.getElementById(idMenu).style.display = "block";
        event.currentTarget.classList.add("chart-aktif");
    }

    document.addEventListener("DOMContentLoaded", function() {
        var tabhomemenu = document.getElementsByClassName("tabhomemenu");
        var smallestId = tabhomemenu[0].dataset.idMenu;
        var firsttabhomemenu = tabhomemenu[0];
        for (var i = 1; i < tabhomemenu.length; i++) {
            var currentId = tabhomemenu[i].dataset.idMenu;
            if (currentId < smallestId) {
                smallestId = currentId;
                firsttabhomemenu = tabhomemenu[i];
            }
        }

        viewOpen({
                currentTarget: firsttabhomemenu,
            },
            smallestId
        );
    });

    const judul_h1 = document.getElementById("judul_h1");
    const v_h1 = document.getElementById("v_h1");
    const judul_h3 = document.getElementById("judul_h3");
    const v_h3 = document.getElementById("v_h3");
    const ket = document.getElementById("ket");
    const v_ket = document.getElementById("v_ket");
    const bc = document.getElementById("background");
    const v_bc = document.getElementById("v_bc");

    judul_h1.addEventListener("input", function() {
        v_h1.classList.remove("d-none");
        v_h1.innerHTML = "";
        var viewH1 = document.createElement("h1");
        var inputH1 = judul_h1.value.trim();
        var wordsh1 = inputH1.split(" ");
        if (wordsh1.length > 2) {
            var firstLine = wordsh1.slice(0, 2).join(" ");
            var secondLine = wordsh1.slice(2).join(" ");
            viewH1.innerHTML = firstLine + "<br>" + secondLine;
        } else {
            viewH1.textContent = inputH1;
        }
        viewH1.style.fontSize = "32px";
        v_h1.appendChild(viewH1);
    });

    judul_h3.addEventListener("input", function() {
        v_h3.classList.remove("d-none");
        v_h3.innerHTML = "";
        var viewH3 = document.createElement("h3");
        var inputH3 = judul_h3.value.trim();
        var wordsh3 = inputH3.split(" ");
        if (wordsh3.length > 3) {
            var firstLine = wordsh3.slice(0, 2).join(" ");
            var secondLine = wordsh3.slice(2).join(" ");
            viewH3.innerHTML = firstLine + "<br>" + secondLine;
        } else {
            viewH3.textContent = inputH3;
        }

        viewH3.style.fontSize = "22px";
        v_h3.appendChild(viewH3);
    });

    ket.addEventListener("input", function() {
        v_ket.classList.remove("d-none");
        v_ket.innerHTML = "";
        var viewKet = document.createElement("p");
        viewKet.textContent = ket.value;
        viewKet.style.fontSize = "10px";
        v_ket.appendChild(viewKet);
    });

    bc.addEventListener("change", () => {
        const file = bc.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = (e) => {
                v_bc.src = e.target.result;
            };

            reader.readAsDataURL(file);
        } else {
            v_bc.src = "";
        }
    });

    tinymce.init({
        selector: "textarea",
        plugins: "anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount",
        toolbar: "undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat",
    });
</script>