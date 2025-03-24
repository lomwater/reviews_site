<?php require VIEWS . '/incs/header.php'; ?>

    <section class="pb-4">
    <div class="border rounded-5">

    <section class="w-100 p-4">

        <!-- Section: Design Block -->
        <section class="">
            <!-- Jumbotron -->
            <div class="px-4 py-5 px-md-5 text-center text-lg-start bg-body-tertiary">
                <div class="container">
                    <div class="row gx-lg-5 align-items-center">
                        <div class="col-lg-6 mb-5 mb-lg-0">
                            <h1 class="my-5 display-5 fw-bold ls-tight">
                               <br/>
                                <span class="text-primary"></span>
                            </h1>
                            <p style="color: hsl(217, 10%, 50.8%)">

                            </p>
                        </div>

                        <div class="col-lg-6 mb-5 mb-lg-0">
                            <div class="card">
                                <div class="card-body py-5 px-md-5">
                                    <form action="" method="post">
                                        <div class="row">

                                            <div class="col-md-6 mb-4">
                                                <?= isset($validation) ? $validation->listErrors('firstname') : '' ?>
                                                <div data-mdb-input-init class="form-outline">
                                                    <input type="text" id="firstname" name="firstname"
                                                           value="<?= isset($_POST['firstname']) ? old('firstname') : '' ?>"
                                                           class="form-control"/>
                                                    <label class="form-label" for="firstname">First
                                                        name</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <?= isset($validation) ? $validation->listErrors('lastname') : '' ?>
                                                <div data-mdb-input-init class="form-outline">
                                                    <input type="text" id="lastname" name="lastname"  value="<?= isset($_POST['lastname']) ? old('lastname') : '' ?>"
                                                           class="form-control"/>
                                                    <label class="form-label" for="lastname">Last
                                                        name</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <?= isset($validation) ? $validation->listErrors('email') : '' ?>
                                            <input type="email" id="email" name="email" value="<?= isset($_POST['email']) ? old('email') : '' ?>" class="form-control"/>
                                            <label class="form-label" for="email">Email address</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <?= isset($validation) ? $validation->listErrors('password') : '' ?>
                                            <input type="password" id="password" name="password" value="<?= isset($_POST['password']) ? old('password') : '' ?>"
                                                   class="form-control"/>
                                            <label class="form-label" for="password">Password</label>
                                        </div>


                                        <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-primary btn-block mb-4">
                                            LOG IN
                                        </button>

                                        <div class="text-center">
                                            <button type="button" data-mdb-button-init data-mdb-ripple-init
                                                    class="btn btn-link btn-floating mx-1">
                                                <i class="fab fa-facebook-f"></i>
                                            </button>

                                            <button type="button" data-mdb-button-init data-mdb-ripple-init
                                                    class="btn btn-link btn-floating mx-1">
                                                <i class="fab fa-google"></i>
                                            </button>

                                            <button type="button" data-mdb-button-init data-mdb-ripple-init
                                                    class="btn btn-link btn-floating mx-1">
                                                <i class="fab fa-twitter"></i>
                                            </button>

                                            <button type="button" data-mdb-button-init data-mdb-ripple-init
                                                    class="btn btn-link btn-floating mx-1">
                                                <i class="fab fa-github"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
