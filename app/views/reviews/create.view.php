<?php require VIEWS . '/incs/header.php'; ?>

<div class="row d-flex justify-content-center py-5">
    <div class="col col-xl-10">
        <div class="card" style="border-radius: 20px;">
            <div class="card-body p-5">
                <form class="d-flex flex-column justify-content-center align-items-center mb-4" method="POST" enctype="multipart/form-data"
                      action="/reviews"
                      enctype="multipart/form-data">

                    <?= isset($validator) ? $validator->listerrors('name') : '' ?>

                    <div data-mdb-input-init class="form-outline flex-fill mb-3">
                        <input type="text" id="name" name="name" placeholder="Name"
                               class="form-control form-control-lg"
                               value="<?= isset($_POST['name']) ? old('name') : '' ?>">
                    </div>

                    <?= isset($validator) ? $validator->listerrors('description') : '' ?>

                    <div data-mdb-input-init class="form-outline flex-fill mb-3">
                        <input type="text" id="description" name="description" placeholder="Description"
                               class="form-control form-control-lg"
                               value="<?= isset($_POST['description']) ? old('description') : '' ?>">
                    </div>

                    <?= isset($validator) ? $validator->listerrors('reviewsImage') : '' ?>
                    <div class="form-outline flex-fill mb-3">
                        <input type="file" id="reviewsImage" name="reviewsImage[]"
                               class="form-control form-control-lg"
                               accept="*/*" multiple>
                        <label class="form-label" for="reviewsImage">Upload Files</label>
                    </div>

                    <button type="submit" data-mdb-button-init data-mdb-ripple-init
                            class="btn btn-primary btn-lg ms-2">
                        Add
                    </button>

                </form>
            </div>
        </div>

    </div>
</div>


