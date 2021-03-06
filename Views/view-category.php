<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <title>Forum - <?= $categorie->getName(); ?></title>
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
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Catégories
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php foreach($categorieAll as $parentCategorie): ?>
                        <h6 class="dropdown-header"><?= $parentCategorie['parent']->getName(); ?></h6>
                        <?php foreach($parentCategorie['enfant'] as $sub_categorie): ?>
                            <?php if($sub_categorie[0]->getId() == $_GET['category']): ?>
                                <a class="dropdown-item active" href="?p=forum&category=<?= $sub_categorie[0]->getId(); ?>"><?= $sub_categorie[0]->getName(); ?></a>
                            <?php else: ?>
                                <a class="dropdown-item" href="?p=forum&category=<?= $sub_categorie[0]->getId(); ?>"><?= $sub_categorie[0]->getName(); ?></a>
                            <?php endif; ?>
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
                    <a class="nav-link" href="?p=login">Connection</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?p=register">Inscription</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<div class="jumbotron">
    <h1 class="display-4"><?= $categorie->getName(); ?></h1><br /><br />
</div>

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><?= $categorie->getParent()->getName(); ?></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $categorie->getName(); ?></li>
        </ol>
    </nav>
    <?php if(isset($_SESSION['user'])){ ?>
        <div class="offset-md-10">
            <a class="btn btn-success" href="#" role="button">Ajouter un topic</a>
        </div><br />
    <?php } ?>
    <?php if($listPost != null){ ?>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th scope="col">Intitulé</th>
                <th scope="col">Rédacteur</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($listPost as $unPost){ ?>
                <tr>
                    <th><a href="?p=forum&post=<?= $unPost->getId(); ?>"><?= $unPost->getTitre(); ?></a></th>
                    <td><?= $unPost->getUser()->getPrenom() . " " . $unPost->getUser()->getNom(); ?></td>
                    <td><?= $unPost->getDateFormat(); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table><br /><br />
    <?php } else { ?>
        <center><h4>Aucun topics dans cette catégorie !</h4></center>
    <?php } ?>
</div>




<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>