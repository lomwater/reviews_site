<?php require VIEWS . '/incs/header.php'; ?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Отзывы клиентов</h1>
    <div class="text-center mb-4">
        <a href="<?= PATH ?>/reviews/create" class="btn btn-primary">Оставить отзыв</a>
    </div>

    <div class="row d-flex flex-wrap">
        <?php foreach ($reviews as $review): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100" onmouseover="showPreview('preview1')" onmouseout="hidePreview('preview1')">
                    <div class="card-body">
                        <h5 class="card-title"><?= $review['name'] ?></h5>
                        <p class="card-text"><?= $review['description'] ?></p>
                        <a href="reviews/<?= $review['slug'] ?>" class="stretched-link"></a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    <?= $pagination ?>
</div>