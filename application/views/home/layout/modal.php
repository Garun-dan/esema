<!-- Login -->
<div class="modal fade" id="login" tabindex="-1" aria-labelledby="loginLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="logo">
                <img src="<?= base_url('assets/upload/logo/' . $tampilan->logo); ?>" alt="logo" class="img-fluid mt-3" />
            </div>
            <div class="modal-body">
                <p class="text-center">Inputkan NIK anda pada form dibawah ini!</p>
                <form action="<?= base_url('home/cek-login'); ?>" method="post">
                    <div class="form-group mt-3 mb-3">
                        <label for="nik">NIK</label>
                        <input type="text" name="nik" id="nik" class="form-control" placeholder="NIK..." required>
                    </div>
                    <div class="form-group mb-3 text-center">
                        <button type="submit" class="tbl-primer">Login</button>
                    </div>
                </form>
                <p class="text-center mt-3">NIK Anda Belum Terdaftar? <a href="#" class="tbl-input-hp">Klik Untuk Informasi Lebih Lanjut!</a></p>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        function closeLoginModal() {
            $('#login').modal('hide');
        }

        $(".tbl-input-hp").on("click", function(e) {
            e.preventDefault();

            closeLoginModal();

            Swal.fire({
                title: "Masukkan Nomor WhatsApp Anda!",
                html: 'Contoh nomor HP: <strong>628********</strong>',
                input: "text",
                inputAttributes: {
                    autocapitalize: "off",
                },
                showCancelButton: true,
                confirmButtonText: "Kirim",
                showLoaderOnConfirm: true,
                inputValidator: (value) => {
                    if (!value.match(/^\d{9,15}$/)) {
                        return 'Nomor telepon tidak valid!';
                    }
                }
            }).then((result) => {
                if (result.value) {
                    const hp = result.value;
                    window.location.href =
                        "<?= base_url('home/customer-service/info-nik/'); ?>" + hp;
                }
            });
        });
    });
</script>