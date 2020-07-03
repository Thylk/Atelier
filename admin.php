<?php
	session_start();
	// Check if the user is the admin, if not then redirect him to client account page
	if($_SESSION["id"] !== '13'){
		header("location: account.php");
		exit;
	}
?>

<!DOCTYPE html>
<html lang="fr">
	
<?php include 'head.php';?>

<body>

<?php include 'header.php';?>

<main>

	<h1>Bienvenue Morgane Ballif</h1>

    <div id="box_admin">
		<div>
			<a href="bibliotheque.php" class="btn btn-info">Mensurations Clients</a>
		</div>
		<div id="btn_admin">
			<a href="stock.php" class="btn btn-warning">Gestionnaire Boutique</a>
		</div>
		<div>
			<a href="account_logout.php" class="btn btn-danger">Deconnexion</a>
		</div>
    </div>

</main>

<footer>

</footer>

</body>
</html>