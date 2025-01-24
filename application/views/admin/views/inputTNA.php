<?php
$segments_after_admin = $this->uri->segment_array(2);
array_shift($segments_after_admin);
$redirect_url = implode("/", $segments_after_admin);

?>
<div class="collapse" id="inputTNA">
    <div class="box">
        <h4 class="mb-3"><b>Form Tambah TNA</b></h4>
        <form action="<?= base_url('admin/tna/data-tna/update-tna'); ?>" method="post" class="formUpdateTNA">
            <input type="hidden" name="redir" id="redir" class="form-control" value="<?= $redirect_url; ?>">
            <div class="form-group row mb-3">
                <div class="col-lg-6 col-sm-6 mb-3">
                    <label for="jabfung">Jabatan Fungsional</label>
                    <select name="jabfung" id="jabfung" class="form-control" onchange="getJenjang()">
                        <option selected>Pilih Jabatan Fungsional</option>
                        <?php foreach ($getJabfung as $gj) { ?>
                            <option value="<?= $gj->id_jabfung; ?>"><?= $gj->nama_jabfung; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-lg-6 col-sm-6 mb-3">
                    <label for="jenjang">Jenjang Jabatan</label>
                    <select name="jenjang" id="jenjang" class="form-control">
                    </select>
                </div>
            </div>
            <div class="form-group row d-none" id="viewdataAllJenjang">
                <div class="col-lg-5 col-sm-5 mb-3">
                    <div id="allJenjang"></div>
                </div>
                <div class="col-lg-7 col-sm-7 mb-3">
                    <div id="allSetdata"></div>
                </div>
            </div>
            <div class="form-group text-center mb-3">
                <button type="submit" class="tbl-primer" id="updateTNA">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function getJenjang() {
        var jabfungId = document.getElementById("jabfung").value;

        var xhr = new XMLHttpRequest();
        xhr.open("GET", "<?= base_url('admin/tna/data-tna/get-jenjang/'); ?>" + jabfungId, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                var options = JSON.parse(xhr.responseText);

                var jenjangSelect = document.getElementById("jenjang");
                jenjangSelect.innerHTML = "";

                var defaultOption = document.createElement("option");
                defaultOption.textContent = "Pilih Jenjang Jabatan";
                jenjangSelect.appendChild(defaultOption);

                var allOption = document.createElement("option");
                allOption.value = "all";
                allOption.textContent = "ALL";
                jenjangSelect.appendChild(allOption);

                options.forEach(function(option) {
                    var optionElement = document.createElement("option");
                    optionElement.value = option.id_jenjang;
                    optionElement.textContent = option.nama_jenjang;
                    jenjangSelect.appendChild(optionElement);
                });
            } else {
                console.error("Permintaan gagal. Status: " + xhr.status);
            }
        };
        xhr.send();
    }
</script>