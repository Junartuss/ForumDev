<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <title>Forum - Connection</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="?p=home">Forum</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="?p=home">Accueil</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Catégories
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php foreach($categorieAll as $parentCategorie): ?>
                        <h6 class="dropdown-header"><?= $parentCategorie['parent']->getName(); ?></h6>
                        <?php foreach($parentCategorie['enfant'] as $sub_categorie): ?>
                            <a class="dropdown-item" href="?p=forum&category=<?= $sub_categorie[0]->getId(); ?>"><?= $sub_categorie[0]->getName(); ?></a>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav">
            <?php if(isset($_SESSION['user'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="?p=compte"><?= $_SESSION['user']->getNom() . " " . $_SESSION['user']->getPrenom(); ?></a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link active" href="?p=login">Connection</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?p=register">Inscription</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<div class="jumbotron">
    <h1 class="display-4">Connection</h1><br /><br />
</div>

<div class="container">
    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger" role="alert"> <?= $_SESSION['error']; ?> </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success" role="alert"> <?= $_SESSION['success']; ?> </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    <form method="post" action="">
        <div class="form-group">
            <label for="loginMail">Mail</label>
            <input type="email" class="form-control" name="loginMail" placeholder="Entrer votre mail">
        </div>
        <div class="form-group">
            <label for="loginPassword">Mot de passe</label>
            <input type="password" class="form-control" name="loginPassword" placeholder="Mot de passe">
        </div>
        <button type="submit" name="validLogin" class="btn btn-primary">Se connecter</button>
    </form>
</div>




<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>