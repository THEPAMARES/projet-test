<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?=URL?>">Librairie</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?=URL?>">Accueil</a>
                    </li>
                    <?php
                        if(!is_connect()){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=URL?>/inscription.php">Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=URL?>/connexion.php">Connexion</a>
                    </li>
                <?php
                }

                if (is_connect()){
                    ?>
                
                    <li class="nav-item">
                        <a class="nav-link" href="<?=URL?>/profil.php">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=URL?>?action=deconnexion">Deconnexion</a>
                    </li>
                    <?php
                }

                if (is_admin()){
                    ?>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>/admin/gestion_membre.php">Gestion Membre</a>
                    </li>
                    <?php
                }
                    ?>

                
                </ul>
            </div>
        </div>
    </nav>
</header>
<div class="erreur">
    <?=$msg?>
</div>