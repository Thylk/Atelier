<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="fr">
	
<?php include 'head.php';?>

<body>

<?php include 'header.php';?>

<main>
    <h1>Morgane Ballif</h1>

    <div id="toto6">
        <div id="profil_parcours">
            <h3>Mon parcours</h3>
            <p>Passionnée par la couture depuis l'enfance, je n'ai eu d'autre choix que d'en faire mon métier, guidée par l'envie de sublimer les corps, que ce soit par le costume pour les artistes de scène ou via le vêtement sur-mesure.</p>
            <p>Mon parcours est ponctué de rencontres qui ont fondamentalement enrichi mon savoir-faire. J'ai commencé en tant qu'auto-didacte par me mettre au service d'une styliste en tant que mécannicienne et créatrice d'accessoires.</p>
            <p>A la suite de quoi j'ai cherché à faire reconnaître mes compétences par un CAP Couture Vêtement Flou obtenu en candidat libre en 2016.</p>
            <p>Suite à cela, j'ai souhaité approfondir dans le domaine du costume de série et historique.</p>
            <p>J'ai donc obtenu un diplôme de Technicien des métiers du spectacle au Lycée Paul Poiret à Paris.</p>
            <p>Ma rencontre avec Samy Douib, tailleur-costumier passé maître en la matière après 50 ans de métier, m'a poussée jusqu'en formation de tailleur Homme au sein de ce même établissement.</p>
            <p>Les tailleurs se raréfiant en France, j'ai choisi de m'expatrié à Londres au sein d'un atelier de Tailleurs sur mesure: Graham Browne Bespoke Tailor.</p>
            <p>De retour en France après cette expérience exceptionnelle, j'ai travaillé à la création d'une auto-entreprise et d'un atelier de couture professionnel.</p>
            <p>Récemment installé au Musée Sauvage, à 10 mins de la gare St Lazare en train, je dispose d'un espace me permettant d'accueillir les essayages nécessaires à la fabrication sur-mesure.</p>
            <a id="btn_parcours" href="galerie.php" class="btn btn-info">Mes réalisations</a>
        </div>
        <div id="contact">
            <h3>Me contacter</h3>
            <p>Directement par téléphone au: 06 36 98 25 12</p>
            <p>Par mail: <a href="" id="yourForm">Envoyer un mail</a><p>
        </div>
    </div>
</main>

<!-- Open mail on click -->
<script>
    $('#yourForm').click(function(e) {
        e.preventDefault();
        // handle the form submission (AJAX...)
        window.location.assign('mailto:atelierafacon@gmail.com');
    });
</script>

</body>
</html>