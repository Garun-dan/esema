<!-- Background -->
<div id="background">
    <?php if (json_decode($getSet->media)) : ?>
        <?php foreach (json_decode($getSet->media) as $media) { ?>
            <img src="<?= base_url('assets/upload/media/' . $media); ?>" alt="background" class="img-fluid" />
        <?php } ?>
    <?php else : ?>
        <img src="<?= base_url('assets/upload/media/' . $getSet->media); ?>" alt="background" class="img-fluid" />
    <?php endif; ?>
</div>

<main>
    <div class="form-group mb-3">
        <h4 class="mb-3"><b>Validasi Data</b></h4>
        <?php if (empty($user->no_hp)) : ?>
            <form id="formSimpanHP" action="<?= base_url('cek-login/validasi'); ?>" method="post">
                <input type="hidden" name="nik" id="nik" value="<?= $user->nik; ?>">
                <div class="form-group" id="nomor_hp">
                    <label for="hp">Nomor HP</label>
                    <input type="text" name="hp" id="hp" class="form-control" value="<?= $user->no_hp; ?>" required style="width: 350px;">
                    <small><b>NB:</b><i>Nomor HP diisi seperti berikut 6281234567890</i></small>
                </div>
                <div class="form-group d-none" id="dataOTP">
                    <label for="otp">OTP</label>
                    <input type="number" name="otp" id="otp" class="form-control" required style="width: 350px;">
                </div>
                <div class="mt-3">
                    <button type="button" class="tbl-primer" id="btnSimpanHP" onclick="simpanHP('<?= $user->nik; ?>')">Simpan</button>
                    <button type="submit" class="tbl-primer d-none" id="btnValidOTP">Validasi</button>
                </div>
            </form>
        <?php else : ?>
            <form action="<?= base_url('cek-login/validasi'); ?>" method="post">
                <input type="hidden" name="nik" id="nik" value="<?= $user->nik; ?>">
                <label for="otp">OTP</label>
                <input type="number" name="otp" id="otp" class="form-control" required style="width: 350px;">
                <div class="mt-3">
                    <button type="submit" class="tbl-primer">Validasi</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</main>

<script>
    function simpanHP(nik) {
        const hp = $("#hp").val();

        console.log("NIK:", nik);
        console.log("HP:", hp);

        $.ajax({
            type: "POST",
            url: "<?= base_url('cek-login/simpan-hp'); ?>",
            data: {
                nik: nik,
                hp: hp,
            },
            success: function(response) {
                var dataOTP = $("#dataOTP");
                dataOTP.removeClass("d-none");
                var btnSimpanHP = $("#btnSimpanHP");
                btnSimpanHP.addClass("d-none");
                const formHP = $("#hp");
                formHP.prop("readonly", true);
                var btnValidOTP = $("#btnValidOTP");
                btnValidOTP.removeClass("d-none");
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            },
        });
    }
</script>