<?php require VIEWS . '/incs/header.php'; ?>

<div class="full-page-review">
    <div class="review-content">
        <h5><?= htmlspecialchars($reviews['name']) ?></h5>
        <p><?= htmlspecialchars($reviews['description']) ?></p>

        <!-- Секция для отображения фотографий -->
        <div class="mt-4">
            <h6>Фотографии:</h6>
            <div class="row">
                <?php if (!empty($review['images'])): ?>
                    <?php foreach ($review['images'] as $image): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="<?= htmlspecialchars($image) ?>" class="card-img-top" alt="Фотография отзыва">
                                <div class="card-body">
                                    <p class="card-text">Файл: <?= htmlspecialchars(basename($image)) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Нет фотографий для отображения.</p>
                <?php endif; ?>
            </div>
        </div>

        <form action="/reviews" method="post" class="mt-4">
            <input type="hidden" name="_method" value="delete">
            <input type="hidden" name="id" value="<?= htmlspecialchars($review['id']) ?>">
            <button type="submit" class="btn btn-danger">Удалить отзыв</button>
        </form>
    </div>
</div>

<style>
    .full-page-review {
        height: 100vh; /* Занимает всю высоту экрана */
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f8f9fa; /* Светлый фон */
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .review-content {
        max-width: 800px; /* Максимальная ширина отзыва */
        text-align: center;
        background: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }
</style>
