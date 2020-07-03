<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="fr">
	
<?php include 'head.php';?>

<body>

<?php include 'header.php';?>

<main>

	<div id="slider_acceuil">
		<figure>
			<img src="assets/img/couturiere.jpg" alt="">
			<img src="assets/img/brother.jpg" alt="">
			<img src="assets/img/stock_tissus.jpg" alt="">
			<img src="assets/img/fil.jpg" alt="">
			<img src="assets/img/couturiere.jpg" alt="">
		</figure>
		<div id="encart_slider">
			<h1 id="main_title">Atelier à façon</h1>
			<h1>Morgane Ballif</h1>
		</div>
	</div>

	<div id="testbox">
		<div id="testboxtwo">
			<div class="haut_container">
				<p>Je propose différents services, destinés aux particuliers comme aux professionnels, allant de la conception de pièces sur mesures à la production en série.</p>
			</div>
			<a href="profil.php" class="btn btn-info">Découvrir mon profil</a>
		</div>
		<div id="testboxtwo">
			<div class="haut_container">
				<p>Divers produits sont disponibles à la vente, achetables directement en ligne via la boutique. Tout est confectionné à la main par moi-même grâce à mon savoir-faire.</p>
			</div>
			<a href="shop.php" class="btn btn-info">La boutique</a>
		</div>
		<div id="testboxtwo">
			<div class="haut_container">
				<p>Dans le cas où vous désireriez du sur-mesure, vous pouvez également créer un compte sur le site afin de renseigner vos mensurations.</p>
			</div>
			<a href="register.php" class="btn btn-info">Créer un compte</a>		
		</div>
	</div>

	<div id="containermuseemap">
		<div class="boxmusee">
			<img src="assets/img/musee_sauvage.jpeg" alt="" id="img_test">
			<div class="text_musee">
				<p>L'Atelier fait partie de l'association "Musée Sauvage", collectif qui s'occupe de la restauration de l'ancien musée d'Argenteuil afin de redonner vie à ce batîment anciennement abandonné. Les travaux de réhabilitation sont en cours et on peut sentir l'odeur du temps mais aucun endroit n'aurait pu mieux m'accueillir. Je remercie toute l'équipe du Musée Sauvage.</p>
				<p>L'Atelier se situe au sein de l'ancien musée d'Argenteuil, 95100, au 5 rue Pierre Guienne.</p>
			</div>
		</div>

		<div id="mapbox">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2620.506638570386!2d2.2545387158557517!3d48.94383810264004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e666740a93c7b9%3A0x3afe7034d6087112!2s5%20Rue%20Pierre%20Guienne%2C%2095100%20Argenteuil!5e0!3m2!1sfr!2sfr!4v1579135484361!5m2!1sfr!2sfr" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
		</div>
	</div>

	

</main>
	<?php include 'footer.php';?>

<script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
<script>
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#383b75"
    },
    "button": {
      "background": "#f1d600"
    }
  },
  "theme": "classic",
  "content": {
    "message": "Nous utilisons des cookies pour vous assurer la meilleure expérience possible sur notre site.",
    "dismiss": "J'ai compris",
    "link": "En savoir plus",
    "href": "rgpd.php"
  }
});
</script>

</body>
</html>