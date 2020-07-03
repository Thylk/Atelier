<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Atelier à façon</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="index.php">Accueil</a>
                <a class="nav-item nav-link" href="profil.php">Profil</a>
                <a class="nav-item nav-link" href="shop.php">Boutique</a>
                <?php
                    if (isset($_SESSION['loggedin'])) {
                        echo '<a id="auth_connected" class="nav-item nav-link" href="account.php">Compte - Connecté</a>';
                    }
                    else {
                        echo '<a id="auth_disconnected" class="nav-item nav-link" href="account.php">Compte - Déconnecté</a>';
                    }
                ?>
                <a class="nav-item nav-link" href="shop_cart.php">
                    <i class="fas fa-shopping-cart"></i>
                </a>
            </div>
        </div>
    </nav>
</header>