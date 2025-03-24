<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--    <base href="--><?php //= PATH ?><!--">-->
    <title><?= $title ?? 'Title' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="/SitePhp/public/img/IMG_20250113_003822_347.jpg" type="image/jpeg">
</head>
<body>
<header class="p-3 text-bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                    <use xlink:href="#bootstrap"/>
                </svg>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/home" class="nav-link px-2 text-secondary">Home</a></li>
                <li><a href="/hat" class="nav-link px-2 text-white">Heads and tails</a></li>
                <li><a href="/reviews" class="nav-link px-2 text-white">Reviews</a></li>
                <li><a href="" class="nav-link px-2 text-white">FAQs</a></li>
                <li><a href="/about" class="nav-link px-2 text-white">About</a></li>
            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..."
                       aria-label="Search">
            </form>

            <ul class="d-flex text-white align-items-center list-unstyled m-0 gap-3">
                <?php if (check_auth()): ?>
                    <li><?= $_SESSION['user']; ?></li>
                    <li><a class="nav-link" href="/logout">Logout</a></li>
                <?php else: ?>
                    <li><a class="nav-link" href="/register">Register</a></li>
                    <li><a class="nav-link" href="/login">Login</a></li>
                <?php endif; ?>
            </ul>

        </div>
    </div>
</header>

<?= get_alerts();