<div id="footer">
    <p>
        Copyright &copy; 2024 | <?= $tampilan->instansi; ?> |
        All Right Reserved | Design by. Garundan
    </p>
</div>
<!-- Custom JS -->
<script src="<?= base_url('assets/'); ?>plugin/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugin/jquery/jquery-3.7.1.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugin/popper/popper.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugin/alert/sweetalert2.all.min.js"></script>

<!-- Main JS -->
<script src="<?= base_url('assets/'); ?>tema/home/home.js"></script>
<script src="<?= base_url('assets/'); ?>plugin/alert/flash.js"></script>

<script>
    var BASE_URL = '<?= base_url('assets/') ?>';
    document.addEventListener('DOMContentLoaded', init, false);

    function init() {
        if ('serviceWorker' in navigator && navigator.onLine) {
            navigator.serviceWorker.register(BASE_URL + 'service-worker.js')
                .then((reg) => {}, (err) => {
                    console.error('Registrasi service worker Gagal', err);
                });
        }
    }
</script>

</body>

</html>