<?php
$segments_after_admin = $this->uri->segment_array(2);
array_shift($segments_after_admin);
$redirect_url = implode("/", $segments_after_admin);
?>
<main style="margin-bottom: 100px;">
    <div class="row">
        <div class="col-lg-4 col-sm-4 mb-3">
            <div class="box">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h4><b>Daftar Jabatan Fungsional</b></h4>
                    <button type="button" class="tbl-primer" data-bs-toggle="modal" data-bs-target="#tambahJabfung">Tambah</button>
                </div>
                <div class="table-responsive mt-3">
                    <table id="tabel" class="display table table-striped table-bordered table-hover">
                        <thead class="table-success">
                            <tr>
                                <th class="text-center" style="vertical-align: middle;">No</th>
                                <th class="text-center" style="vertical-align: middle;">Nama Jabatan</th>
                                <th class="text-center" style="vertical-align: middle;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($getJabfung as $gj) { ?>
                                <tr>
                                    <td class="text-center" style="vertical-align: middle;"><?= $i; ?></td>
                                    <td style="vertical-align: middle;"><?= $gj->nama_jabfung; ?></td>
                                    <td class="text-center" style="vertical-align: middle;">
                                        <button type="button" class="tbl-warning" data-bs-toggle="offcanvas" data-bs-target="#editJabfung<?= $gj->id_jabfung; ?>" aria-controls="editJabfung"><span class="bi bi-pencil-square"></span></button>
                                        <a href="<?= base_url('admin/master-data/data-jabfung/' . $gj->slug_jabfung . '/instrumen'); ?>" class="tbl-info"><span class="bi bi-info-circle-fill"></span></a>
                                    </td>
                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 mb-3">
            <div class="box">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h4><b>Daftar Jenjang Jabatan</b></h4>
                    <button type="button" class="tbl-primer" data-bs-toggle="collapse" data-bs-target="#tambahOneJenjang" aria-expanded="false" aria-controls="tambahOneJenjang">Tambah</button>
                </div>
                <div class="collapse" id="tambahOneJenjang">
                    <div class="card card-body">
                        <form action="<?= base_url('admin/master-data/data-jabfung/tambah-jenjang'); ?>" method="post">
                            <input type="hidden" name="redir" id="redir" class="form-control" value="<?= $redirect_url; ?>">
                            <div class="form-group mb-3">
                                <label for="nama_jenjang">Nama Jenjang</label>
                                <select name="nama_jenjang" id="nama_jenjang" class="form-control" required>
                                    <option selected disabled>Pilih Jenjang</option>
                                    <option value="Terampil">Terampil</option>
                                    <option value="Mahir">Mahir</option>
                                    <option value="Penyelia">Penyelia</option>
                                    <option value="Ahli Pertama">Ahli Pertama</option>
                                    <option value="Ahli Muda">Ahli Muda</option>
                                    <option value="Ahli Madya">Ahli Madya</option>
                                    <option value="Ahli Utama">Ahli Utama</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="jabfung">Jabatan Fungsional</label>
                                <select name="jabfung" id="jabfung" class="form-control" required>
                                    <?php foreach ($getJabfung as $gj) { ?>
                                        <option value="<?= $gj->id_jabfung; ?>"><?= $gj->nama_jabfung; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="tbl-primer">Tambah</button>
                                <button type="button" class="tbl-danger" id="closeOneJenjang">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive mt-3">
                    <table id="tabel" class="display table table-striped table-bordered table-hover">
                        <thead class="table-success">
                            <tr>
                                <th class="text-center" style="vertical-align: middle;">No</th>
                                <th class="text-center" style="vertical-align: middle;">Nama Jenjang Jabatan</th>
                                <th class="text-center" style="vertical-align: middle;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($getJenjang as $gj) {
                                $joinJenjang = $this->MasterDataModel->joinJenjangtoJabfung($gj->id_jabfung);
                            ?>
                                <tr>
                                    <td class="text-center" style="vertical-align: middle;"><?= $i; ?></td>
                                    <td style="vertical-align: middle;">Jabatan Fungsional <?= $joinJenjang->nama_jabfung; ?> <b><?= $gj->nama_jenjang; ?></b></td>
                                    <td class="text-center" style="vertical-align: middle;">
                                        <button type="button" class="tbl-warning" data-bs-toggle="modal" data-bs-target="#editJJ<?= $gj->id_jenjang; ?>"><span class="bi bi-pencil-square"></span></button>
                                    </td>
                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 mb-3">
            <div class="box">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h4><b>Daftar Rumah Jabatan</b></h4>
                    <button type="button" class="tbl-primer" data-bs-toggle="collapse" data-bs-target="#tambahOneRumah" aria-expanded="false" aria-controls="tambahOneRumah">Tambah</button>
                </div>
                <div class="collapse" id="tambahOneRumah">
                    <div class="card card-body">
                        <form action="<?= base_url('admin/master-data/data-jabfung/tambah-rumah'); ?>" method="post" id="formRumah">
                            <input type="hidden" name="redir" id="redir" class="form-control" value="<?= $redirect_url; ?>">
                            <div class="form-group mb-3">
                                <label for="nama_rumah">Nama Rumah</label>
                                <div id="hot-container" class="mb-3"></div>
                            </div>
                            <div class="form-group mb-3">
                                <button type="button" class="tbl-primer" id="simpanButton">Tambah</button>
                                <button type="button" class="tbl-danger" id="closeOneRumah">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive mt-3">
                    <table id="tabel" class="display table table-striped table-bordered table-hover">
                        <thead class="table-success">
                            <tr>
                                <th class="text-center" style="vertical-align: middle;">No</th>
                                <th class="text-center" style="vertical-align: middle;">Nama Rumah Jabatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($getRumah as $rumah) { ?>
                                <tr>
                                    <td class="text-center" style="vertical-align: middle;"><?= $i; ?></td>
                                    <td style="vertical-align: middle;"><?= $rumah->nama_rumah; ?> <br>
                                        <h6><b><a class="text-decoration-none text-warning mb-3" data-bs-toggle="collapse" href="#editRumahJF<?= $rumah->slug_rumah; ?>" role="button" aria-expanded="false" aria-controls="editRumahJF">Edit</a></b></h6>
                                        <div class="collapse" id="editRumahJF<?= $rumah->slug_rumah; ?>">
                                            <form action="<?= base_url('admin/master-data/data-jabfung/edit-rumah/' . $rumah->id_rumah); ?>" method="post">
                                                <input type="hidden" name="redir" id="redir" class="form-control" value="<?= $redirect_url; ?>">
                                                <div class="form-group mb-3">
                                                    <label for="nama_rumah">Nama Rumah</label>
                                                    <input type="text" name="nama_rumah" id="nama_rumah" class="form-control" value="<?= $rumah->nama_rumah; ?>" required>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <button type="submit" class="tbl-primer">Simpan Perubahan</button>
                                            </form>
                                        </div>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        $("#closeOneJenjang").click(function() {
            $("#tambahOneJenjang").collapse('hide');
        });
        $("#closeOneRumah").click(function() {
            $("#tambahOneRumah").collapse('hide');
        });

        const hotElement = document.getElementById("hot-container");
        const hot = new Handsontable(hotElement, {
            data: [
                [""],
                [""],
                [""],
                [""],
                [""],
                [""],
                [""],
                [""],
                [""],
                [""]
            ],
            rowHeaders: true,
            colHeaders: ["Nama Rumah Jabatan"],
            width: "100%",
            height: "auto",
            autoWrapRow: true,
            autoWrapCol: true,
            licenseKey: "non-commercial-and-evaluation",
        });

        const simpanButton = document.getElementById("simpanButton");
        simpanButton.addEventListener("click", function(event) {
            submitRumah(event);
        });

        function submitRumah(event) {
            event.preventDefault();
            const hotData = hot.getData();
            const postData = [];

            hotData.forEach((row) => {
                const nama_rumah = row[0];

                if (nama_rumah.trim() !== '') {
                    postData.push(nama_rumah);
                }
            });

            if (postData.length > 0) {
                const nama_rumah_input = document.createElement("input");
                nama_rumah_input.type = "hidden";
                nama_rumah_input.name = "nama_rumah";
                nama_rumah_input.value = JSON.stringify(postData);
                const form = document.getElementById("formRumah");
                form.appendChild(nama_rumah_input);
                form.submit();
            } else {
                alert("Tidak ada data yang valid untuk disimpan.");
            }
        }
    });
</script>