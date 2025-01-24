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
    <?php
    $text = $getSet->h1;
    $h1 = split_text_every_two_words($text);
    ?>
    <?php foreach ($h1 as $judul) { ?>
        <span class="training"><?= $judul; ?></span>
    <?php } ?>

    <h3><?= $getSet->h3; ?></h3>
    <p>
        <?= $getSet->p; ?>
    </p>
    <a href="<?= base_url('sambutan'); ?>" class="tbl-primer text-decoration-none">Sambutan</a>
</main>