<?php $dataMedia = json_decode($getSet->media, true); ?>
<div id="kontent">
    <div class="form-group text-center mb-3">
        <h1 class="mb-3"><?= $getSet->h1; ?></h1>
        <h3 class="mb-3"><?= $getSet->h3; ?></h3>
    </div>
    <div class="form-group row mb-3">
        <div class="col-lg-4 col-sm-4 mb-3">
            <?php foreach ($dataMedia as $sm) { ?>
                <div class="text-center">
                    <img src="<?= base_url('assets/upload/media/' . $sm); ?>" alt="media" class="img-fluid">
                </div>
            <?php } ?>
        </div>
        <div class="col-lg-8 col-sm-8 mb-3">
            <div style="overflow-y: auto; overflow-x: hidden; max-height: 450px;"><?= $getSet->p; ?></div>
        </div>
    </div>
</div>