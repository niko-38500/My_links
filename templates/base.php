<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <title><?= $title ?></title><link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
</head>
<body class="min-vh-100">
    <header>
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">My-links</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <?php if ($isLogged): ?>
                            <li class="nav-item dropdown ms-4">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Account <small>(<?= $_SESSION['user']['pseudo'] ?>)</small>
                                </a>
                                <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                    <li class="nav-item"><a class="dropdown-item" href="/account">my account</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="/sign-out">log-out</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="/favorites" class="nav-link">Last added links</a>
                            </li>
                        <?php endif ?>
                        <?php if (!$isLogged): ?>
                            <li class="nav-item ms-4">
                                <a class="nav-link" href="/sign-up">sign-up</a>
                            </li>
                            <li class="nav-item ms-4">
                                <a class="nav-link" href="/sign-in">sign-in</a>
                            </li>
                        <?php endif ?>
                    </ul>
                    <form class="d-flex">
                        <input class="text-dark form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <?= $content ?>
    </main>
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script src="js/slideShow.js"></script>
    <?php if (isset($script) && null !== $script) : ?>
        <script src="js/<?= $script ?>"></script>
    <?php endif; ?>
</body>
</html>