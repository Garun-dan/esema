<?php $dataMedia = json_decode($getSet->media, true); ?>
<div id="kontent">
    <div class="form-group text-center mb-3">
        <h1 class="mb-3"><?= $getSet->h1; ?></h1>
        <h3 class="mb-3"><?= $getSet->h3; ?></h3>
    </div>
    <div class="form-group row" id="mediaContainer"></div>
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center" id="pagination"></ul>
    </nav>
</div>
<script>
    var dataMedia = <?= json_encode($dataMedia); ?>;
    var urlLoadmedia = "<?php echo site_url('home/pedoman/load_media'); ?>";
</script>
<script src="<?= base_url('assets/tema/home/pagination.js'); ?>"></script>